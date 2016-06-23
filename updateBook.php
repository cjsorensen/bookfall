<?php
	require_once("Connections/connection.inc.php");
	$OK = false;
  // create database connection
  	$conn = dbConnect('write');
  // initialize prepared statement
  	$stmt = $conn->stmt_init();
  // create SQL
  	$sql = "INSERT INTO `book` (`author`, `title`, `pages`, lexile, isbn13, `readCount`) 
		  VALUES(?,?,?,?,?,?)";
  if ($stmt->prepare($sql)) {
	// bind parameters and execute statement
	$stmt->bind_param('ssiiii' , $author, $title, $pages, $lexile, $isbn13, $i=1);
    // execute and get number of affected rows
	$stmt->execute();
	if ($stmt->affected_rows > 0) {
	  $OK = true;
	}
  }
  // redirect if successful or display error
  if ($OK) {
	 					
	  echo 'it worked!';
  exit;
	
  } else {
	$error = $stmt->error;
	print_r($error);
  };

?>