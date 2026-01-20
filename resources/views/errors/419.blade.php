<?php
    session_start();
    use App\Models\mongo;
    $value['datetime']  = date("Y-m-d H:i:s");
    $value['error']     = "419";
    $value['url']       = url()->previous();
    Mongo::table('tb_logerror')->insert($value);
    $login = url()->previous();

    $_SESSION['page419'] = true;
    header("location:$login");
    exit(0);
?>
