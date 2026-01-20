    <style>
        @foreach($dateapp as $k=>$v)
            @if($v==1)  td[data-date="{{$k}}"]{background: #F5EEF8;}@endif
            @if($v==2)  td[data-date="{{$k}}"]{background: #EBDEF0;}@endif
            @if($v==3)  td[data-date="{{$k}}"]{background: #D7BDE2;}@endif
            @if($v==4)  td[data-date="{{$k}}"]{background: #C39BD3;}@endif
            @if($v==5)  td[data-date="{{$k}}"]{background: #AF7AC5;}@endif
            @if($v==6)  td[data-date="{{$k}}"]{background: #9B59B6;}@endif
            @if($v==7)  td[data-date="{{$k}}"]{background: #884EA0;}@endif
            @if($v==8)  td[data-date="{{$k}}"]{background: #76448A;}@endif
            @if($v==9)  td[data-date="{{$k}}"]{background: #633974;}@endif
            @if($v>9)   td[data-date="{{$k}}"]{background: #273746;}@endif
        @endforeach
    </style>
