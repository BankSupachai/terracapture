<script src="http://{{getconfig('admin')->server_name}}:3000/socket.io/socket.io.js"></script>
<script>
    var socket = io.connect('http://{{getconfig('admin')->server_name}}:3000');
    socket.emit('chat message','{{$id}}');
</script>
@php
sleep(1);
@endphp
