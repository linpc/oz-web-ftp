<?php
#header("Content-type: text/html");
$d = $_GET['d'];
echo `/var/www/cgi-bin/lx $d`;
?>
