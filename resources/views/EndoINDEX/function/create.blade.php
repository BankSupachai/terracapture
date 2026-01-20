    <meta name="csrf-token" content="{{csrf_token()}}"/>

    {{inputform('function','createfunction')}}
        <input type="text" name="function_name"><br>
        <button type="submit">ตกลง</button>
    {{endinputform('function','createfunction')}}
