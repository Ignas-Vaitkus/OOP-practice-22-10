<?php

$hostname = "localhost";
$username = "blog_user";
$password = "mysql";
$dbname = "blog_database";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

$sql = "SELECT * FROM blog_database.posts;";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Mini Blog</title>
</head>

<body>

</body>

</html>