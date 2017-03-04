<?php

require __DIR__ . '/Header.php';
error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('America/Chicago');

include 'Classes/PHPExcel/IOFactory.php';

$helper->log('Processing your file.');

if(isset($_FILES['file']['name'])){
	$inputFileName = $_FILES['file']['name'];
echo $inputFileName;
	$ext = pathinfo($inputFileName, PATHINFO_EXTENSION);

	//Checking the file extension
	if($ext == "xlsx"){

			$file_name = $_FILES['file']['tmp_name'];
			$inputFileName = $file_name;

		//  Read your Excel workbook
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

		//Table used to display the contents of the file
		echo '<center><table style="width:50%;" border=1>';

		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		//  Loop through each row of the worksheet in turn
		for ($row = 1; $row <= $highestRow; $row++) {
			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			echo "<tr>";
			//echoing every cell in the selected row for simplicity.
			foreach($rowData[0] as $k=>$v)
				echo "<td>".$v."</td>";
			echo "</tr>";
		}
		echo '</table></center>';
	}

	else{
		echo '<p style="color:red;">Please upload file with xlsx extension only</p>';
	}
}

/* Save this for later
// Read Xls file
$callStartTime = microtime(true);
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filename);
$helper->logRead('Xls', $filename, $callStartTime);

// Save
//$helper->write($spreadsheet, __FILE__);



// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=$filename');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
*/
?>
