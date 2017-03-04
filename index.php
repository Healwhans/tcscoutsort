<?php

require_once 'Header.php';

if (!$helper->isCli()) {
?>

	<div class="jumbtron">
		<h2>Twilight Camp Scout Sort</h2>
		<p>Welcome to Twilight Camp Scout Sort, a tool written to help camp organizers sort registered scouts into dens. When sorting is complete, an Excel spreadsheet will be available for final editing</p>
		<p>&nbsp;</p>
	        <p>
			<a class="btn btn-lg btn-primary" href="https://github.com/Healwhans/tcscoutsort" role="button" target="new"><i class="fa fa-github fa-lg" title="GitHub"></i>  Contribute on Github!</a>
        		<a class="btn btn-lg btn-primary" href="https://github.com/PHPOffice/PhpSpreadsheet" role="button" target="new"><i class="fa fa-book fa-lg" title="Docs"></i>  Thank you PHPSpreadsheet</a>
		</p>
	</div>
	<div>
		<h3>Instructions:</h3>
		<form enctype="multipart/form-data" action="tcscoutsort.php" method="post" >
		<div class="form-group">
				Upload your file
			<label class="btn btn-file span3" for="file">
			<input type="file" style="display: block"; class="form-control" name="file" id="file" required /></label>
		</div>
			<input type="submit" class="btn btn-primary" value="Sort my Scouts" />
		</form>
	</div>
<?php
} else {
   echo 'else' . PHP_EOL;
}
