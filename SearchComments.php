<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="styles.css"  rel="stylesheet">
</head>
<body>
<form method="POST">
    <label>
        <input minlength="3" type="text" name="textSearch" >
    </label>
    <input type="submit" value="Найти">
    <br>
    <table>
        <tr>
            <th>Заголовок записи</th>
            <th>Комментарий</th>
        </tr>
        <?php

        $connect = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin");
        $textSearch = "";

        if (isset($_POST["textSearch"])) {
            $textSearch = $_POST["textSearch"];
        }
        print("Поиск по: $textSearch <br>");

        $comments = pg_fetch_all(pg_query($connect, "SELECT name, body FROM \"Test\".comments WHERE body LIKE '%$textSearch%'"));
        $result='';
        foreach ($comments as $comment) {
            $result.='<tr>';

            $result.='<td>'.$comment['name'].'</td>';
            $result.='<td>'.$comment['body'].'</td>';

            $result.='</tr>';
        }
        echo $result;
        ?>
    </table>
</form>

</body>
</html>


