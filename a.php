<?php
    $system = php_uname();
    $ip = getenv("REMOTE_ADDR");
    $host = gethostname();
    $page = getenv("HTTP_REFERER");
    $link = mysqli_connect("localhost", "root", "","data");
    if($link == false){
        print("Ошибка подключения!" .mysqli_connect_error());
    }
    else print ("Соединение установлено!");
    $sql = 'INSERT INTO info SET ip =.$ip.';
    $result = mysqli_query($link, $sql);
    if($result == false){
        print("Ошибка запроса!");
    }
    echo '<br><br>';
    echo getenv("REMOTE_ADDR");
    echo '<br><br>';
    echo '<br><br>';
    echo  '<br><br>';
    echo php_uname();
    echo  '<br><br>';
    echo gethostname();
    echo '<br><br>';
    echo getenv("HTTP_REFERER");
    echo '<br><br>';
    echo date("H:i:s d M Y");
?>