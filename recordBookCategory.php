<?php  	require('insertCategory.php'); 
require('template/foundationHeader.php'); 

  require_once('Connections/connection.inc.php');
  $conn = dbConnect('read');
 
  $sql = "SELECT categoryName FROM category";
  $resultCategory = $conn->query($sql) or die($conn->error);

?>
<script>
        $(document).ready(function() { $("#category").select2(); });
    </script>
<body>
<div class="row">
    <div class="panel large-8 columns large-centered">
        <h1>What category would you say this book belonged to?</h1>
        <form name="recordCategory" method="post" data-abide>
        <select name="category" id="category" style="width:50%" data-placeholder="search for a category">
						<option value=""></option>
                        <?php if (isset($resultCategory)){
							while ($row = $resultCategory->fetch_assoc()){?>
								<option value="<?php echo $row['categoryName'];?>"><?php echo $row['categoryName'];?></option>
						<?php }}?>
						
						</select>
                        <input class="large button" type="submit" name="recordCategory" value="Enter Category"/>
        </form>
    </div>
</div>

<?php include("template/foundationFooter.php"); ?>