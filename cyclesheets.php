<?php

require __DIR__ . '/Header.php';

error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('America/Chicago');

include 'Classes/PHPExcel/IOFactory.php';

$helper->log('Processing your file.');

echo '<p>Your file is ready for <a href="output.php" target="new">pickup</a></p>';

//  Open the template workbook to be written into
try {
   $helper->log('Loading Xls template');
   $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
   $spreadsheet = $reader->load(__DIR__ . '/templates/tcscoutsort_template.xls');
} catch (Exception $e) {
     die('Error loading template file. Contact healwhans@gmail.com with the following message for support. : <br><p style="color:red;">' . $e->getMessage());
    echo "</p>";
  }

if(isset($_FILES['file']['name'])){
	$inputFileName = $_FILES['file']['name'];
	$ext = pathinfo($inputFileName, PATHINFO_EXTENSION);

	//Checking the file extension
	if($ext == "xlsx"){

			$file_name = $_FILES['file']['tmp_name'];
			$inputFileName = $file_name;

		//  Read uploaded Excel workbook
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

/*		//  Open the template workbook to be written into
		try {
			$helper->log('Loading Xls template');
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
			$spreadsheet = $reader->load(__DIR__ . '/templates/tcscoutsort_template.xls');
                } catch (Exception $e) {
                        die('Error loading template file. Contact healwhans@gmail.com with the following message for support. : <br><p style="color:red;">' . $e->getMessage());
			echo "</p>";
                }
*/

		// Leaving markers behind
		$helper->log('Adding new data to the template');
		// writing meta data to the file
		$spreadsheet->getProperties()
			->setCreator("David Schwartzberg")
			->setLastModifiedBy("David Schwartzberg")
			->setTitle("Twilight Camp Scout Sort")
			->setSubject("Twilight Camp")
			->setDescription("Twilight Camp Scout Sorting tool results.")
			->setKeywords("BSA Twilight Camp scouting cub scouts")
			->setCategory("BSA scouting");

		//Table used to display the contents of the file
		echo '<center><table style="width:50%;" border=1>';

		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

                // Create column headers
                echo "<tr>";
                echo "<td>First Name</td><td>Last Name</td><td><center>Unit</center></td>";

		$as = 1;

		//  Loop through each row of the worksheet in turn
		do {
			$baseRow = 5;
			$spreadsheet->setActiveSheetIndexByName('Den'.$as);
			for ($row = 2; $row <= 17; $row++) {

				// Write the array data to the worksheet
	                        $spreadsheet->getActiveSheet('Den'.$as)->setCellValue('B'. $baseRow, 'fname')
                                         ->setCellValue('C'. $baseRow, 'lname')
                                         ->setCellValue('A'. $baseRow, '1');
        	                $baseRow++;
		//		$as++;
			}
		$as++;
		} while ($as <=10);

	} else {
		echo '<p style="color:red;">Please upload file with xlsx extension only</p>';
	}

}

//var_dump($rowData);

// Read Xls file
//$callStartTime = microtime(true);
//$filename = \PhpOffice\PhpSpreadsheet\IOFactory::load($spreadsheet);
//$helper->logRead('Xls', $spreadsheet, $callStartTime);
// Save
$helper->write($spreadsheet, __FILE__);
rename('/tmp/phpspreadsheet/tcscoutsort.xls', '/opt/lampp/htdocs/outbox/tcscoutsort.xls');


?>
