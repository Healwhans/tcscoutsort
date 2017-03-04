<?php

//require_once 'Header.php';
require __DIR__ . '/output.php';
if (!$helper->isCli()) {
?>

<h2>Twilight Camp Scout Sort</h2>

	<label class="form-label span3" for="file">CONGRATULATIONS!!</label>
	<br><br>


<?php
} else {
   echo 'else' . PHP_EOL;
}
