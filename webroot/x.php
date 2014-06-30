<?php
session_start();
require_once('need_authorized.inc.php');

$q = $_GET['q'];
$true_q = urldecode($q);
$test = '/usr/local/ftpuser/public/' . $true_q;

function readfile_chunked($filename)
{
	$chunksize = 1*(1024*1024); // how many bytes per chunk
	$handle = fopen($filename, 'rb');
	if ($handle === false)
		return false;

	while (!feof($handle))
	{
		$lines = fread($handle, $chunksize);
		print $lines;
	}
	fclose($handle);
	return;
}

if (is_dir($test))
{
	#header("Content-type: text/html");
	# $d = $_GET['d'];
	echo `/var/www/cgi-bin/lx $q`;
}
else if (file_exists($test) && !strstr($test, '..'))	// $q is a file request.
{
	# $f = $_GET['f'];
	# $file = urldecode($f);
	# $path = '/usr/local/ftpuser/public/' . $file;

#	for PHP >= 5.3.0
#	$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
#	header("Content-type: " . finfo_file($finfo, $path));
#	echo  finfo_file($finfo, $path);
#	finfo_close($finfo);

#	echo mime_content_type('/var/www/html/ftp.meinews.cc/c.php');

	require_once('mimetype.php');
	$mimetype = new mimetype();
	$type = $mimetype->getType($test);
	header("Content-type: " . $type);
	if (!strstr($type, "image") && !strstr($type, "text"))
		header('Content-Disposition: attachment; filename="' . basename($true_q) . '"');
	if (filesize($test) > 3*(1024*1024))
		readfile_chunked($test);
	else
		readfile($test);
}
else
{
	header("HTTP/1.0 404 Not Found");
#	header("Content-type: image/jpeg");
#	readfile('404.jpg');
	readfile('404.html');
}
exit;
?>
