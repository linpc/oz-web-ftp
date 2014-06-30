<?php
$f = $_GET['f'];
$ff = urldecode($f);
$path = '/usr/local/ftpuser/public/' . $ff;
if (file_exists($path))
{
#	for PHP >= 5.3.0
#	$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
#	header("Content-type: " . finfo_file($finfo, $path));
#	echo  finfo_file($finfo, $path);
#	finfo_close($finfo);

#	echo mime_content_type('/var/www/html/ftp.meinews.cc/c.php');

	require_once('mimetype.php');
	$mimetype = new mimetype();
	$type = $mimetype->getType($path);
	header("Content-type: " . $type);
	if (!strstr($type, "image") && !strstr($type, "text"))
		header('Content-Disposition: attachment; filename="' . basename($f) . '"');
	readfile($path);
}
else
	echo 'file not exists.';
exit;
?>
