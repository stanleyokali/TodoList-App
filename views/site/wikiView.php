<?php

foreach ($wikipedia as $shit) {
	echo $shit->id . ' ' . $shit->artist . ' ' . $shit->album. '<br>';
}

// $wikipedia has to be the name of the table in your database which is also the name of the model 
// $shit can be any random variable