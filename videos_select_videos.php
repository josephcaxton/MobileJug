<?php
/**
  Template Name: Video select videos
 */
require 'video_db_connection.php';
get_header(); 
 
 
 ?>
<link rel="stylesheet" type="text/css" href=<?php bloginfo('wpurl'); ?>/wp-content/themes/twentyfourteen/video.css />
<script type="text/javascript" src=<?php bloginfo('wpurl'); ?>/wp-content/themes/twentyfourteen/video.js></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<div id="main-content" class="main-content">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
 <script type="text/javascript">
		$("document").ready(function(){
			$(".editbtn").on("click",showMessage);
		});
		function showMessage(evt){
			//var id = this.id;
			var id = $(this).attr('id');
			//alert(id);
			window.location = "index.php?page_id=80&id=" + id;	
		
		}
		
</script>
 	<?php
	
	$conn = OpenDataBaseConnection();
	/* Could not get this to work returning from SP
	/*if (!$conn->multi_query("CALL SelectVideosNotLive()")) {
    echo "CALL failed: (" . $conn->errno . ") " . $conn->error;
}

do {
    if ($res = $conn->store_result()) {
       
       var_dump($res->fetch_all());
		
        $res->free();
    } else {
        if ($conn->errno) {
            echo "Store failed: (" . $conn->errno . ") " . $conn->error;
        }
    }
} while ($conn->more_results() && $conn->next_result()); */
	if(post_password_required()){
	 the_content();

}
else{ 
	$website = site_url();
	
	 $sql = 'SELECT * FROM Videos.VideoTransactions where VideoStatus = 0';
	 		
			if ($rs = $conn->query($sql)){
			echo "<table class='tablecss'>";
				echo "<tr><td>" . "Video Title" . "</td><td>" . "Uploaded on" . "</td><td>" . "Description" . "</td><td>" . "Image" . "</td><td>" . "Play". "</td><td>" . "Edit" . "</td></tr>";
				 while($row = mysqli_fetch_array($rs)){ 
				echo "<tr><td>" . $row['Title'] . "</td><td>" . $row["DateUploaded"]." </td><td>" . $row["Description"]."  </td><td><img Class='videocenter' src= ". $website . $row["ImageLocation"]."  /></td><td><video class='videocenter' controls><source src=" .$website . $row['URN'] . "/all.m3u8></source>" . "<source src=" .$website . $row['URN'] . "/30/". $row['Title'] . "_30.mp4 > Your browser does not support this video</source></video></td><td><button class='editbtn' id= " . $row['ID'] . ">edit</button></td></tr>";
				 
				}
			echo "</table>";
			} 
			
	/* this is not working as well */
	/*if ($conn != 0){
	 
		$rs = msqli_query($conn,"CALL SelectVideosNotLive()"); //CALL SelectVideosNotLive()
		


				echo "<table class='tablecss'>";
				echo "<tr><td>" . "ID" . "</td><td>" . "Video Title" . "</td><td>" . "Uploaded on" . "</td></tr>";
				 while($row = mysqli_fetch_array($rs)){ 
				echo "<tr><td>" . $row['ID'] . "</td><td>" . $row['Title'] . "</td><td>" . $row["DateUploaded"]." </td></tr>";
				 
				}
		echo "</table>";
		
		
		
	} */
	else{

		 echo "<p Class = 'echoTextInRed'> Cannot connect to database </p>";

		}
	

}

?> 
 
		
		
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php /*get_sidebar( 'content' );*/ ?>
</div><!-- #main-content -->


<?php
/* get_sidebar(); */
get_footer();

