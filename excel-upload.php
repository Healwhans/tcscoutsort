<?php

require __DIR__ . '/Header.php';

error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('America/Chicago');

include 'Classes/PHPExcel/IOFactory.php';

if(isset($_FILES['file']['name'])){
	$inputFileName = $_FILES['file']['name'];
	$ext = pathinfo($inputFileName, PATHINFO_EXTENSION);

	//Checking the file extension
	if($ext == "xlsx"){

			$file_name = $_FILES['file']['tmp_name'];
			$inputFileName = $file_name;

		//  Read your Excel workbook
		try {
//			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
//			$helper->log($spreadsheet, __FILE__);
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			//$inputFileType = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			//$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
			//$spreadsheet = $reader->load($inputFileName);
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
			//echoing every cell in the selected row for simplicity. You can save the data in database too.
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
?>
