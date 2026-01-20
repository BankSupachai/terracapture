<tr>
    <td class="h4 m-0">Host</td>
    <td><input type="text" name="" id="host" class="form-control save-connect" value="{{@$data->host}}"></td>
</tr>
<tr>
    <td class="h4 m-0">Port</td>
    <td><input type="text" name="" id="port" class="form-control save-connect" value="{{@$data->port}}"></td>
</tr>
<tr>
    <td class="h4 m-0">Database</td>
    <td><input type="text" name="" id="database" class="form-control save-connect" value="{{@$data->database}}"></td>
</tr>
<tr>
    <td class="h4 m-0">Username</td>
    <td><input type="text" name="" id="username" class="form-control save-connect" value="{{@$data->username}}"></td>
</tr>
<tr>
    <td class="h4 m-0">Password</td>
    <td><input type="text" name="" id="password" class="form-control save-connect" value="{{@$data->password}}"></td>
</tr>
<tr>
    <td class="h4 m-0">Driver</td>
    <td>
        <select name="" id="driver" class="form-control">
            <option value="mysql" @if($data->driver=='mysql') selected @endif>Mysql</option>
            <option value="pgsql" @if($data->driver=='pgsql') selected @endif>Pgsql</option>
            <option value="sqlsrv" @if($data->driver=='sqlsrv') selected @endif>Sqlsrv</option>
            <option value="mongodb" @if($data->driver=='mongodb') selected @endif>Mongodb</option>
        </select>
    </td>
</tr>
<script>
    $('.save-connect').keyup(function(){
        var this_select = $(this).attr('id')
        var this_value  = $(this).val()
        var this_file   = $("#ls_file").val()
        update_connect(this_select,this_value,this_file)
    })
</script>
