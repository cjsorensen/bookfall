<?php require('template/foundationHeader.php');
if(!empty($_POST)) {
$queryDelete= 'DELETE 
FROM `bookRead`
WHERE recordid = ?';
$stmt=$mysqli->prepare($queryDelete);
	$stmt->bind_param('i', $_POST['recordid']);
	$stmt->execute();
	
};
?>


<div class="row">
	<div class="small-12 large-12">
		<h1>My Books</h1>
        <hr>
    </div> 

		<ul class="large-block-grid-6">
<?php 
		$studentEmail=$loggedInUser->email;
		$studentId=$loggedInUser->user_id;
		$queryMyBooks = "SELECT *
		FROM `bookRead`
		WHERE emailStudent = '$studentEmail' OR studentID = $studentId
		ORDER BY date DESC
		"; 
		$resultMyBooks = $mysqli->query($queryMyBooks); 
	  /* fetch associative array */
	  while ($row = $resultMyBooks->fetch_assoc()) {
		  echo '
		  <li>
		 	<div class="small-card"> <img class="cover" src="http://covers.openlibrary.org/b/isbn/'.$row['isbn13'].'-M.jpg"/> 
		  		<div class="info">
					<div>
						<h1>'.strtoupper($row['title']).'<h1> 
						<h2>'.$row['author'].'</h2>  
						<h3>'.$row['pages'].'</h3>
						<p>Finished on <span class="white">'.$row['date'].'</span></p>
					</div>	
				</div>
		  <p><form name="delete" method="post" action="'.$_SERVER['PHP_SELF'].'"><input type="hidden" name="recordid" value="'.$row['recordid'].'"><input class="button" type="submit" name="delete" value="Delete" onclick=" return confirm(\'Are you sure you want to delete this record?\')"></form></p>
		  </div>
		  </li>
		  '; 
	  }?>
	</ul>

	</div>

<?php require('template/foundationFooter.php'); ?>