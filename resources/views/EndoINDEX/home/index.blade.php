<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#btn1").click(function(){
    alert("Text: " + $("#test").text());
  });
  $("#btn2").click(function(){

    const myJSON = '{"name":"John", "age":31, "city":"New York"}';
    const myObj = JSON.parse(myJSON);
    logFileText('public/component/aaa.html',myObj);
  });
});
</script>
</head>
<body>

<p id="flow">This is some <b>bold</b> text in a paragraph.</p>

<button id="btn1">Show Text</button>
<button id="btn2">Show HTML</button>
<div id="dayu"></div>
</body>
</html>





<script>



const logFileText = async (file,sss) => {

    console.log(sss,sss['name']);
    const response = await fetch(file)
    const text = await response.text()

    var aaa         = text.replaceAll("}}", "--@")
    var bbb         = aaa.replaceAll("{{$", "@--")

    var count       = (bbb.match(/@--/g) || []).length;
    let arr         = Array.from(Array(count), () => new Array(3));

    var regex       = /@--/gi, bbb, indices = [];
    var regex2      = /--@/gi, bbb, indices2 = [];
    while((result   = regex.exec(bbb))){indices.push(result.index);}
    while((result2  = regex2.exec(bbb))){indices2.push(result2.index);}

    var vartext = "";
    for (let i = 0; i<count; i++) {
        arr[i][0]   = indices[i];
        arr[i][1]   = indices2[i];
        arr[i][2]   = bbb.substring(indices[i],indices2[i]+3);
        arr[i][3]   = bbb.substring(indices[i]+3,indices2[i]);
        vartext     = bbb.substring(indices[i]+3,indices2[i]);
        if(sss[vartext]!=null){
            arr[i][4] = true;
        }else{
            arr[i][4] = false;
        }
    }

    arr.forEach(function(el, index) {
        if(arr[index][4]){
            bbb = bbb.replaceAll(arr[index][2], sss[arr[index][3]]);
        }else{
            bbb = bbb.replaceAll(arr[index][2], "");
        }
        console.log(index,el,arr[index][4]);
    });
    $('#dayu').html(bbb);
}


</script>
