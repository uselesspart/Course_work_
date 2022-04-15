<html>
<head>
<title> Информация о запросах </title>
<style> 
    html, body {
     width: 100%;
    }
    input{
        border-radius: 5px;
        font-size: 15pt;
    }
    div.container1{
        font-size: 20pt;
        position: absolute;
        width: 100%;
        text-align: center;
    }
    table{
        margin: 0 auto;
    }
</style>
</head>
<body>
<?php
    //Установка часового пояса
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
    $sql = "SELECT * FROM info";
    $result = mysqli_query($link, $sql);
    if($result == false){
        $link = mysqli_connect("localhost", "root", "");
        $sql = "CREATE DATABASE info";
        $result = mysqli_query($link, $sql);
        $result = mysqli_select_db($link, 'data');
        $sql = "CREATE TABLE info (
        id int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        system varchar(100) DEFAULT NULL,
        ip varchar(100) DEFAULT NULL,
        host varchar(100) DEFAULT NULL,
        page varchar(100) DEFAULT NULL,
        time datetime NOT NULL
        )";
        $result = mysqli_query($link, $sql);
    }
    //Подключение к базе для записи данных пользователя
    //Запись данных пользователя в таблицу
    $sql = "INSERT INTO info SET ip = '$ip',  system ='$system', host='$host', page = '$page', time = '$time'";
    $result = mysqli_query($link, $sql);
    //Запрос на получение данных
    $sql = "SELECT id, ip, system, host, page, time FROM info WHERE(time > '$start_date' AND time < '$end_date')";
    $result = mysqli_query($link, $sql);
    //Запись данных ро запросу в массив $db
    $db = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $table = array(array());
    echo '<div class=container1>';
    echo '<form action = "index.php" method = "post">';
    //Кнопка "Назад"
    echo '<input type="button" value="Назад" onclick="history.back()">';
    echo '</form>';
    //Заполнение массива для таблицы
    if(count($db) == 0) print '<br>Не найдено запросов в выбранный временной промежуток<br>';
    else
    {
    $n = $db[count($db)-1]['id'] - $db[0]['id'] + 1;
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