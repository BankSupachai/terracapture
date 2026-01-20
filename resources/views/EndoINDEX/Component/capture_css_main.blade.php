<style>


    /* -------------------------------------------- */



/*  การกำหนดค่าสีหลักของ Theame */

    :root {
        --vz-vertical-menu-bg-dark: #192d4b;
        --bg-cleam: #FEF2DF;
        --vz-breadcrumb-item-active-color: ##9599AD;

        /* --vz-input-bg: #f3f6f9; */


    }



    /* -------------------------------------------- */
    /* Font (การตั้งค่า ฟร้อนต่างๆ)  */
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
            font-weight: 400;
            src: url("{{ url('public/fonts/Kanit-Regular.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: 500;
            src: url("{{ url('public/fonts/Kanit-Medium.ttf') }}") format("truetype");
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



    /* -------------------------------------------- */


    /* Button btn */
    .btn-dark-primary {
        background: var(--vz-vertical-menu-bg-dark);
        color: white !important;
    }

    .bg-dark-primary {
        background: var(--vz-vertical-menu-bg-dark);
        color: white !important;
    }

    .btn-blue {
        background: #4675E9;
        color: #fff;
    }

    .btn-blue:disabled {
        background: #f3f6f9;
        color: #707070;
        border: 0px;
    }

    .btn-blue:hover {
        background: #16459a;
        color: #fff;
    }

    .btn-primary {
        background: #192d4b !important;
        color: #FFF !important;
    }


    .btn-orange {
        background: #DF6E51;
        color: #fff
    }

    .btn-orange:hover {
        background: #af5e49;
        color: #fff
    }

    .btn-primary:hover {
        background: #1e4366 !important;
        color: #fff !important;
    }

    .btn-procedure{
            background: #fff;
            color: #000;
            border: 1px solid #CED4DA;
            width: 100%;
            box-shadow: 1px 1px 1px 1px #00000040 ;

        }
        .btn-procedure:hover{
            /* border: 1px solid #00000088; */
            background: #192d4b;
            color: #fff;
        }




    /* -------------------------------------------- */

    /* text Color */
    .text-dark-index{
        color: #707070;
    }
    .text-index-darkness {
        color: #212529;
    }

    .text-index-dark {
        color: #495057;
    }

    .text-gray {
        color: #9599ad;
    }

    .text-soft-gray {
        color: #878A99
    }

    .text-color-b {
        color: #bbbbbb
    }

    .text-color-index {
        color: #192d4b;
    }

    .text-white-50{
            color: #ffffff80
        }

        .text-status-today {
            color: #FF8A72
        }

        .text-status-nextday {
            color: #FF2C00;
        }

        .text-status-otherday {
            color: var(--vz-heading-color);
        }

    /* -------------------------------------------- */







    /* -------------------------------------------- */

    /* Select 2  */


            *,
        *:before,
        *:after {
        box-sizing: border-box;
        }
        .select2-container--default .select2-results__option--selected {
            background: transparent;

        }
        .select2-container--default .select2-selection--single {
            background: #f3f6f9;
            border: 1px transparent solid !important;
            transition: box-shadow 0.3s ease-in;

        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: #192d4b;
            color: #ffffff;
            border: 0px !important;
        }
        .select2-container--default .select2-selection--multiple {
            background: #193D61;
            border: 0px !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            background: #192d4b;
            color: #ffffff;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #ffffff;
            border: 0px !important;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable
        {background: #192d4b !important;}
        .select2-results__option {color: #000000}
        .select2-dropdown {border: 1px solid #d4d6d8;}

        .select2-container .select2-selection--single .select2-selection__rendered {
                    padding-top: 5px;
                }
                .select2-container--default .select2-selection--single {
                    height: 38px;
                    border: 0px solid var(--vz-input-border) !important;
                }

                .select2-results__options::-webkit-scrollbar {
                    width: 8px;
                    background-clip: padding-box;
                }
                .select2-results__options::-webkit-scrollbar-track {
                    background-color: #f4f4f4;
                    height: 8px;
                    border-right: 5px solid rgba(0, 0, 0, 0);
                    border-top: 5px solid rgba(0, 0, 0, 0);
                    border-bottom: 5px solid rgba(0, 0, 0, 0);
                }

                .select2-results__options::-webkit-scrollbar-thumb {
                    background-color: #9599ad;
                    border-right: 5px solid rgba(0, 0, 0, 0);
                    border-top: 5px solid rgba(0, 0, 0, 0);
                    border-bottom: 5px solid rgba(0, 0, 0, 0);
                    border-radius: 4px;
                }
    /* -------------------------------------------- */
</style>
