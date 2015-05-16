<?php

	//include configuration file
	include('../config/config.php');

	//continue session
	session_start();

	//destroy session
	session_destroy();

	//Redirect user
	header('Location: ../');

?>