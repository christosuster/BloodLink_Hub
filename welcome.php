<?php
session_start();
echo "Welcome " . $_SESSION['username'];
?>
<br>
<a href="classes/logout.php">Logout</a>