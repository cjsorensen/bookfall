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
    <div class="small-12 large-12">
                    <table sortable>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Pages</th>
                                <th>Lexile</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Date</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
    
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
		  <tr>
		  <td>'.$row['title'].'</td>
		  <td>'.$row['author'].'</td>
		  <td>'.$row['pages'].'</td>
		  <td>'.$row['lexile'].'</td>
		  <td>'.$row['review'].'</td>
		  <td>'.$row['rating'].'</td>
		  <td>'.$row['date'].'</td>
		  <td><form name="delete" method="post" action="'.$_SERVER['PHP_SELF'].'"><input type="hidden" name="recordid" value="'.$row['recordid'].'"><input class="button" type="submit" name="delete" value="Delete" onclick=" return confirm(\'Are you sure you want to delete this record?\')"></form></td>
		  
		  
		  </tr>'; 
	  
	  }
	  
?>
</table>

	</div>
</div>

<?php require('template/foundationFooter.php'); ?>