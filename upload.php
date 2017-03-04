<?php
/** Set default timezone otherwise will throw a notice */
date_default_timezone_set('America/Chicago');

$target_dir = "/opt/lampp/htdocs/inbox/";

if(isset($_FILES["fileToUpload"]["name"])) {
  $filename = date('m-d-Y_H:i:s_') . basename($_FILES["fileToUpload"]["name"]);
  echo $filename;
  $uploadOk = 1;
  echo "File ".$_FILES["fileToUpload"]["name"]."received for processing.";
  $FileType = pathinfo($filename, PATHINFO_EXTENSION);

  // Check if file is a actual Excel file or CVS or not
  if($FileType == "xlsx") {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is acceptable" . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File type is not acceptable.";
        $uploadOk = 0;
    }
   $filename = date('m-d-Y_H:i:s_') . basename($_FILES["fileToUpload"]["tmp_name"]);
   $inputFileName = $filename;

   // Check if file already exists
   if (file_exists($filename)) {
     echo "Sorry, file already exists.";
     $uploadOk = 0;
   }

   // Check file size
   if ($_FILES["fileToUpload"]["size"] > 500000) {
     echo "Sorry, your file is too large.";
     $uploadOk = 0;
   }

   // Allow certain file formats
   if($FileType != "xls" && $FileType != "xlsx" && $FileType != "csv" && $FileType != "txt" ) {
    echo "Sorry, only Excel XLS or XLSX, and Comma Separated Value CSV files are allowed.";
    $uploadOk = 0;
   }

   // Check if $uploadOk is set to 0 by an error
   if ($uploadOk == 0) {
     echo " Sorry, your file was not uploaded.";

   // if everything is ok, try to upload file
   } else {
     if (move_uploaded_file($_FILES["fileToUpload"]["name"], $target_dir.$filename)) {
        echo "<br><br>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
     } else {
        echo "Sorry, there was an error uploading your file.";
     }
   }
}

// Make the file unique
//$filename = date('m-d-Y_H:i:s').'_'.time().'.$_FILES';

// Load a spreadseet file
//$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($target_file);
}
?>
