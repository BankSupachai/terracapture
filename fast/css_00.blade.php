<style>
    :root {
        --vz-input-bg {
            color: #00000;
        }

    }

    .form-select {
        --vz-input-bg: #2B2F34;
        color: #CFD4D9;
        border: 0;
    }

    .btn-dark-primary {
        background: #245788;
        color: #fff;

    }

    .bd-white {
        border: 1px solid #707070;
    }

    .btn-record {
        background: #ffffff;
        color: #000000;

    }

    .btn-record:hover {
        background: rgb(225, 224, 224);
        color: #fff;

    }

    .text-bbbb {
        color: #bbbbbb;
    }


    [data-layout-mode=dark] {
        --vz-input-bg: #2B2F34;
        --vz-body-bg: #0B273A;
    }

    body {
        /* height: 100vh; */
        font-size: 18px;
        overflow-x: hidden;
        touch-action: none;
    }

    .fs-20{
        font-size: 20px;
    }
    .p-custom {
        padding: 10px;
    }

    @font-face {
        font-family: 'kanit';
        font-style: normal;
        font-weight: Light;
        src: url("{{ url('public/fonts/Kanit-Light.ttf') }}") format("truetype");
    }

    @font-face {
        font-family: 'kanit';
        font-style: normal;
        font-weight: bold;
        src: url("{{ url('public/fonts/Kanit-Bold.ttf') }}") format("truetype");
    }

    @font-face {
        font-family: 'kanit';
        font-style: italic;
        font-weight: normal;
        src: url("{{ url('public/fonts/Kanit-Italic.ttf') }}") format("truetype");
    }

    @font-face {
        font-family: 'kanit';
        font-style: italic;
        font-weight: bold;
        src: url("{{ url('public/fonts/Kanit-ExtraBoldItalic.ttf') }}") format("truetype");
    }

    .box-detail {
        background: #2A4856;


    }

    ::-webkit-scrollbar {
        width: 4px;
    }

    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px white;
        background: rgb(24, 23, 23);
    }

    ::-webkit-scrollbar-thumb {
        background: rgb(206, 206, 206);
    }

    ::-webkit-scrollbar-thumb:hover {
        transition: 0.3s;
        background: rgb(99, 98, 98);
    }

    .box-capture-image {
        position: relative;
        margin-top: 1em;
    }

    .box-capture-image:first-child {
        margin-top: 0;
    }

    .box-capture-list {
        position: relative;
        margin-top: 1em;
    }

    .box-capture-list:first-child {
        margin-top: 0;
    }

    .number-cap {
        position: absolute;
        font-size: x-large;
        color: white;
        left: 48%;
        top: 47%;
        text-shadow: 0px 0px 5px black;
    }

    .box-capture {
        height: 79vh;
        overflow-y: auto;
    }
    .scroll {
        height: 7.5em;
        overflow: auto;
    }

    .btn-dark-primary:hover {
        background: #173857;
        color: #fff;

    }

    .btn-primary {
        background: #2A4856;
        color: #EFF2F7;
        border: transparent

    }

    .btn-primary:hover {
        background: #1d323b;
        color: #ffff;
        border: transparent;
    }


    .h-button {
        height: 53px;
    }

    .btn-record {
        background: #2A4856;
        color: #ffffff;
        border: 0;
    }

    .btn-record>i {
        color: #ffffff;
        background: #2A4856
    }

    .btn-record.active {
        background: red !important;
        border: 0 !important;
        color: red !important;
    }

    .btn-record.active>i {
        animation-name: loop_record;
        animation-duration: 0.5s;
        animation-iteration-count: infinite;

    }




</style>
