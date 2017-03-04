<?php

require __DIR__ . '/Header.php';

error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('America/Chicago');

include 'Classes/PHPExcel/IOFactory.php';

echo '<br><p><strong>Twilight Camp Den assignments <a href="output.php" target="new">completed</a>.</strong></p><br>';

$helper->log('Processing your scouts.');

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

//		rename('templates/tcscoutsort_template_blank.xls', 'templates/tcscoutsort_template.xls');

		//  Open the template workbook to be written into
		try {
			$helper->log('Loading Xls template');
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
			$spreadsheet = $reader->load(__DIR__ . '/templates/tcscoutsort_template.xls');
                } catch (Exception $e) {
                        die('Error loading template file. Contact healwhans@gmail.com with the following message for support. : <br><p style="color:red;">' . $e->getMessage());
			echo "</p>";
                }

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
		echo '<br><p>These are the scouts you gave me to sort.</p>';
		echo '<center><table style="width:50%;" border=1>';

		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

                // Create column headers
                echo "<tr>";
                echo "<td>First Name</td><td>Last Name</td><td><center>Unit</center></td>";

		$baseRow = 5;  // initialize the first cell row to write into the template file
		$as = 1;
		$highrow = 2;
		$currentRow = 2;
		$denRows = 17;

		//  Loop through each row of the worksheet in turn
		do {  //  Iterate through rows
			do {  // Iterate through workbooks
				$baseRow = 5;  // start on the 5th row in the template, reset to 5 on next loop
				$spreadsheet->setActiveSheetIndexByName('Den'.$as);  // Set worksheet 'Den1' to be active
				// Skip the header row and read data from the source file
				for ($row = $currentRow; $row <= $denRows; $row++) {
					//  Read a row of data into the array
					$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
					echo "<tr>";

					// writing the first 16 rows of the spreadsheet to each worksheet by Den.
					$i=0;
					$j=0;
					//  Output the row of data across  columns
					for ($col = 'A'; $col < $highestColumn; $col++) {
						$i=0;
						echo "<td>". $rowData[0][$j] ."</td>";
						$j++;
					// Write the array data to the worksheet
                        		$spreadsheet->getActiveSheet('Den'.$as)->setCellValue('B'. $baseRow, $rowData[0][$i++])
                        		                 ->setCellValue('C'. $baseRow, $rowData[0][$i++])
                        		                 ->setCellValue('A'. $baseRow, $rowData[0][$i++]);
                        		}
					echo "</tr">
					$baseRow++;
					$currentRow++;
				}
			//$currentRow++;
			$denRows = $currentRow + 16;
			$as++;
			} while ($currentRow <= $highestRow);
			$as++;
		} while ($as <= 10);
		echo '</table></center>';
		echo '<br><p><strong>Thank you for using TCScoutSort!</strong></p>';

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

/*
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=.$spreadsheet');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
exit;
*/

//require_once __DIR__ . '/output.php';

?>
