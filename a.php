<html>
<head>
<title> Информация о запросах </title>
<style> 
    input{
        border-radius: 5px;
        width: 150px; /* Ширина кнопки */
        height: 30px; /* Высота */
        font-size: 15pt;
        position: absolute;
        top: -30%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%)
    }
    div.container1{
        font-size: 20pt;
        height: 10em;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%)
    }
</style>
</head>
<body>
<?php
    date_default_timezone_set('Europe/Moscow');
    //Объявление переменных
    $start_date=date_format(date_create($_POST['calendar1']), "Y-m-d H:i:s");
    $end_date = date_format(date_create($_POST['calendar2']), "Y-m-d H:i:s");
    $system = php_uname();
    $ip = getenv("REMOTE_ADDR");
    $host = gethostname();
    $page = getenv("HTTP_REFERER");
    $time = date("Y-m-d H:i:s");
    $link = mysqli_connect("localhost", "root", "","data");
    //Подключение к базе для записи данных пользователя
    //Запись данных пользователя в таблицу
    $sql = "INSERT INTO info SET ip = '$ip',  system ='$system', host='$host', page = '$page', time = '$time'";
    $result = mysqli_query($link, $sql);
    //Запрос на получение данных
    $sql = "SELECT id, ip, system, host, page, time FROM info WHERE(time > '$start_date' AND time < '$end_date')";
    $result = mysqli_query($link, $sql);
    $db = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $table = array(array());
    //Кнопка "Назад"
<<<<<<< HEAD
    echo '<div class=container1>';
=======
>>>>>>> 20e8b51043e2f62a320f4c1dc85706c8f1eea3aa
    echo '<form action = "index.php" method = "post">';
    echo '<input type="button" value="Назад" onclick="history.back()">';
    echo '</form>';
    if(count($db) == 0) print '<br>Не найдено запросов в выбранный временной промежуток<br>';
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
    echo '</div>';
?>
</body>
</html>