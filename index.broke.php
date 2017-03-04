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
	<form action="tcscoutsort.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
    		Select an Excel file to upload:<br>
    	   <label class="btn btn-default btn-file span3" for="file">Browse</label>
	   <input type="file" style="display: none"; class="form-control name="file" id="file" required />
	</div>
	<input type="submit" class="btn btn-primary" value="Submit"/>
	</form>
    </div>
<?php
} else {
   echo 'else' . PHP_EOL;
}

