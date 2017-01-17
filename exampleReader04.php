<?php

error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('America/Chicago');

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>PHPExcel Reader Example #04</title>

</head>
<body>

<h1>PHPExcel Reader Example #04</h1>
<h2>Simple File Reader using the PHPExcel_IOFactory to Identify a Reader to Use</h2>
<?php

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../php/Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';


$inputFileName = './uploads/10-14-2016_05:18:52_Event_896_ParticipantsData_Cleaned.xlsx';

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
echo 'File ',pathinfo($inputFileName,PATHINFO_BASENAME),' has been identified as an ',$inputFileType,' file<br />';

echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory with the identified reader type<br />';
/**  Create a new Reader of the type defined in $inputFileType  **/
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
/** Advice the Reader that we inly want to load cell data  **/
$objReader->setReadDataOnly(true);
/** Load $inputFileName to a PHPExcel Object **/
$objPHPExcel = $objReader->load($inputFileName);


echo '<hr />';

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
var_dump($sheetData);


?>
<body>
</html>
