<?php

require_once 'Header.php';

if (!$helper->isCli()) {
?>
    <div class="jumbotron">
        <p>Welcome to Twilight Camp Scout Sort, a tool written to help camp organizers sort registered scouts into dens. When sorting is complete, an Excel spreadsheet will be available for final editing.</p>
        <p>&nbsp;</p>
        <p>
            <a class="btn btn-lg btn-primary" href="https://github.com/Healwhans/tcscoutsort" role="button" target="new"><i class="fa fa-github fa-lg" title="GitHub"></i>  Contribute on Github!</a>
            <a class="btn btn-lg btn-primary" href="https://github.com/PHPOffice/PhpSpreadsheet" role="button" target="new"><i class="fa fa-book fa-lg" title="Docs"></i>  Thank you PHPSpreadsheet</a>
        </p>
    </div>
    <div>
	<h3>Instructions:</h3>
	<form action="csv.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
    		Select CSV file to upload:<br>
    	   <label class="btn btn-default btn-file">Browse<input type="file" style="display: none;" class="form-control name="fileToUpload" id="fileToUpload"></button>
	   </label>
	</div>
	<button type="submit" class="btn btn-primary" value="Upload File">Submit</button>
	</form>
    </div>
<?php
} else {
   echo 'else' . PHP_EOL;
}

