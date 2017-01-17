<?php
require_once 'ereader.php';
$target_dir = "uploads/";
$target_file = $target_dir . date('m-d-Y_H:i:s_') . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual Excel file or CVS or not
if(isset($_POST["submit"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is acceptable" . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File type is not acceptable.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($FileType != "xls" && $FileType != "xlsx" && $FileType != "csv"
&& $FileType != "txt" ) {
    echo "Sorry, only Excel XLS or XLSX, and Comma Separated Value CSV files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo " Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<br><br>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Make the file unique
//$filename = date('m-d-Y_H:i:s').'_'.md5(time).'.$_FILES';

?>

