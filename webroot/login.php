<?php
session_start();
if (isset($_SESSION['login']) && ($_SESSION['login'] == 1) && ($_SESSION['time'] > (time() - 600)))
  header('Location: /ftp');
?>
<?php
  if ($_POST)
  {
    if ($errors = valid_form())
      show_form($errors);
    else
      process_form();
  }
  else
    show_form();

function show_form($error = '')
{
  if ($_POST)
    $default = $_POST;
  else
    $default = array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Login</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/login.css" type="text/css" media="screen" /></head>
<body>
<?php //echo $_SESSION['redirect']; ?>
<h2>登入</h2>
<?php
  if ($error)
  {
    print "<div class=\"alert\">";
    print $error;
    print "</div>";
  }
?>
<form action="login" method="post">
<fieldset>
<table>
<tr>
	<td align="right"><label for="user">管理員：</label></td>
	<td><input type="text" id="user" tabindex="1" name="user" value="<?php echo $default['user']; ?>" /></td>
</tr>
<tr>
	<td align="right"><label for="pass">密碼：</label></td>
	<td><input type="password" id="pass" tabindex="2" name="pass" /></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" tabindex="3" value="登入" /></td>
</tr>
</table>
</fieldset>
</form>
</body></html>
<?php
}

function valid_form()
{
  if ($_POST['user'] == '' && $_POST['pass'] == '')
    return NULL;
  else
    return '帳號或密碼錯誤';
}

function process_form()
{
//  print 'login ok!';
  $_SESSION['login'] = 1;
  $_SESSION['time'] = time();
  if (isset($_SESSION['redirect']) && ($_SESSION['redirect'] != ''))
    header('Location: /ftp/' . substr($_SESSION['redirect'], 2));
  else
    header('Location: /ftp');
}
?>
