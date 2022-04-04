<html>
<head>
<title> Информация о запросах </title>
<style> 
    button{
        border-radius: 5px;
        width: 150px; /* Ширина кнопки */
        height: 30px; /* Высота */
        font-size: 15pt
    }
    input{
        width: 350px;
        height: 45px;
        font-size: 15pt
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
    div.container2{
        position: absolute;
        top: 60%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%)
    }
</style>
</head>
<body>
<div class = container1>
<form action = "a.php" method = "post" >
Дата начала <br><input type="datetime-local" name="calendar1"><br>
Дата конца <br><input type="datetime-local" name="calendar2"><br>
<br><br>
</div>
<div class = container2>
<button type="submit"> Отправить</button>
</form>
</div>
</body>
</html>