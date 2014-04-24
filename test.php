<?php 
 if (isset($_POST['frmsubmit'])){
	
	$conn = OpenDataBaseConnection();
	$ID = $_POST['frmid'];
    $Description = $_POST['frmDescription'];
    
	$ReleaseValue = 0;
    $CommercialValue = 0;
	
	$Release = $_POST['frmrelease'];
	
	if(!$Release == ''){
		$ReleaseValue = 1;
		echo "<p class= 'echoText'>Video is now live on users devices </p>";
	}
	
	$Commercial = $_POST['frmcommercial'];
	
   if(!$Commercial == ''){
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
					if( $ReleaseValue = 1){
        				header( "Location:" . $_SERVER['REQUEST_URI'] ) ;
					}
					else{
						
        				//echo "<p class= 'echoText'>Successfully updated </p>";
						
                     header("Location: http://www.google.com");
					}
        			
				
				
				
        			
        			} 
        } 
        	
	
	}
	

 
?> 

