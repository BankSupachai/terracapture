<style>
    /*************** SCROLLBAR BASE CSS ***************/

    .scroll-wrapper {
        overflow: hidden !important;
        padding: 0 !important;
        position: relative;
    }

    .scroll-wrapper>.scroll-content {
        border: none !important;
        box-sizing: content-box !important;
        height: auto;
        left: 0;
        margin: 0;
        max-height: none;
        max-width: none !important;
        overflow: scroll !important;
        padding: 0;
        position: relative !important;
        top: 0;
        width: auto !important;
    }

    .scroll-wrapper>.scroll-content::-webkit-scrollbar {
        height: 0;
        width: 0;
    }

    .scroll-element {
        display: none;
    }

    .scroll-element,
    .scroll-element div {
        box-sizing: content-box;
    }

    .scroll-element.scroll-x.scroll-scrollx_visible,
    .scroll-element.scroll-y.scroll-scrolly_visible {
        display: block;
    }

    .scroll-element .scroll-bar,
    .scroll-element .scroll-arrow {
        cursor: default;
    }

    .scroll-textarea {
        border: 1px solid #cccccc;
        border-top-color: #999999;
    }

    .scroll-textarea>.scroll-content {
        overflow: hidden !important;
    }

    .scroll-textarea>.scroll-content>textarea {
        border: none !important;
        box-sizing: border-box;
        height: 100% !important;
        margin: 0;
        max-height: none !important;
        max-width: none !important;
        overflow: scroll !important;
        outline: none;
        padding: 2px;
        position: relative !important;
        top: 0;
        width: 100% !important;
    }

    .scroll-textarea>.scroll-content>textarea::-webkit-scrollbar {
        height: 0;
        width: 0;
    }




    /*************** SCROLLBAR RAIL ***************/

    .scrollbar-rail>.scroll-element,
    .scrollbar-rail>.scroll-element div {
        border: none;
        margin: 0;
        overflow: hidden;
        padding: 0;
        position: absolute;
        z-index: 10;
    }

    .scrollbar-rail>.scroll-element {
        background-color: #ffffff;
    }

    .scrollbar-rail>.scroll-element div {
        display: block;
        height: 100%;
        left: 0;
        top: 0;
        width: 100%;
    }

    .scrollbar-rail>.scroll-element .scroll-element_size {
        background-color: #999;
        background-color: rgba(0, 0, 0, 0.3);
    }

    .scrollbar-rail>.scroll-element .scroll-element_outer:hover .scroll-element_size {
        background-color: #666;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .scrollbar-rail>.scroll-element.scroll-x {
        bottom: 0;
        height: 12px;
        left: 0;
        min-width: 100%;
        padding: 3px 0 2px;
        width: 100%;
    }

    .scrollbar-rail>.scroll-element.scroll-y {
        height: 100%;
        min-height: 100%;
        padding: 0 2px 0 3px;
        right: 0;
        top: 0;
        width: 12px;
    }

    .scrollbar-rail>.scroll-element .scroll-bar {
        background-color: #3699FF;

        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;

        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }

    .scrollbar-rail>.scroll-element .scroll-element_outer:hover .scroll-bar {
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }

    /* scrollbar height/width & offset from container borders */

    .scrollbar-rail>.scroll-content.scroll-scrolly_visible {
        left: -17px;
        margin-left: 17px;
    }

    .scrollbar-rail>.scroll-content.scroll-scrollx_visible {
        margin-top: 17px;
        top: -17px;
    }

    .scrollbar-rail>.scroll-element.scroll-x .scroll-bar {
        height: 10px;
        min-width: 10px;
        top: 1px;
    }

    .scrollbar-rail>.scroll-element.scroll-y .scroll-bar {
        left: 1px;
        min-height: 10px;
        width: 10px;
    }

    .scrollbar-rail>.scroll-element.scroll-x .scroll-element_outer {
        height: 15px;
        left: 5px;
    }

    .scrollbar-rail>.scroll-element.scroll-x .scroll-element_size {
        height: 2px;
        left: -10px;
        top: 5px;
    }

    .scrollbar-rail>.scroll-element.scroll-y .scroll-element_outer {
        top: 5px;
        width: 15px;
    }

    .scrollbar-rail>.scroll-element.scroll-y .scroll-element_size {
        left: 5px;
        top: -10px;
        width: 2px;
    }

    /* update scrollbar offset if both scrolls are visible */

    .scrollbar-rail>.scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_size {
        left: -25px;
    }

    .scrollbar-rail>.scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_size {
        top: -25px;
    }

    .scrollbar-rail>.scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_track {
        left: -25px;
    }

    .scrollbar-rail>.scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_track {
        top: -25px;
    }
</style>
<style>
    .aa {
        position: relative;
    }

    .bb {
        position: absolute;
        right: 16px;
        top: 3px;
        width: 26px;
        background-color: #0AB39C;
        border-radius: 4px;
        color: #ffffff;
        /* border: 3px solid #0AB39C; */

    }

    .liheight_modal tr {
        line-height: 11px !important;
    }

    .cn {
        align-items: center;
    }

    @media (min-width: 992px) {


        .modal-xl {
            max-width: 90% !important;
        }
    }

    .d-show {
        display: block;
        transform: 0.5s;
    }

    .d-hide {
        transform: 0.5s;
        display: none;
    }

    .vtc {
        vertical-align: inherit !important;
    }

    .highlight {
        /* background:#00d9ff; */
        background: yellow;
        padding: 1px;
        /* border:#00CC00 dotted 1px; */
    }
</style>

<style>
    ul.jq-input-dropdown {
        border: none !important;
    }

    .toolbar {
        opacity: 0;
    }

    .toolbar-row-left {
        opacity: 0;
    }

    .zoom-display,
    .action-buttons .button-group {
        opacity: 0;
        position: absolute;
    }


    /* .modal-content{
            background: none !important;
        } */
    ul.jq-input-dropdown,
    ul.jq-input-dropdown li {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent;
    }

    ul.jq-input-dropdown {
        border: 1px solid #CCC;
        list-style: none;
        display: none;
        z-index: 200;
        min-width: 10%;
    }

    ul.jq-input-dropdown li:hover {
        background-color: #C0C0C0;
        color: #fff;
        cursor: pointer;
    }

    .set-0 {
        margin: 0 !important;
    }

    .w100 {
        width: 100%;
    }

    /* .col-12{
        padding: 0;
    } */
</style>

<style>
    /*************** SCROLLBAR BASE CSS ***************/
    .scroll-wrapper {
        overflow: hidden !important;
        padding: 0 !important;
        position: relative;
    }

    .scroll-wrapper>.scroll-content {
        border: none !important;
        box-sizing: content-box !important;
        height: auto;
        left: 0;
        margin: 0;
        max-height: none;
        max-width: none !important;
        overflow: scroll !important;
        padding: 0;
        position: relative !important;
        top: 0;
        width: auto !important;
    }

    .scroll-wrapper>.scroll-content::-webkit-scrollbar {
        height: 0;
        width: 0;
    }

    .scroll-element {
        display: none;
    }

    .scroll-element,
    .scroll-element div {
        box-sizing: content-box;
    }

    .scroll-element.scroll-x.scroll-scrollx_visible,
    .scroll-element.scroll-y.scroll-scrolly_visible {
        display: block;
    }

    .scroll-element .scroll-bar,
    .scroll-element .scroll-arrow {
        cursor: default;
    }

    .scroll-textarea {
        border: 1px solid #cccccc;
        border-top-color: #999999;
    }

    .scroll-textarea>.scroll-content {
        overflow: hidden !important;
    }

    .scroll-textarea>.scroll-content>textarea {
        border: none !important;
        box-sizing: border-box;
        height: 100% !important;
        margin: 0;
        max-height: none !important;
        max-width: none !important;
        overflow: scroll !important;
        outline: none;
        padding: 2px;
        position: relative !important;
        top: 0;
        width: 100% !important;
    }

    .scroll-textarea>.scroll-content>textarea::-webkit-scrollbar {
        height: 0;
        width: 0;
    }




    /*************** SCROLLBAR DYNAMIC ***************/
    .scroll-wrapper>.scroll-scrollx_visible:nth-child(2)>.scroll-element_outer {
        display: none !important;
    }

    .scrollbar-dynamic>.scroll-element,
    .scrollbar-dynamic>.scroll-element div {
        background: none;
        border: none;
        margin: 0;
        padding: 0;
        position: absolute;
        z-index: 10;
    }

    .scrollbar-dynamic>.scroll-element div {
        display: block;
        height: 100%;
        left: 0;
        top: 0;
        width: 100%;
    }

    .scrollbar-dynamic>.scroll-element.scroll-x {
        bottom: 2px;
        height: 7px;
        left: 0;
        min-width: 100%;
        width: 100%;
    }

    .scrollbar-dynamic>.scroll-element.scroll-y {
        height: 100%;
        min-height: 100%;
        right: 2px;
        top: 0;
        width: 7px;
    }

    .scrollbar-dynamic>.scroll-element .scroll-element_outer {
        opacity: 0.3;

        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
    }

    .scrollbar-dynamic>.scroll-element .scroll-element_size {
        background-color: #cccccc;
        opacity: 0;

        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;

        -webkit-transition: opacity 0.2s;
        -moz-transition: opacity 0.2s;
        -o-transition: opacity 0.2s;
        -ms-transition: opacity 0.2s;
        transition: opacity 0.2s;
    }

    .scrollbar-dynamic>.scroll-element .scroll-bar {
        background-color: #6c6e71;

        -webkit-border-radius: 7px;
        -moz-border-radius: 7px;
        border-radius: 7px;
    }

    /* scrollbar height/width & offset from container borders */

    .scrollbar-dynamic>.scroll-element.scroll-x .scroll-bar {
        bottom: 0;
        height: 7px;
        min-width: 24px;
        top: auto;
    }

    .scrollbar-dynamic>.scroll-element.scroll-y .scroll-bar {
        left: auto;
        min-height: 24px;
        right: 0;
        width: 7px;
    }

    .scrollbar-dynamic>.scroll-element.scroll-x .scroll-element_outer {
        bottom: 0;
        top: auto;
        left: 2px;

        -webkit-transition: height 0.2s;
        -moz-transition: height 0.2s;
        -o-transition: height 0.2s;
        -ms-transition: height 0.2s;
        transition: height 0.2s;
    }

    .scrollbar-dynamic>.scroll-element.scroll-y .scroll-element_outer {
        left: auto;
        right: 0;
        top: 2px;

        -webkit-transition: width 0.2s;
        -moz-transition: width 0.2s;
        -o-transition: width 0.2s;
        -ms-transition: width 0.2s;
        transition: width 0.2s;
    }

    .scrollbar-dynamic>.scroll-element.scroll-x .scroll-element_size {
        left: -4px;
    }

    .scrollbar-dynamic>.scroll-element.scroll-y .scroll-element_size {
        top: -4px;
    }


    /* update scrollbar offset if both scrolls are visible */

    .scrollbar-dynamic>.scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_size {
        left: -11px;
    }

    .scrollbar-dynamic>.scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_size {
        top: -11px;
    }


    /* hover & drag */

    .scrollbar-dynamic>.scroll-element:hover .scroll-element_outer,
    .scrollbar-dynamic>.scroll-element.scroll-draggable .scroll-element_outer {
        overflow: hidden;

        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
        filter: alpha(opacity=70);
        opacity: 0.7;
    }

    .scrollbar-dynamic>.scroll-element:hover .scroll-element_outer .scroll-element_size,
    .scrollbar-dynamic>.scroll-element.scroll-draggable .scroll-element_outer .scroll-element_size {
        opacity: 1;
    }

    .scrollbar-dynamic>.scroll-element:hover .scroll-element_outer .scroll-bar,
    .scrollbar-dynamic>.scroll-element.scroll-draggable .scroll-element_outer .scroll-bar {
        height: 100%;
        width: 100%;

        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
    }

    .scrollbar-dynamic>.scroll-element.scroll-x:hover .scroll-element_outer,
    .scrollbar-dynamic>.scroll-element.scroll-x.scroll-draggable .scroll-element_outer {
        height: 20px;
        min-height: 7px;
    }

    .scrollbar-dynamic>.scroll-element.scroll-y:hover .scroll-element_outer,
    .scrollbar-dynamic>.scroll-element.scroll-y.scroll-draggable .scroll-element_outer {
        min-width: 7px;
        width: 20px;
    }


    .pd_col {
        align-items: center;
    }

    .pd_col .col-4,
    .pd_col .col-8 {
        padding: 2px;
    }

    .tab-endo-note a,
    .tab-endo-note i {
        color: rgb(46, 44, 44) !important;
    }

    .tab-endo-note:hover {
        transition: 0.3s;
        color: white !important;
        background: #245788;
    }

    .tab-endo-note:hover a,
    .tab-endo-note:hover i {
        color: white !important;
    }

    .tab-endo-note.active {
        color: white !important;
        background: #245788;
    }

    .tab-endo-note.active a,
    .tab-endo-note.active i {
        color: white !important;
    }

    .btn-checkbox {
        background: #245788;
        color: #fff;
        /* margin-bottom: 1em; */
    }

    .btn-checkbox:hover {
        color: #fff;
        background: #0f2e4c
    }

    .material-icons.md-18 {
        font-size: 18px;
    }

    .material-icons.md-24 {
        font-size: 24px;
    }

    .material-icons.md-36 {
        font-size: 36px;
    }

    .material-icons.md-48 {
        font-size: 48px;
    }

    .card-shadowless .form-check-input {
        margin-left: 0 !important;
    }

    /* .card-shadowless .form-check-label {
        margin-left: 0.5em !important;
    } */

    .to-checkbox {
        border-radius: 0 !important;
        content: 'w'
    }

    .to-checkbox.form-check-input:checked[type=radio] {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e") !important;
    }

    .to-checkbox {
        appearance: none;
        border: 1px solid #d3d3d3;
        width: 16px;
        height: 16px;
        content: none;
        outline: none;
        margin: 0;
    }

    .to-checkbox:checked {
        appearance: none;
        outline: none;
        padding: 0;
        content: none;
        border: none;
    }

    .to-checkbox:checked::before {
        width: 16px;
        height: 16px;
        position: absolute;
        /* color: green !important; */
        content: "\00A0\2713\00A0" !important;
        border: 1px solid #d3d3d3;
        font-weight: bolder;
        font-size: 9px;
    }


    .bg-report {
        background: #245788;
        color: #fff;
    }

    .img-report {
        max-width: 100%;
        height: 75px;
        border-radius: 50%;
        margin-left: 7px;
    }

    .btn-editp {
        background: #245788;
        color: #fff;
        border: 1px solid #fff;
        border-radius: 5px;
        margin-left: 8px;
        box-shadow: 0px 3px #00000040;
    }

    .btn-editp:hover {
        background: #fff;
        color: #245788;
        border: 1px solid #fff;
    }

    .h-85 {
        height: 85px;
    }

    .btn-checkbox {
        background: #245788;
        color: #fff;
        margin-bottom: 1em;
    }

    .btn-checkbox:hover {
        color: #fff;
        background: #0f2e4c
    }

    .text-pos {
        margin-top: 5.5em;
    }

    .material-icons.md-18 {
        font-size: 18px;
    }

    .material-icons.md-24 {
        font-size: 24px;
    }

    .material-icons.md-36 {
        font-size: 36px;
    }

    .material-icons.md-48 {
        font-size: 48px;
    }

    .margin-pos {
        margin-top: 45px;
    }

        .nav-success .nav-size {
            height: 47px;
            width: 247px;
            font-size: 18px;
        }

    /* .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #245788;
    } */

    .pic-report {
        width: 100%;
        height: 150px;
    }

    .btn-gray {
        background: #CED4DA;
        border-left: 1px solid #707070;
        border-right: 1px solid #707070;
        border-radius: 0;

    }

    .btn-gray:hover {
        background: #9fa4a9;
    }

    .w-number {
        width: 48px;
    }

    .an {
        display: flex;
        align-items: center;
    }

    .other-pos {
        margin-top: 13em;
    }

    .mt-28 {
        margin-top: 28px;
    }

    .pic-res {
        display: none;
    }

    .btn-res {
        display: none;
    }

    .tap-report {
        height: 40px;
        padding: 7px;
    }


    /* .Finding-res{
            display: none;
                } */
    /* .btnp-pos {
                display: flex;
                gap: 11px;
                justify-content: end;
            } */
    @media only screen and (max-width: 1200px) {
        .btn-res {
            display: flex;
        }

        .btn-main {
            display: none;
        }

        .pic-res {
            display: flex;
        }

        .pic-main {
            display: none;
        }

        .other-pos {
            margin-top: 1em;
        }

        .hide-btn {
            display: none;
        }

        .btnres-hide {
            display: none;
        }

        .mt-res-2 {
            margin-top: 1em;
        }

        .img-with-btn-res {
            text-align: center;

        }

        .btn-editp {
            display: block;
            margin: auto;
        }

    }
</style>
