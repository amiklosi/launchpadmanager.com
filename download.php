<?php

	

    $filename = 'app/latest/LaunchpadManager.dmg';
    $resultFileName = 'LaunchpadManager.dmg';
    $mimetype = 'application/x-apple-diskimage';
    //$mimetype = 'application/zip';
		
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header('Content-Type: '.$mimetype );
header("Content-Disposition: attachment; filename=\"$resultFileName\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($filename));

// download
// @readfile($file_path);
$file = @fopen($filename,"rb");
if ($file) {
  while(!feof($file)) {
    print(fread($file, 1024*8));
    flush();
    if (connection_status()!=0) {
      @fclose($file);
      die();
    }
  }
  @fclose($file);
}

$count = intval(trim(file_get_contents('count.txt')));
	$count++;

	$fp = @fopen('count.txt','w+') or die('ERROR: Can\'t serve file, please try again in a couple of seconds');
	flock($fp, LOCK_EX);
	fputs($fp, $count);
	flock($fp, LOCK_UN);
	fclose($fp);

exit;


?>