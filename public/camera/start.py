import subprocess
 
try:
    subprocess.call([r'D:\laragon\htdocs\endocapture5.0\public\camera\vlc_rtsp.bat']) 
except Exception as e:
    print('error', e)

