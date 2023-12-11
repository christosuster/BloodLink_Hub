<?php
define('host', 'localhost');
define('name', 'root');
define('pass', '');
define('dbname', 'bloodlink_hub');

$con = mysqli_connect(host, name, pass, dbname);

if (!$con) {
    header('Location: ../error.php');
}
?>