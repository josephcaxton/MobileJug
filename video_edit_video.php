<?php
/**
  Template Name: Edit Video
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
 


<link rel="stylesheet" type="text/css" href=<?php bloginfo('wpurl'); ?>/wp-content/themes/twentyfourteen/video.css />
<script type="text/javascript" src=<?php bloginfo('wpurl'); ?>/wp-content/themes/twentyfourteen/video.js></script>
<div id="main-content" class="main-content">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		
		<form method="post" id="frmVideo" action="/?page_id=86">
        
        <pre style="background-color:#E5E4E2;text-align:center;"> Update video</pre>
    	  
    	<?php
    		$id = $_GET["id"];
			//echo "<p Class = 'echoTextInRed'> This is the" . $id . " of the video</p>";
		
    		$Records = VideoSelect($id);
			
    		if($row = $Records->fetch_assoc()) {
				if($row['ImageLocation'] == ""){
				
				}
				else{
					echo "<img src='" .$row['ImageLocation'] . "' alt='Video image' Class='videocenter'><br>";
				}
    		echo "Description: " . '<input type="text" placeholder="Enter video description" name="frmDescription" value="'.$row['Description'].'"><br>';
    		echo "Title: " . '<input type="text" name="frmTitle" disabled="disabled" value="'.$row['Title'].'"><br>';
			echo "Date uploaded: " . '<input type="text" name="frmDateUploaded" disabled="disabled" value="'.$row['DateUploaded'].'"><br>';
			if($row['Commercial'] == 1){
				echo "<input type='checkbox' name='frmcommercial' value= 1 checked='checked' onClick='checkSwitch(this)'>Tick if video is for sale</br>";
			}
			else{
				echo "<input type='checkbox' name='frmcommercial' value= 0 onClick='checkSwitch(this)' >Tick if video is for sale</br>";
			}
			if($row['VideoStatus'] == 1){
				echo "<input type='checkbox' name='frmrelease' value= 1 checked='checked' onClick='checkSwitch(this)'>Release to public</br>";
			}
			else{
			echo "<input type='checkbox' name='frmrelease' value= 0 onClick='checkSwitch(this)'>Release to public</br>";
			}
			
    	 }
    	
    	?>	
         <input type ="Hidden" id="hiddenid"  name= "frmid" value = "<?php  echo $_GET["id"]; ?>"  >
    	<input id="submit" name="frmsubmit" type="submit" value="Submit" >
        
</form>
		
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

 

<?php
/* get_sidebar(); */
get_footer();

