<!DOCTYPE html>
<html>
<body>

<h1>The Window Object</h1>
<h2>The localStorage Property</h2>

<p>Saved name is:</p>
<p id="demo"></p>

<script>
// ตั้งค่า cookie
// document.cookie = "username=johndoe";

// อ่านค่า cookie
var username = document.cookie.split("=")[1];

document.getElementById("demo").innerHTML = username;
</script>

</body>
</html>
