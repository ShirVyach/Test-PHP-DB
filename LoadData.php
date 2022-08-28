<?php
$posts_json = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'), true);
$comments_json = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/comments'), true);

$connect = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin");
$pacc=0;
$cacc=0;
foreach($posts_json as $row) {
    pg_query($connect, "INSERT INTO \"Test\".posts VALUES
                ('" . $row["userId"] . "', '" . $row["id"] . "',
                '" . $row["title"] . "', '" . $row["body"] . "'); ");
    $pacc++;
}
foreach($comments_json as $row) {
        pg_query($connect, "INSERT INTO \"Test\".comments VALUES
                ('" . $row["postId"] . "', '" . $row["id"] . "',
                '" . $row["name"] . "', '" . $row["email"] . "', '" . $row["body"] . "'); ");
        $cacc++;
}
echo "Загружено ", $pacc ," записей и ", $cacc ," комментариев";
