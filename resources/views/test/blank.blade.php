<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>This is a Heading</h1>
<p>This is a paragraph.</p>

</body>
</html>

<script>
   const apiToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NzA0NzE4NjcsImp0aSI6IjYzOTE2MGJiMTUxODAiLCJpc3MiOiJNZWRpY2FIZWFsdGhjYXJlIiwibmJmIjoxNjcwNDcwODY3LCJleHAiOjE2NzEwNzU2NjcsImRhdGEiOnsidWlkIjoiTWVkaWNhSGVhbHRoY2FyZSIsImdyb3VwIjoiMSIsImFwcCI6InRnZXZyYTFkODV3a2x4Mk80bnIzcmVlMXd4aGQzbXIzIn19.3S1JW1sSd9TfPvBjzgPKdZgHJR4TzKiJK19Dbya6nuo";
    const options = {
        'method': 'GET',
        'headers': {
        'authorization': 'Bearer ' + apiToken,
        'content-type': 'application/json',
        'accept': 'application/json'
    },
        'timeout': 5000
    };
let outputfromcanvas;
fetch('https://isuandok.med.cmu.ac.th/gateway/patient/hn/2803587', options).then(res=>{outputfromcanvas = res.json(); console.log(res.json())}).catch(err=>console.log("err: ", err))

</script>
