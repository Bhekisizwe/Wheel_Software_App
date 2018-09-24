<?php
use UserClasses\BusinessLayer\ManageSession;

session_start();
require __DIR__."\\..\\vendor\autoload.php";
$manageSession=new ManageSession();
if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
if(isset($_SESSION["staffNumber"])){
    ?>
    	<!doctype html>
		<html lang="en">
  		<head>
        <!-- Required meta tags -->
    	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/themes/default/style.min.css" />
        <!-- <link rel="stylesheet" href="css/bootstrap-treeview.css">-->
        <title>Manage Average Daily Distance Travelled By Train</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Manage Average Daily Distance Travelled By Train</h3>
            	<i><div style="font-family:arial;font-size:14pt">Logged in as:<b><?php echo $_SESSION["name"]." ".$_SESSION["surname"]; ?></b></div></i><p>
            	[<a href='logout.php' class='active'><b>Logout</b></a>]            	
            	<?php if($_SESSION["userRoleName"]!="Admin"){
            	?>
            		[<a href='normalmenu.php' class='active'><b>Back to User Menu</b></a>]<p>
            	<?php 
            	}
            	else{            	
            	?>
            		[<a href='adminmenu.php' class='active'><b>Back to Administrator Menu</b></a>]<p>
            	<?php
            	}
            	?>            
            	<div class="form-group">
    			<form style="border:1px solid #888888;width:30%;background-color:#eeeeee" class="rounded" id="distanceForm">
    				<input type="hidden" value="" id="distanceID">
    				<label>Average Daily Distance:</label>
    				<input type="number" min="0.1" max="100000.0" step="0.01" id="distance" required><label>km</label><p>
		    		<div id="buttonID"></div>	    		
    			</form>
	    	
            </div>
        </div>
         <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="dist/jstree.min.js"></script>
        <!-- <script src="js/bootstrap-treeview.js"></script> -->       
        <script>
        $(document).ready(function(){ 
        	$.ajaxSetup({cache: false});  
        	url="/dailydistancesetting";            
        	var jqxhr=$.getJSON(    
		    url,    			    
		    function(data,status){    			    	
		    	//alert(data["staffNumber"]);    			        
		    }).done(function(data){		    
		    	//successfully executed transaction	
		    	if(data["distance"]!=0){
					//then we know data exists
					html_str='<input type="submit" id="editDistance" class="btn btn-primary" value="EDIT DISTANCE TRAVELLED"><p>';	
					$("#buttonID").html(html_str);
					$("#distanceID").val(data["distanceID"]);
					$("#distance").val(data["distance"]);
				}
				else{
					html_str='<input type="submit" id="addDistance" class="btn btn-primary" value="SET DISTANCE TRAVELLED"><p>';		
					$("#buttonID").html(html_str);
					$("#distance").val("");
				}         
		    }).fail(function(data){
		    	alert("Error:transaction failed");    			    	
		    }); 
                                                   
            //$holder_add=$("#addLicense").detach();
            //$holder_edit=$("#editLicense").detach();
			$("#distanceForm").on("submit",function(event){												
				
				if($("#distanceForm")[0].checkValidity()){						
					//initialise object literal.
					objData={};				
					objData["distanceID"]=$("#distanceID").val();
					objData["distance"]=$("#distance").val();																
					json_data=JSON.stringify(objData);	
					//alert(json_data);					
					if($("#addDistance").length>0){
						$('#addDistance').val("SETTING DISTANCE TRAVELLED");
						$('#addDistance').prop('disabled', true);
						//we are assigning
						//assign number of axles
						$.ajax({
						type: "POST",
						contentType: "application/json",
						url: "/dailydistancesetting/add",	
						data:json_data,						
						dataType: 'json',
						cache: false,							
						success: function (data) { 
							$('#addDistance').val("SET DISTANCE TRAVELLED");
							$('#addDistance').prop('disabled', false);							               							
							if(data["transactionStatus"]){
								alert("Successfully Set Average Daily Distance Travelled!");								
								location.reload();													
							}
							else{												
								if(data["errorAssocArray"]["errorCode"]=="0x19"){
							    	//session has expired
							    	alert(data["errorAssocArray"]["errorDescription"]);
							    	window.location="index.html";
						    	}
								else if(data["errorAssocArray"]["errorCode"]=="0x18"){											    	
							    	alert(data["errorAssocArray"]["errorDescription"]);											    	
						    	}													
						    	else{								    	
						    		alert("transaction failed to execute"); 
						    	}	
							}
						},
						error: function (e) {
							$('#addDistance').val("SET DISTANCE TRAVELLED");
							$('#addDistance').prop('disabled', false);	
							alert("transaction failed to execute with error "+e.responseText);
						}
					  });
									
					}
					if($("#editDistance").length>0){
						$('#editDistance').val("UPDATING DISTANCE TRAVELLED");
						$('#editDistance').prop('disabled', true);
						//we are assigning
						//assign number of axles
						$.ajax({
						type: "POST",
						contentType: "application/json",
						url: "/dailydistancesetting/update",	
						data:json_data,						
						dataType: 'json',
						cache: false,							
						success: function (data) { 
							$('#editDistance').val("EDIT DISTANCE TRAVELLED");
							$('#editDistance').prop('disabled', false);							               							
							if(data["transactionStatus"]){
								alert("Successfully Updated Average Daily Distance Travelled!");								
								location.reload();													
							}
							else{												
								if(data["errorAssocArray"]["errorCode"]=="0x19"){
							    	//session has expired
							    	alert(data["errorAssocArray"]["errorDescription"]);
							    	window.location="index.html";
						    	}
								else if(data["errorAssocArray"]["errorCode"]=="0x18"){											    	
							    	alert(data["errorAssocArray"]["errorDescription"]);											    	
						    	}													
						    	else{								    	
						    		alert("transaction failed to execute"); 
						    	}	
							}
						},
						error: function (e) {
							$('#editDistance').val("EDIT DISTANCE TRAVELLED");
							$('#editDistance').prop('disabled', false);		
							alert("transaction failed to execute with error "+e.responseText);
						}
					  });
									
					}				
					
				}							
				event.preventDefault();
			});	    
			
        });
        </script>  
        </body>
        </html>
<?php 
        $_SESSION["lastActive"]=time();
    }
    else{
        echo "<html><head><title></title><script>alert('Session Has Expired');window.location='index.html';</script></head><body></html>";
        session_unset();
        session_destroy();
    }
?>