@php
    setcookie('uid', '', time() - 5000000, '/');
    $feature = getCONFIG('feature');
    $admin = getCONFIG('admin');
@endphp

@isset($admin->project)
    @if ($admin->project == 'capture')
        @include('capture.login.index')
    @else
        @include('auth.loginhtml')
    @endif
@else
    @include('auth.loginhtml')
@endisset
