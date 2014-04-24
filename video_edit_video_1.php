<?php
/**
  Template Name: Edit Video 2
 */
require 'video_db_connection.php';
get_header(); 
 
 
 
 
 Function VideoSelect($id){
	
	$conn = OpenDataBaseConnection();
	if ($conn != 0){
	
    		$sql =  "Select * from Videos.VideoTransactions where ID ='" . mysql_real_escape_string($id) . "';";
        			
			if ($rs = $conn->query($sql)) {
					
					return $rs;					
        			
        			} 
        	return NULL;		
}
else{

	echo "cannot connect to database";

}

}
 
 ?>
 
 <?php
 if (isset($_POST['frmsubmit'])){
	
	$conn = OpenDataBaseConnection();
	
	$ID = $_POST['frmid'];
    $Description = $_POST['frmDescription'];
    //$Title = $_POST['frmTitle'];
	//$DateUploaded = $_POST['frmDateUploaded'];
	$Release = $_POST['frmrelease'];
	$Commercial = $_POST['frmcommercial'];
	
	/*  echo "<p class ='echoText'>This is release:" . $Release;
	echo "<p class ='echoText'>This is commercial:" . $Commercial;  */
	
	$ReleaseValue = 0;
    $CommercialValue = 0;
	
	
	
	if($Release == 1){
		$ReleaseValue = 1;
		/* echo "<p class= 'echoText'>Video is now live on users devices </p>"; */
	}
	
	
	
   if($Commercial == 1){
	   $CommercialValue = 1;
	  
   }
   
    
	if ($conn != 0){
	
		$conn->query("SET @s_id = " . $ID);
		$conn->query("SET @s_Desc = " . "'" . $conn->real_escape_string($Description) . "'");
		$conn->query("SET @s_Status = " . $ReleaseValue);
		$conn->query("SET @s_commercial = " . $CommercialValue);
		$conn->query("SET @s_returnval = 0");
	    
    			
        			
				if(!$conn->query("CALL UpdateVideoTransactions(@s_id, @s_Desc,@s_Status,@s_commercial,@s_returnval)")){
    					
    					trigger_error('Problem with SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
					}
					else
					{
					
        			//$last_inserted_id = $conn->insert_id;
  					//$affected_rows = $conn->affected_rows;
					if($ReleaseValue == 1){
        				
						echo "<p class= 'echoText'>Successfully updated and released to customer devices </p>";
						
						//echo "<p class ='echoText'>This is release:" . $Release;
					   //echo "<p class ='echoText'>This is commercial:" . $Commercial;
					}
					else{
						
        				echo "<p class= 'echoText'>Successfully updated but not released </p>";
						
                     
					}
        			
				
				
				
        			
        			} 
        } 
        	
	
	}
	


?> 



<link rel="stylesheet" type="text/css" href=<?php bloginfo('wpurl'); ?>/wp-content/themes/twentyfourteen/video.css />
<script type="text/javascript" src=<?php bloginfo('wpurl'); ?>/wp-content/themes/twentyfourteen/video.js></script>
<div id="main-content" class="main-content">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		
		<form method="post" id="frmVideo" action="<?php $_SERVER['REQUEST_URI']; ?>">
        
        <pre style="background-color:#E5E4E2;text-align:center;"> Update video</pre>
    	  
    	<?php
    		$id = $ID;
			//echo "<p Class = 'echoTextInRed'> This is the" . $id . " of the video</p>";
		
    		$Records = VideoSelect($id);
			
    		if($row = $Records->fetch_assoc()) {
				if($row['ImageLocation'] == ""){
				
				}
				else{
					echo "<img src='" .$row['ImageLocation'] . "' alt='Video image' height='42' width='42'><br>";
				}
    		echo "Description: " . '<input type="text" placeholder="Enter video description" name="frmDescription" disabled="disabled" value="'.$row['Description'].'"><br>';
    		echo "Title: " . '<input type="text" name="frmTitle" disabled="disabled" value="'.$row['Title'].'"><br>';
			echo "Date uploaded: " . '<input type="text" name="frmDateUploaded" disabled="disabled" value="'.$row['DateUploaded'].'"><br>';
			if($row['Commercial'] == 1){
				echo "<input type='checkbox' name='frmcommercial' value=1 checked='checked' disabled='disabled'>Tick if video is for sale</br>";
			}
			else{
				echo "<input type='checkbox' name='frmcommercial' value= 0 disabled='disabled'>Tick if video is for sale</br>";
			}
			if($row['VideoStatus'] == 1){
			echo "<input type='checkbox' name='frmrelease' value= 1 disabled='disabled'>Release to public</br>";
			}
			else{
			echo "<input type='checkbox' name='frmrelease' value= 0 disabled='disabled'>Release to public</br>";	
			}
			
    	 }
    	
    	?>	
       <!--  <input type ="Hidden" id="hiddenid"  name= "frmid" value = "<?php  echo $_GET["id"]; ?>"  >-->
    	<!--<input id="submit" name="frmsubmit" type="submit" value="Submit" >-->
        
</form>
		
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->




<?php
/* get_sidebar(); */
get_footer();

