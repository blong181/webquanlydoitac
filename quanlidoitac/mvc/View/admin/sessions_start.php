<?php
session_start();
	if(!isset($_SESSION['submit'])){
		header('location: index.php?controller=client&action=login');
	}?>
