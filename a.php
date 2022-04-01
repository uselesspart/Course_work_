<?php
    //Объявление переменных
    $start_date=date_format(date_create($_POST['calendar1']), "H:i:s d M Y");
    $end_date = date_format(date_create($_POST['calendar2']), "H:i:s d M Y");
    $system = php_uname();
    $ip = getenv("REMOTE_ADDR");
    $host = gethostname();
    $page = getenv("HTTP_REFERER");
    $time = date("H:i:s d M Y");
    $link = mysqli_connect("localhost", "root", "","data");
    //Подключение к базе для записи данных пользователя
    //Запись данных пользователя в таблицу
    $sql = "INSERT INTO info SET ip = '.$ip.',  system ='.$system.', host='.$host.', page = '.$page.', time = '.$time.'";
    $result = mysqli_query($link, $sql);
    //Запросы на получение данных
    $sql = "SELECT id, ip, system, host, page, time FROM info WHERE(time > '.$start_date.' AND time < '.$end_date.')";
    $result = mysqli_query($link, $sql);
    $db = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $table = array(array());
    if(count($db) <= 0) print '<br>Не найдено запросов в выбранный временной промежуток<br>';
    else
    {
    $n = $db[count($db)-1]['id'] - $db[0]['id'];
    for($i = 0; $i < $n; $i++){
        $table[$i][1] = $db[$i]['ip'];
        $table[$i][2] = $db[$i]['system'];
        $table[$i][3] = $db[$i]['host'];
        $table[$i][4] = $db[$i]['page'];
        $table[$i][5] = $db[$i]['time'];
    }
    //Отрисовка таблицы
    echo '<table border = "1"';
    echo '<tr><td>IP</td><td>System</td><td>Host</td><td>Page</td><td>Time</td>';
    for($i = 0; $i < $n; $i++){
        echo '<tr>';
        for($j = 1; $j <= 5; $j++){
            echo "<td>  ".$table[$i][$j]." </td>";
        }
        echo '</tr>';
    }
    echo '</table>';
    }
?>