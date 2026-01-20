import cv2
import tkinter as tk
from tkinter import ttk, messagebox
from PIL import Image, ImageTk, ImageDraw
import numpy as np
import os
import threading
import time
import datetime

class VideoClipper:
    def __init__(self, video_path):
        self.video_path = video_path
        self.cap = cv2.VideoCapture(video_path)
        self.cap.set(cv2.CAP_PROP_POS_MSEC, 0)
        self.fps = self.cap.get(cv2.CAP_PROP_FPS)
        self.total_frames = int(self.cap.get(cv2.CAP_PROP_FRAME_COUNT))
        self.duration = self.total_frames / self.fps

        # Get original video dimensions
        self.original_width = int(self.cap.get(cv2.CAP_PROP_FRAME_WIDTH))
        self.original_height = int(self.cap.get(cv2.CAP_PROP_FRAME_HEIGHT))

        # Resolution options
        self.resolutions = {
            "144p": (256, 144),
            "240p": (426, 240),
            "360p": (640, 360),
            "480p": (854, 480),
            "720p": (1280, 720),
            "Original": (self.original_width, self.original_height)
        }
        self.selected_resolution = "Original"  # Default to original resolution

        # Initialize start and end times (in seconds)
        self.start_time = 0
        self.end_time = self.duration
        self.current_time = 0
        self.is_dragging = False
        self.drag_type = None
        self.preview_dragging = False

        # Processing flags
        self.is_processing = False
        self.processing_thread = None

        # Create main window
        self.root = tk.Tk()
        self.root.title("Video Clipper")

        # Create video frame
        self.video_frame = ttk.Frame(self.root)
        self.video_frame.pack(padx=10, pady=10)

        # Create canvas for video display
        self.canvas = tk.Canvas(self.video_frame, width=800, height=450)
        self.canvas.pack()

        # Create timeline frame
        self.timeline_frame = ttk.Frame(self.root)
        self.timeline_frame.pack(padx=10, pady=5, fill=tk.X)

        # Create timeline canvas
        self.timeline_canvas = tk.Canvas(self.timeline_frame, height=50, bg='#222222')
        self.timeline_canvas.pack(fill=tk.X)

        # Draw filmstrip thumbnails when canvas is resized
        self.timeline_canvas.bind('<Configure>', lambda e: self.draw_filmstrip_on_canvas())

        # Create pause button with icon
        self.is_paused = False
        self.pause_button = ttk.Button(self.timeline_frame, text="⏸", width=3, command=self.toggle_pause)
        self.pause_button.pack(side=tk.LEFT, padx=5)

        # Create start and end lines (thicker and taller)
        self.start_line = self.timeline_canvas.create_line(0, -20, 0, 70, fill='red', width=4)
        self.end_line = self.timeline_canvas.create_line(800, -20, 800, 70, fill='red', width=4)

        # Create preview line
        self.preview_line = self.timeline_canvas.create_line(0, 0, 0, 50, fill='green', width=4)

        # Bind mouse events
        self.timeline_canvas.bind('<Button-1>', self.on_click)
        self.timeline_canvas.bind('<B1-Motion>', self.on_drag)
        self.timeline_canvas.bind('<ButtonRelease-1>', self.on_release)
        # Bind configure event to redraw cut lines
        self.timeline_canvas.bind('<Configure>', self.redraw_cut_lines)

        # Create time labels
        self.start_label = ttk.Label(self.timeline_frame, text="Start: 0:00")
        self.start_label.pack(side=tk.LEFT)
        self.end_label = ttk.Label(self.timeline_frame, text=f"End: {self.format_time(self.duration)}")
        self.end_label.pack(side=tk.RIGHT)
        self.preview_label = ttk.Label(self.timeline_frame, text="Preview: 0:00")
        self.preview_label.pack(side=tk.LEFT, padx=20)

        # Create progress frame
        self.progress_frame = ttk.Frame(self.root)
        self.progress_frame.pack(padx=10, pady=5, fill=tk.X)

        # Create progress bar
        self.progress_var = tk.DoubleVar()
        self.progress_bar = ttk.Progressbar(
            self.progress_frame,
            variable=self.progress_var,
            maximum=100,
            length=300,
            mode='determinate',
            style="Custom.Horizontal.TProgressbar"
        )
        self.progress_bar.pack(side=tk.LEFT, padx=5)

        # Create progress label
        self.progress_label = ttk.Label(self.progress_frame, text="0%")
        self.progress_label.pack(side=tk.LEFT, padx=5)

        # Create resolution selector (move to right)
        self.resolution_var = tk.StringVar(value=self.selected_resolution)
        self.resolution_combo = ttk.Combobox(
            self.progress_frame,
            textvariable=self.resolution_var,
            values=list(self.resolutions.keys()),
            state="readonly",
            width=10
        )
        self.resolution_combo.pack(side=tk.RIGHT, padx=5)
        self.resolution_combo.bind('<<ComboboxSelected>>', self.on_resolution_change)
        self.resolution_label = ttk.Label(self.progress_frame, text="Output Resolution:")
        self.resolution_label.pack(side=tk.RIGHT, padx=5)

        # Create clip button
        self.clip_button = ttk.Button(self.root, text="Clip Video", command=self.start_clipping)
        self.clip_button.pack(pady=10)

        # Initialize video display
        self.update_video()

        # Set custom style for progress bar
        style = ttk.Style(self.root)
        style.theme_use('default')
        style.configure("Custom.Horizontal.TProgressbar", troughcolor='#222222', background='#4caf50', bordercolor='#222222', lightcolor='#4caf50', darkcolor='#388e3c')

        # Draw filmstrip thumbnails after video is loaded
        self.root.after(1000, self.draw_filmstrip_on_canvas)

        # Filmstrip thumbnails on timeline_canvas
        self.num_thumbs = 11
        self.thumb_width = 75
        self.thumb_height = 48
        self.filmstrip_images = []  # Keep references to PhotoImage
        self.filmstrip_canvas_ids = []

        # ให้เส้น preview เริ่มที่ 0:00
        self.update_preview_line(0)
        self.cap.set(cv2.CAP_PROP_POS_MSEC, 0)

    def format_time(self, seconds):
        minutes = int(seconds // 60)
        seconds = int(seconds % 60)
        return f"{minutes}:{seconds:02d}"

    def on_click(self, event):
        if self.is_processing:
            return

        # Check which line is clicked
        start_x = self.timeline_canvas.coords(self.start_line)[0]
        end_x = self.timeline_canvas.coords(self.end_line)[0]

        # Check if clicking on start or end line
        if abs(event.x - start_x) < 10:  # Increased click area for start line
            self.drag_type = 'start'
            self.is_dragging = True
        elif abs(event.x - end_x) < 10:  # Increased click area for end line
            self.drag_type = 'end'
            self.is_dragging = True
        else:
            # เริ่ม drag เส้น preview
            self.preview_dragging = True
            self.is_dragging = False
            self.update_preview_by_x(event.x)

    def on_drag(self, event):
        if self.preview_dragging:
            self.update_preview_by_x(event.x)
            return
        if not self.is_dragging or self.is_processing:
            return
        canvas_width = self.timeline_canvas.winfo_width()
        margin = 10
        x = max(margin, min(event.x, canvas_width - margin))
        if self.drag_type == 'start':
            end_x = self.timeline_canvas.coords(self.end_line)[0]
            x = min(x, end_x - 10)
            self.start_time = ((x - margin) / (canvas_width - 2 * margin)) * self.duration
            self.start_label.config(text=f"Start: {self.format_time(self.start_time)}")
            self.redraw_cut_lines()
            # ขยับเส้น preview ไปทับเส้น start
            self.update_preview_line(self.start_time)
            # อัปเดตภาพวิดีโอเป็นตำแหน่ง start
            self.show_frame_at_time(self.start_time)
        elif self.drag_type == 'end':
            start_x = self.timeline_canvas.coords(self.start_line)[0]
            x = max(x, start_x + 10)
            self.end_time = ((x - margin) / (canvas_width - 2 * margin)) * self.duration
            self.end_label.config(text=f"End: {self.format_time(self.end_time)}")
            self.redraw_cut_lines()

    def on_release(self, event):
        self.is_dragging = False
        self.drag_type = None
        self.preview_dragging = False

    def update_preview_line(self, time):
        canvas_width = self.timeline_canvas.winfo_width()
        margin = 10
        x = margin + (time / self.duration) * (canvas_width - 2 * margin)
        self.timeline_canvas.coords(self.preview_line, x, 0, x, 50)
        self.timeline_canvas.tag_raise(self.preview_line)  # ให้อยู่บนสุด
        self.timeline_canvas.tag_raise(self.start_line)
        self.timeline_canvas.tag_raise(self.end_line)
        self.preview_label.config(text=f"Preview: {self.format_time(time)}")

    def update_video(self):
        if not self.is_processing and not self.is_paused:
            # Get current frame
            ret, frame = self.cap.read()
            if ret:
                # Convert frame to RGB
                frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
                # Resize frame to fit canvas
                frame = cv2.resize(frame, (800, 450))
                # Convert to PhotoImage
                photo = ImageTk.PhotoImage(image=Image.fromarray(frame))
                # Update canvas
                self.canvas.create_image(0, 0, image=photo, anchor=tk.NW)
                self.canvas.photo = photo
                # Update preview line position based on current video time
                current_time = self.cap.get(cv2.CAP_PROP_POS_MSEC) / 1000
                if current_time < 0.01:
                    self.update_preview_line(0)
                else:
                    self.update_preview_line(current_time)
            # Schedule next update
            self.root.after(30, self.update_video)
        elif not self.is_processing and self.is_paused:
            # ถ้า pause ให้รอ 100ms แล้วเช็คใหม่
            self.root.after(100, self.update_video)

    def update_progress(self, value):
        self.progress_var.set(value)
        self.progress_label.config(text=f"{int(value)}%")

    def start_clipping(self):
        if self.is_processing:
            return

        self.is_processing = True
        self.clip_button.config(state='disabled')
        self.progress_var.set(0)
        self.progress_label.config(text="0%")

        # Start processing in a separate thread with high priority
        self.processing_thread = threading.Thread(target=self.process_video)
        self.processing_thread.daemon = True
        self.processing_thread.start()

        # Start progress update
        self.update_processing_progress()

    def update_processing_progress(self):
        if self.is_processing:
            try:
                # Update UI every 200ms (ลดความถี่การอัปเดต)
                self.root.after(200, self.update_processing_progress)
            except:
                self.is_processing = False
                self.clip_button.config(state='normal')

    def process_video(self):
        try:
            # สร้างชื่อไฟล์ใหม่โดยเพิ่มวันที่และเวลา
            now_str = datetime.datetime.now().strftime('%Y%m%d_%H%M%S')
            base, ext = os.path.splitext(self.video_path)
            output_path = f"{base}_clipped_{now_str}{ext}"

            # Get selected resolution
            width, height = self.resolutions[self.selected_resolution]

            # Create video writer with selected resolution
            fourcc = cv2.VideoWriter_fourcc(*'mp4v')
            out = cv2.VideoWriter(output_path, fourcc, self.fps, (width, height))

            # Calculate frame range
            start_frame = int(self.start_time * self.fps)
            end_frame = int(self.end_time * self.fps)
            total_frames = end_frame - start_frame

            # Set video position to start frame
            self.cap.set(cv2.CAP_PROP_POS_FRAMES, start_frame)

            # Create a buffer for frames
            frame_buffer = []
            buffer_size = 30  # Buffer 30 frames at a time

            # Write frames
            for i in range(total_frames):
                if not self.is_processing:
                    break
                ret, frame = self.cap.read()
                if ret:
                    # Resize frame to selected resolution
                    frame = cv2.resize(frame, (width, height))
                    frame_buffer.append(frame)

                    # When buffer is full or at last frame, write to file
                    if len(frame_buffer) >= buffer_size or i == total_frames - 1:
                        for buffered_frame in frame_buffer:
                            out.write(buffered_frame)
                        frame_buffer.clear()

                    # Update progress bar ทุก 50 เฟรม (ลดความถี่การอัปเดต)
                    if i % 50 == 0 or i == total_frames - 1:
                        progress = (i + 1) / total_frames * 100
                        self.root.after(0, self.update_progress, progress)
                else:
                    break

            out.release()
            self.root.after(0, lambda: self.progress_label.config(text="Completed!"))
            self.root.after(0, lambda: messagebox.showinfo("Success", f"Video clipped successfully!\nSaved to: {output_path}"))
        except Exception as e:
            print(f"Error during clipping: {str(e)}")
            self.root.after(0, lambda: self.progress_label.config(text="Error!"))
            self.root.after(0, lambda: messagebox.showerror("Error", f"Error during clipping: {str(e)}"))
        finally:
            self.is_processing = False
            self.root.after(0, lambda: self.clip_button.config(state='normal'))
            self.root.after(0, lambda: self.progress_var.set(0))
            self.root.after(0, lambda: self.progress_label.config(text="0%"))
            # Reset VideoCapture for preview/play
            self.cap.release()
            self.cap = cv2.VideoCapture(self.video_path)
            self.is_paused = False
            self.root.after(0, self.update_video)

    def run(self):
        self.root.mainloop()

    def redraw_cut_lines(self, event=None):
        canvas_width = self.timeline_canvas.winfo_width()
        margin = 10  # เว้นขอบซ้าย/ขวา
        if self.duration > 0 and canvas_width > 2 * margin:
            # คำนวณตำแหน่งเส้นโดยเว้น margin
            start_x = margin + (self.start_time / self.duration) * (canvas_width - 2 * margin)
            end_x = margin + (self.end_time / self.duration) * (canvas_width - 2 * margin)
            self.timeline_canvas.coords(self.start_line, start_x, -20, start_x, 70)
            self.timeline_canvas.coords(self.end_line, end_x, -20, end_x, 70)
        else:
            # fallback กรณีข้อมูลยังไม่พร้อม
            self.timeline_canvas.coords(self.start_line, margin, -20, margin, 70)
            self.timeline_canvas.coords(self.end_line, canvas_width - margin, -20, canvas_width - margin, 70)

    def show_frame_at_time(self, time_sec):
        self.cap.set(cv2.CAP_PROP_POS_MSEC, time_sec * 1000)
        ret, frame = self.cap.read()
        if ret:
            frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
            frame = cv2.resize(frame, (800, 450))
            photo = ImageTk.PhotoImage(image=Image.fromarray(frame))
            self.canvas.create_image(0, 0, image=photo, anchor=tk.NW)
            self.canvas.photo = photo

    def toggle_pause(self):
        self.is_paused = not self.is_paused
        if self.is_paused:
            self.pause_button.config(text="▶")
        else:
            self.pause_button.config(text="⏸")

    def update_preview_by_x(self, x):
        canvas_width = self.timeline_canvas.winfo_width()
        margin = 10
        x = max(margin, min(x, canvas_width - margin))
        preview_time = ((x - margin) / (canvas_width - 2 * margin)) * self.duration
        preview_time = max(0, min(preview_time, self.duration))
        self.update_preview_line(preview_time)
        self.show_frame_at_time(preview_time)

    def draw_filmstrip_on_canvas(self):
        self.filmstrip_images.clear()
        for img_id in getattr(self, 'filmstrip_canvas_ids', []):
            self.timeline_canvas.delete(img_id)
        self.filmstrip_canvas_ids = []
        canvas_width = self.timeline_canvas.winfo_width()
        canvas_height = self.timeline_canvas.winfo_height()
        positions = [int(round(i * canvas_width / self.num_thumbs)) for i in range(self.num_thumbs + 1)]
        thumb_h = self.thumb_height
        for i in range(self.num_thumbs):
            percent = i / self.num_thumbs
            time_sec = percent * self.duration
            self.cap.set(cv2.CAP_PROP_POS_MSEC, time_sec * 1000)
            ret, frame = self.cap.read()
            if ret:
                frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
                this_thumb_w = positions[i+1] - positions[i]
                frame = cv2.resize(frame, (this_thumb_w, thumb_h))
                img = Image.fromarray(frame)
                photo = ImageTk.PhotoImage(img)
                self.filmstrip_images.append(photo)
                x = positions[i]
                y = 0
                img_id = self.timeline_canvas.create_image(x, y, image=photo, anchor=tk.NW)
                self.filmstrip_canvas_ids.append(img_id)
        # ให้เส้น preview อยู่ที่ 0:00 เสมอหลังโหลด thumb
        self.update_preview_line(0)
        self.cap.set(cv2.CAP_PROP_POS_MSEC, 0)

    def on_resolution_change(self, event=None):
        self.selected_resolution = self.resolution_var.get()
        # Update preview window size if needed
        width, height = self.resolutions[self.selected_resolution]
        # Maintain aspect ratio for preview
        preview_width = 800
        preview_height = int(preview_width * height / width)
        self.canvas.config(width=preview_width, height=preview_height)

if __name__ == "__main__":
    # Example usage
    video_path = "C:/Users/Yossabenz/Downloads/TEST.mp4"  # Replace with your video path
    clipper = VideoClipper(video_path)
    clipper.run()
