<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.css') }}" rel="stylesheet">

    <style>
        .photo-container {
            height: 100vh;
            overflow-y: auto;
            padding: 0 0 15px 0;
            background: #808080;
            border-radius: 0 0 12px 12px;
        }
        .photo-header {
            background: #808080;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 0 0 8px 8px;
            margin-bottom: 12px;
        }
        .media-item {
            margin-bottom: 16px;
            cursor: pointer;
            position: relative;
            background: #808080;
            border-radius: 12px;
            overflow: hidden;
            border: 3px solid transparent;
            transition: border 0.2s;
        }
        .photo-thumb {
            padding: 4px 8px 4px 8px;
            margin-left: 8px;
            margin-right: 8px;
        }
        .media-item.selected {
            border: 3px solid #fff;
            background: #808080;
        }
        .thumb-number {
            position: absolute;
            top: 8px;
            left: 8px;
            background: rgba(0,0,0,0.5);
            color: #fff;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 6px;
            padding: 2px 8px;
            z-index: 2;
        }
        .media-item:hover {
            opacity: 0.8;
        }
        .preview-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            position: relative;
            background-color: #535353;
            overflow: hidden;
        }
        .preview-image {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
            transition: transform 0.3s ease;
            cursor: grab;
            user-select: none;
            -webkit-user-drag: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        .preview-image.move-active {
            cursor: grabbing;
        }
        .preview-video {
            max-width: 100%;
            max-height: 90vh;
        }
        .video-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        .default-video-thumb {
            background-color: #000;
            width: 100%;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .zoom-controls {
            width: 100%;
            background: rgba(50, 50, 50, 0.95);
            border-radius: 0 0 8px 8px;
            z-index: 10;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        .zoom-controls button {
            background: transparent;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 5px 24px;
            margin: 0 16px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 400;
            transition: background 0.2s, color 0.2s;
        }
        .zoom-controls button:hover {
            background: #fff;
            color: #222;
        }
        .zoom-controls button.active {
            background: #fff;
            color: #222;
        }
    </style>
</head>

<body>
    <div class="row" style="margin:0;">
        <div class="col-2">
            <div class="photo-container">
                <div class="photo-header mt-2">Photo & Video ({{ count(($tb_case->photo??[])) + count(($tb_case->video??[])) }})</div>
                <div id="photoList">
                @php $idx = 1; @endphp
                @foreach (($tb_case->photo??[]) as $photo)
                    <div class="media-item photo-thumb" data-idx="{{ $idx }}" onclick="showPreviewAndHighlight('{{ $store . '/' . $hn . '/' . $date . '/' . $photo['na'] }}', 'image', {{ $idx }})">
                        <div class="thumb-number">{{ $idx }}</div>
                        <img src="{{ $store . '/' . $hn . '/' . $date . '/' . $photo['na'] }}" alt="" width="100%">
                    </div>
                    @php $idx++; @endphp
                @endforeach
                @foreach (($tb_case->video??[]) as $video)
                    @php
                        $videoFile = is_array($video) ? ($video['na'] ?? '') : $video;
                        $videoUrl = $store . '/' . $hn . '/' . $date . '/vdo/' . $videoFile;
                        $thumbPath = $store . '/' . $hn . '/' . $date . '/vdo/' . (is_string($videoFile) ? str_replace(['.mp4', '.MP4'], '.jpg', $videoFile) : '');
                    @endphp
                    <div class="media-item photo-thumb" data-idx="{{ $idx }}" onclick="showPreviewAndHighlight('{{ $videoUrl }}', 'video', {{ $idx }})">
                        <div class="thumb-number">{{ $idx }}</div>
                        @if(file_exists(public_path($thumbPath)))
                            <img src="{{ $thumbPath }}" alt="" width="100%">
                        @else
                            <div class="default-video-thumb">
                                <span class="video-icon">▶</span>
                            </div>
                        @endif
                    </div>
                    @php $idx++; @endphp
                @endforeach
                </div>
            </div>
        </div>
        <div class="col-10" style="overflow-y: auto;  background-color:#535353;">
            <div class="row" style="margin-bottom:0;">
                <div class="zoom-controls" id="zoomControls" style="display: flex; flex-direction: row; justify-content: center; align-items: flex-end; gap: 24px;">
                    <button id="moveBtn" onclick="moveMode()" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-width: 64px;">
                        <i class="ri-drag-move-2-line" style="font-size: 1.5em;"></i>
                        <span style="font-size: 0.95em;">Move</span>
                    </button>
                    <button onclick="zoomIn()" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-width: 64px;">
                        <i class="ri-zoom-in-line" style="font-size: 1.5em;"></i>
                        <span style="font-size: 0.95em;">Zoom In</span>
                    </button>
                    <button onclick="zoomOut()" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-width: 64px;">
                        <i class="ri-zoom-out-line" style="font-size: 1.5em;"></i>
                        <span style="font-size: 0.95em;">Zoom Out</span>
                    </button>
                    <button onclick="resetZoom()" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-width: 64px;">
                        <i class="ri-reset-line" style="font-size: 1.5em;"></i>
                        <span style="font-size: 0.95em;">Reset</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="preview-container">
                    <img id="previewImage" class="preview-image" src="" alt="Preview" style="display: none;">
                    <video id="previewVideo" class="preview-video" controls style="display: none;"></video>
                    <h4 id="noMediaMessage">Select a media to preview</h4>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentZoom = 1;
        const ZOOM_STEP = 0.1;
        const MAX_ZOOM = 3;
        const MIN_ZOOM = 0.5;
        let isMoveMode = false;
        let isDragging = false;
        let dragStart = { x: 0, y: 0 };
        let imgOffset = { x: 0, y: 0 };

        function showPreviewAndHighlight(mediaUrl, type, idx) {
            showPreview(mediaUrl, type);
            document.querySelectorAll('.media-item.photo-thumb').forEach(function(el) {
                el.classList.remove('selected');
            });
            var selected = document.querySelector('.media-item.photo-thumb[data-idx="'+idx+'"]');
            if(selected) selected.classList.add('selected');
            resetImagePosition();
        }

        function showPreview(mediaUrl, type) {
            const previewImage = document.getElementById('previewImage');
            const previewVideo = document.getElementById('previewVideo');
            const noMediaMessage = document.getElementById('noMediaMessage');

            if (type === 'image') {
                previewImage.src = mediaUrl;
                previewImage.style.display = 'block';
                previewVideo.style.display = 'none';
                previewVideo.pause();
                currentZoom = 1;
                previewImage.style.transform = `scale(${currentZoom}) translate(0px, 0px)`;
                imgOffset = { x: 0, y: 0 };
                isMoveMode = false;
                document.getElementById('moveBtn').classList.remove('active');
            } else if (type === 'video') {
                previewVideo.style.display = 'block';
                previewImage.style.display = 'none';
                previewVideo.pause();
                previewVideo.removeAttribute('src');
                previewVideo.setAttribute('src', mediaUrl);
                previewVideo.load();
                previewVideo.play().catch(function(error) {
                    console.log("Video autoplay failed:", error);
                });
            }
            noMediaMessage.style.display = 'none';
        }

        function zoomIn() {
            if (currentZoom < MAX_ZOOM) {
                currentZoom += ZOOM_STEP;
                updateZoom();
            }
        }

        function zoomOut() {
            if (currentZoom > MIN_ZOOM) {
                currentZoom -= ZOOM_STEP;
                updateZoom();
            }
        }

        function resetZoom() {
            currentZoom = 1;
            updateZoom();
            resetImagePosition();
        }

        function updateZoom() {
            const previewImage = document.getElementById('previewImage');
            previewImage.style.transform = `scale(${currentZoom}) translate(${imgOffset.x}px, ${imgOffset.y}px)`;
        }

        function resetImagePosition() {
            imgOffset = { x: 0, y: 0 };
            updateZoom();
        }

        // Add mouse wheel zoom support
        document.getElementById('previewImage').addEventListener('wheel', function(e) {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomIn();
            } else {
                zoomOut();
            }
        });

        // Move mode toggle
        function moveMode() {
            isMoveMode = !isMoveMode;
            const btn = document.getElementById('moveBtn');
            if (isMoveMode) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        }

        // Drag to move image
        const previewImage = document.getElementById('previewImage');
        previewImage.addEventListener('mousedown', function(e) {
            if (!isMoveMode || previewImage.style.display === 'none') return;
            e.preventDefault();
            isDragging = true;
            previewImage.classList.add('move-active');
            dragStart.x = e.clientX;
            dragStart.y = e.clientY;
            previewImage.style.cursor = 'grabbing';
        });
        document.addEventListener('mousemove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
            const dx = e.clientX - dragStart.x;
            const dy = e.clientY - dragStart.y;
            imgOffset.x += dx;
            imgOffset.y += dy;
            dragStart.x = e.clientX;
            dragStart.y = e.clientY;
            updateZoom();
        });
        document.addEventListener('mouseup', function(e) {
            if (isDragging) {
                e.preventDefault();
                isDragging = false;
                previewImage.classList.remove('move-active');
                previewImage.style.cursor = isMoveMode ? 'grab' : 'default';
            }
        });
    </script>
</body>

</html>
