<?php

$hostname = "localhost";
$username = "blog_user";
$password = "mysql";
$dbname = "blog_database";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

require_once('./Modules/posts.php');

$result = Posts::getPosts($conn);

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang='lt'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Mini Blog</title>
</head>

<body>
    <?php

    while ($row = mysqli_fetch_assoc($result)) {
        print('<pre>');
        var_dump($row);
        print('</pre>');
    }

    ?>
</body>

</html>