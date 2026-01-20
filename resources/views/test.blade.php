@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>

</style>

@endsection

@section('modal')


@endsection
@section('title-left')
    <h4 class="mb-sm-0">EXPORT DATA</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
        <li class="breadcrumb-item active">Export</li>
    </ol>
@endsection


@section('content')



    {{-- <input type="file" id="dicom-file-input" accept=".dcm">
<div id="cornerstone-element"></div> --}}



@endsection


@section('script')
{{-- <script>
    // Include required CornerstoneJS3D library (version 0.18.1)
const cornerstone3D = await import('cornerstone3D/dist/cornerstone3D.min.js'); // Replace with appropriate path if not using a bundler

const dicomFileInput = document.getElementById('dicom-file-input');
const cornerstoneElement = document.getElementById('cornerstone-element');

dicomFileInput.addEventListener('change', async (event) => {
  const file = event.target.files[0];

  if (!file || !file.type.match('image/dicom')) {
    console.error('Invalid file uploaded. Please upload a DICOM file.');
    return;
  }

  const byteArray = await new Promise((resolve) => {
    const reader = new FileReader();
    reader.readAsArrayBuffer(file);
    reader.onload = () => resolve(reader.result);
  });

  const threeDImage = await cornerstone3D.enableVolume(cornerstoneElement);
  const imageId = await cornerstone3D.loadAndRenderVolume(byteArray, cornerstoneElement);

  // Adjust viewport as needed (optional)
  cornerstone3D.setViewport(cornerstoneElement, {
    camera: {
      position: [0, 0, 100],
    },
  });
});

</script> --}}
<script>
  function formatUnixTimeToHHMM(unixTime) {
      const date = new Date(unixTime * 1000);
      const hours = date.getHours();
      const minutes = date.getMinutes();
      const formattedHours = hours.toString().padStart(2, '0');
      const formattedMinutes = minutes.toString().padStart(2, '0');
      const timeInHHMM = `${formattedHours}:${formattedMinutes}`;
      return timeInHHMM;
  }

  async function getUserToken() {
      const decode = await liff.getDecodedIDToken();
      const token = await liff.getAccessToken()

      // $('.token').html(token)
      // $('.url').html(decode.iss)
      // $('.userid').html(decode.sub)
      // $('.channelid').html(decode.aud)
      // $('.authtime').html(decode.auth_time)
      // $('.exp').html(formatUnixTimeToHHMM(decode.exp))
      // $('.name').html(decode.name)
      // $('.email').html(decode.email)

      return decode.email

  }


  async function main(){
      await liff.init({ liffId: '1656429675-KQdyep98'})

      if (liff.isLoggedIn()) {
          let email = await getUserToken()
          let urlParams = new URLSearchParams(window.location.search);
          let page = urlParams.get('page');

          let pageToSubpath = {
              'export': '/exportindex',
              'viewer': '/terra/w-viewer',
              'home': '/home',
          };
          let subpath = pageToSubpath[page] || '';

          if(subpath){
              $.post("{{url('api/home')}}", {
                  event: "line_login",
                  email:email,
                  page:subpath
              }, function (data, status) {
                  console.log(data);
                  if(data && data != ""){
                      window.location.href = "{{url('')}}"+subpath
                  }
              })
          }
      }
  }
  main()
</script>
@endsection
