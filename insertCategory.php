<?php
if (isset ($_POST['recordCategory'])){
	require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
	require_once("models/funcs.php");
	require_once("Connections/connection.inc.php"); //Require DB connection info and database connection

$isbn13 = sanitize($_GET['isbn13']);
$categoryName = sanitize(trim($_POST['category']));

// initialize flag
  $OK = false;
  // create database connection
  $conn = dbConnect('write');
  // initialize prepared statement
  $stmt = $conn->stmt_init();
  // create SQL
  $sql = "
  
  INSERT IGNORE INTO `categoryBook`(categoryName, isbn13) 
  VALUES(?,?)
  ";
  if ($stmt->prepare($sql)) {
	// bind parameters and execute statement
	$stmt->bind_param('si' , $categoryName, $isbn13);
    // execute and get number of affected rows
	$stmt->execute();
	$OK=true;
  }
  // redirect if successful or display error
  if ($OK) {
	  
	  header('Location: http://bookfall.cjsorensen.com/recordBook.php?success=yes');
  exit;
	
  } else {
	$error = $stmt->error;
	print_r($error);
  }
}
?>