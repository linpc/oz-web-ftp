<?php
if (!isset($_SESSION['login']) || ($_SESSION['login'] != 1) || ($_SESSION['time'] < (time() - 600)))
{
//  header(sprintf('Location: /login.php?redirect=%s', urlencode($_SERVER['QUERY_STRING'])));
//  header('Location: login');
  $_SESSION['redirect'] = $_SERVER['QUERY_STRING'];
  header('Location: /login');
  exit();
}
?>
