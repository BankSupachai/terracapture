
        <br>
        <img src="images/ori-esign.png">
        <br>



        @php
        $path = 'images/ori-esign.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $ori    = base64_encode($data);
        $re     = strrev(base64_encode($data));

        echo $data;
        echo "<br><br>";
        echo $ori;
        echo "<br><br>";
        echo $re;
        @endphp


        <br>
        <br>
        <br>


        <img src='{{$base64}}'>
        <br>

        <br>
        @php
        $myfile = fopen("images/ori-esign.txt", "r") or die("Unable to open file!");
        $read = fread($myfile,filesize("images/ori-esign.txt"));
        echo $read;

        fclose($myfile);
        echo "<br>";
        $me     = strrev($read);
        echo "#################################<br>";
        echo '*************** '.$me.' **********************<br>';
        echo "#################################<br>";
        echo $ori;
        echo "#################################<br>";

        @endphp



