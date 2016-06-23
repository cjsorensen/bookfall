<?php require('insertBook.php'); 
require('template/foundationHeader.php'); 	 
?>

<body>
  
<!--Book Cover and info-->
<?php 	$isbn13 = $_GET['isbn13'];
		$lexile = $_GET['lexile'];
		$userId = $loggedInUser->user_id;
		
		
?>
<div class="row panel">
  <div class="row">
    <div class="large-3 small-5 columns"><img src="http://covers.openlibrary.org/b/isbn/<?php echo $isbn13; ?>-M.jpg"/></div>
    <div class="large-9 small-7 columns">
      <?php //Open Library API call
	 	 	$contents = file_get_contents('http://openlibrary.org/api/books?bibkeys=ISBN:'.$isbn13.'&jscmd=data&format=json');
			$jsonObj = json_decode($contents, TRUE); 
   //Create Variables for book information from Open Library API
	 		$title =  $jsonObj['ISBN:'.$isbn13]['title'];
	 		$titleUpper =strtoupper($title);
			$author = $jsonObj['ISBN:'.$isbn13]['authors']['0']['name'];
			$pages = $jsonObj['ISBN:'.$isbn13]['number_of_pages'];
			
		?>
     
      <div class="large-12 small-12 columns">
      <h1><?php echo $titleUpper?></h1>
      <h2>by <?php echo $author;?></h2>
      <h3><?php if(is_null($pages)==false) {echo $pages.' pages';}; ?></h3>
      </div>
    <div class='large-8 small-8 columns'>  
      <h4><small>If you see blanks or errors in the book information, please consider heading over to <a href="http://openlibrary.org">The Open Library</a> and editing or adding the book.</small></h4>
      </div>
     <div class="large-12 small-12 columns"><a href="recordBook.php" class="button large">Not Your Book?</a> </div> 
    </div>
  </div>
   
</div>

<div class="row">
  <div class="large-12 large-centered columns">
    <h1>Tell People About Your Book</h1>
  </div>
</div>
<div class="row panel">
  <div class="large-12 large-centered columns">
    <form name="recordBook" method="post" class="custom" data-abide>
      <fieldset>
 		<div class="teacher-email-field">
            <label>Enter your teacher's email</label>
            <input name="teacher" type="email" id="teacher" placeholder="email@email.com" required>
            <small class="error">Oops.  That's not a valid email</small>
        </div>
        <div class="date-field">
            <label>When did you finish reading your book?</label>
            <input name="date" type="date" required id="date" autocomplete="on" pattern="month_day_year">
            <small class="error">Oops.  Don't forget the date</small>
         </div>        
        <div class="lexile-field">
            <label>What was the book's Lexile Number?</label>
            <input type="number" name="lexile" placeholder="enter a number from 100 to 1500">
            <small class="error">Oops.  That's not a valid Lexile Number.</small>
        </div>
        <p>Your teacher can help you find out a book's lexile number or you can visit <a href="http://www.lexile.com" target="new">Lexile.com</a> to lookup a book's level.</p>
        <div class="rating-field">
            <label>How hard did you find the book?</label>
            <label for="easy">
              <input name="actual" type="radio" id="easy" value="1" style="display:none;" >
              <span class="custom radio"></span> Easy</label>
            <label for="justright">
              <input name="actual" type="radio" id="justright" value="2" style="display:none;" >
              <span class="custom radio"></span> Just Right</label>
            <label for="hard">
              <input name="actual" type="radio" id="hard" value="3" style="display:none;" >
              <span class="custom radio"></span> Hard</label>
		</div>
      </fieldset>
     <div class="rating-field">
      <label>How Much Did You Enjoy the Book? 1=Hated it. 10=Loved it.</label>
      <select name="rating" class="small" required>
        <option value="">Please Select</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select>
      <small class="error">Don't forget to rate the book</small>
      </div>
      <label for"review">Please write a review of the book. A good review will highlight what the book was about and also let other people know why you liked or didn't like it. Reviews that are too brief are not as helpful to other readers. So, go ahead an let us know what you think!</label>
      <div class="review-field">
      	<textarea name="review" placeholder="Write your thoughts here" required></textarea>
      	<small class="error">Oops.  Let us know what you think.</small>
      </div>
      <input type="hidden" name="title" value="<?php echo $titleUpper; ?>">
      <input type="hidden" name="author" value="<?php echo $author; ?>">
      <input type="hidden" name="pages" value="<?php echo $pages; ?>">
      <input type="hidden" name="userId" value="<?php echo $userId; ?>">
      <input class="large button" name="recordBook" type="submit" value="Next  >">
    </form>
  </div>
</div>
<?php include("template/foundationFooter.php"); ?>