<?php if (isset ($_POST['recordBook'])){
	require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
	require_once("models/funcs.php");
	require_once("Connections/connection.inc.php"); //Require DB connection info and database connection
  //get unix timestamp and convert to MySQL date
  $date = date("Y-m-d", strtotime($_POST['date']));
  //get info from logged in user
  $userEmail = $loggedInUser->email;
  
  
  //Trim form inputs
  $teacher = sanitize(trim($_POST['teacher']));
  $review = strip_tags(trim($_POST['review']));
  $actual = sanitize(trim($_POST['actual']));
  $rating = sanitize(trim($_POST['rating']));
  $isbn13 = sanitize($_GET['isbn13']);
  $lexile = sanitize(trim($_POST['lexile']));
  $title = sanitize(trim($_POST['title']));
  $author = sanitize(trim($_POST['author']));
  $pages = sanitize(trim($_POST['pages']));
	$userId = sanitize(trim($_POST['userId']));
  
  
  // initialize flag
  $OK = false;
  // create database connection
  $conn = dbConnect('write');
  // initialize prepared statement
  $stmt = $conn->stmt_init();
  // create SQL
  $sql = "
  INSERT INTO `bookRead`(`emailTeacher`, title, author, pages, lexile, rating, review, actual_difficulty, emailStudent, date, isbn13, studentID)
  VALUES(?,?,?,?,?,?,?,?,?,?,?,?);";
  if ($stmt->prepare($sql)) {
	// bind parameters and execute statement
	$stmt->bind_param('sssiiisissii' , $teacher, $title, $author, $pages, $lexile, $rating , $review, $actual, $userEmail, $date, $isbn13, $userId);
    // execute and get number of affected rows
	$stmt->execute();
	if ($stmt->affected_rows > 0) {
	  $OK = true;
	}
  }
  // redirect if successful or display error
  if ($OK) {
	  
	  header('Location: http://bookfall.cjsorensen.com/recordBookCategory.php?isbn13='.$isbn13);
  exit;
	
  } else {
	$error = $stmt->error;
	print_r($error);
  }
}
?>