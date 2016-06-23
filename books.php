<?php require('template/foundationHeader.php');
	

$queryPopular = "SELECT isbn13, lexile, COUNT(isbn13) AS isbn13Count
FROM bookRead
GROUP BY isbn13
ORDER BY isbn13Count DESC
LIMIT 5"; 


echo '
<div class="row">
	<div class="large-12 small-12 columns">
	<h1>Popular Books</h1>
	<hr>
	</div>
</div>	
';

if ($resultPopular = $mysqli->query($queryPopular)) {
	
    /* fetch associative array */
    while ($row = $resultPopular->fetch_assoc()) {
	$isbn13 = $row["isbn13"];
	$lexilePercent = round(($row["lexile"]/2000) * 100);
	$lexile = $row["lexile"];
	
	//Get the average rating for a book based on isb13 and assign to the 
	//$ratingInsert variable for placing in the page
	$queryRating ="SELECT AVG(rating) FROM bookRead WHERE isbn13=$isbn13";
	$resultRating = $mysqli->query($queryRating);
	while ($rowRating = $resultRating->fetch_assoc()) {
	$ratingInsert = round($rowRating["AVG(rating)"]);
	}
    //Open Library API call
	 	 	$contents = file_get_contents('http://openlibrary.org/api/books?bibkeys=ISBN:'.$isbn13.'&jscmd=data&format=json');
			$jsonObj = json_decode($contents, TRUE); 
   //Create Variables for book information from Open Library API
	 		$title =  $jsonObj['ISBN:'.$isbn13]['title'];
	 		$titleUpper =strtoupper($title);
			$author = $jsonObj['ISBN:'.$isbn13]['authors']['0']['name'];
			$pages = $jsonObj['ISBN:'.$isbn13]['number_of_pages'];
			


echo
'<body>
<div class="row panel">
		<div class="large-6 small-12 columns">
            
           <div class="large-4 small-4 columns">
			<img src="http://covers.openlibrary.org/b/isbn/'.$isbn13.'-M.jpg"></img>
   			</div>
			
			<div class="small-8 large-8 columns">
				<h3>'.$titleUpper.'</h3>
				<em><h4>by '.$author.'</h4></em> 
			</div>
          	<div class="small-12 large-12 columns">
		  		<hr class="panel-divider">
			</div>	
					
     		<div class="small-12 large-12 columns"> 
				<h2><small>Average Rating: '.$ratingInsert.'/10</small></h3>	
				<div class="progress"><span class="meter" style="width: '.$ratingInsert.'0%"></span></div>
        	</div>
			
			<div class="small-12 large-12 columns">
    			<h2><small>Lexile: '.$lexile.'</small></h2>
				<div class="progress"><span class="meter" style="width: '.$lexilePercent.'%"></span></div>
    		</div>
				
			<div class="small-12 large-12 columns">
				<hr class="panel-divider">
				<h2><small>Categories:</small></h2>';
				$queryCategory ="SELECT categoryName FROM categoryBook WHERE isbn13=$isbn13";
				$resultCategory = $mysqli->query($queryCategory);
				while ($rowCategory = $resultCategory->fetch_assoc()) {echo '<a class="button small" href="booksCategory.php?cat='.$rowCategory["categoryName"].'">'.$rowCategory["categoryName"].'</a>';
				}	  
	
echo '				
			</div>	
			
    </div> 
           
           <div class="large-6 small-12 columns">
        		<h2>Latest Reviews</h2>
				<p>';
				$queryReview ="SELECT review, date 
				FROM bookRead 
				WHERE isbn13=$isbn13
				ORDER BY date DESC
				LIMIT 4";
				$resultReview = $mysqli->query($queryReview);
				while ($rowReview = $resultReview->fetch_assoc()) {echo '<blockquote>"'.$rowReview["review"].'"<cite>'.$rowReview["date"].'</cite></blockquote>';
				}
			
			  echo '</p>
           </div>';

    	

echo '    
	


</div>
';
	}
}
?>
<?php 
require('template/foundationFooter.php'); ?>