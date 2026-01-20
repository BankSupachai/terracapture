cd "C:\Program Files\VideoLAN\VLC"

start vlc -vvv -Idummy rtsp://user:1234@127.0.0.1:554/session0.mpg --sout #transcode{vcodec=MJPG,venc=ffmpeg{strict=1},fps=40,width=1920,height=1080}:standard{access=http{mime=multipart/x-mixed-replace;boundary=--7b3cc56e5f51db803f790dad720ed50a},mux=mpjpeg,dst=:8081/}
exit
