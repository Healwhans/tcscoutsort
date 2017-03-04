<?php
error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('America/Chicago');

$file = '/opt/lampp/htdocs/outbox/tcscoutsort.xls';

if (file_exists($file)) {
   // Redirect output to a client’s web browser (Xls)
   header('Content-Description: File Transfer');
   header('Content-Type:vnd.ms-excel');
   header('Content-Disposition: attachment;filename="tcscoutsort.xls"');
   // header('Content-Disposition: attachment;filename="'.basename($file).'"');
   header('Cache-Control: max-age=0');
   // If you're serving to IE 9, then the following may be needed
   //header('Cache-Control: max-age=1');
   // If you're serving to IE over SSL, then the following may be needed
   //header('Expires: 0'); // Date in the past
   //header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
   //header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
   //header('Pragma: public'); // HTTP/1.0
  // header('Content-Length: ' . filesize($file));
   readfile($file);
   exit;
} else {
	echo '<p style="color:red;">File not found!!</p>';
}
?>
