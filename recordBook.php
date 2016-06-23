<?php include("template/foundationHeader.php"); 

?>
<div class="row">
	<div class="large-6 small-12 columns">
	<h1>What Book Did You Read?</h1>
    <hr>
    <?php if($_GET['success']=='yes'){echo '<div data-alert class="alert-box success">
  		You have successfully recorded a book!
  		<a href="#" class="close">&times;</a>
		</div>';
		} ?>
    </div>
</div>
<div class=" row">
	<div class="large-6 small-12 panel columns">
    	<p>In order to enter a book you must know its ISBN13 book number.  Visit <a href="http://www.lexile.com/fab" target="new">Lexile.com/fab</a> to lookup the correct ISBN number for your book and its Lexile number.</p>
    
		<form name="isbn13" method="get" action="recordBookNext.php" data-abide>
    	<div class="large-8 small-12 columns">
    	<label>ISBN13</label>
    	<input  name="isbn13" placeholder="xxxxxxxxxxxxx" required pattern="isbn">
        <small class="error">You must enter an ISBN13 number. It must be exactly 13 numbers long.</small>
    	</div>
    
      
             <div class="large-4 small-12 columns">
            <input class="large button expand" type="submit" value="Next   >">
            </form>
            </div>
       
    </div>
</div>


<?php include("template/foundationFooter.php"); ?>