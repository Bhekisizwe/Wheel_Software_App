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
        <title>Add Wheel Reprofiling Data</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Add Wheel Reprofiling Data</h3>
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
    			<form style="border:1px solid #888888;width:30%;background-color:#eeeeee" class="rounded" id="reprofilingForm">
    				<input type="text" class="form-control" placeholder="Enter Axle Serial Number" id="axleSerialNumber" pattern="[0-9a-zA-Z\-\s]{2,}" title="Two or more {i.e Only Digits, Letters, Space and Hyphens allowed} characters necessary for the Axle Serial Number" autocomplete="on" required><p>
		    		<p>		    		
		    		<input type="number" min="500" max="2000" step="0.01" class="form-control" placeholder="Enter Initial Left Wheel Taperline Diameter (mm)" id="initialLeftDiameter" required><p>
		    		<input type="number" min="500" max="2000" step="0.01" class="form-control" placeholder="Enter Final Left Wheel Taperline Diameter (mm)" id="finalLeftDiameter" required><p>
		    		<input type="number" min="500" max="2000" step="0.01" class="form-control" placeholder="Enter Initial Right Wheel Taperline Diameter (mm)" id="initialRightDiameter" required><p>
		    		<input type="number" min="500" max="2000" step="0.01" class="form-control" placeholder="Enter Final Right Wheel Taperline Diameter (mm)" id="finalRightDiameter" required><p>
		    		<input type="number" min="0" max="1000000000" step="0.01" class="form-control" placeholder="Enter Cost of Wheel Reprofiling Service (R)" id="costOfService" required>
		    		<label>Date of Service:</label><input type="date" class="form-control" id="dateOfService" pattern="[0-9a-zA-Z]{4,}" title="Four or more Alpha-Numeric characters {i.e Only digits and letters allowed} necessary for the surburb" autocomplete="on" required><p>
		    		<p>		    		
		    		<input type="text" class="form-control" placeholder="Enter Service Provider Name" id="serviceProviderName" pattern="[0-9a-zA-Z\-\s]{2,}" title="Two or more {i.e Only Digits, Letters, Space and Hyphens allowed} characters necessary for the Service Provider Name" autocomplete="on" required><p>
		    		<p>	    			    			    		
		    		<input type="submit" id="addReprofiling" class="btn btn-primary" value="ADD WHEEL REPROFILING DATA"><p>	
		    		
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
            //$holder_add=$("#addLicense").detach();
            //$holder_edit=$("#editLicense").detach();
            $.ajaxSetup({cache: false});             
		    
			$("#reprofilingForm").on("submit",function(event){													
				//var data_arr=new Array();
				if($("#reprofilingForm")[0].checkValidity()){					
					//initialise object literal.
					objData={};
					objData["axleSerialNumber"]=$("#axleSerialNumber").val();
					objData["initialLeftDiameter"]=$("#initialLeftDiameter").val();	
					objData["initialRightDiameter"]=$("#initialRightDiameter").val();
					objData["finalLeftDiameter"]=$("#finalLeftDiameter").val();	
					objData["finalRightDiameter"]=$("#finalRightDiameter").val();
					objData["costOfService"]=$("#costOfService").val();
					objData["dateOfService"]=$("#dateOfService").val();	
					objData["serviceProviderName"]=$("#serviceProviderName").val();						
					json_data=JSON.stringify(objData);
					//alert(json_data);
					if($("#addReprofiling").length>0){
						$('#addReprofiling').val("ADDING WHEEL REPROFILING DATA...");
						$('#addReprofiling').prop('disabled', true);
						//we are adding
						//add user account
						$.ajax({
							type: "GET",
							contentType: "application/json",
							url: "/wheelreprofiling/checkexistence/"+objData["axleSerialNumber"]+"_"+objData["serviceProviderName"]+"_"+objData["dateOfService"],							
							dataType: 'json',
							cache: false,							
							success: function (data) {								
								if(data["transactionStatus"]){									
									if(data["dataExistsStatus"]){
										//then we know that there is a duplicate Staff Number
										$('#addReprofiling').val("ADD WHEEL REPROFILING DATA");
										$('#addReprofiling').prop('disabled', false);
										alert("The wheel reprofiling data entered already exists in the system,\n please add new data.");
									}
									else{
										//create the account
										$.ajax({
                						type: "POST",
                						contentType: "application/json",
                						url: "/wheelreprofiling/add",	
                						data:json_data,						
                						dataType: 'json',
                						cache: false,							
                						success: function (data) {
                							$('#addReprofiling').val("ADD WHEEL REPROFILING DATA");
    										$('#addReprofiling').prop('disabled', false);
											if(data["transactionStatus"]){
												alert("Wheel Reprofiling Data Successfully Added!");													
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
                							$('#addReprofiling').val("ADD WHEEL REPROFILING DATA");
    										$('#addReprofiling').prop('disabled', false);
                							alert("transaction failed to execute with error"+e);
                						}
									  });
									}								    								    	
							    }
							    else{
							    	$('#addReprofiling').prop('disabled', false);							    	
							    	if(data["errorAssocArray"]["errorCode"]=="0x19"){
								    	//session has expired
								    	alert(data["errorAssocArray"]["errorDescription"]);
								    	window.location="index.html";
							    	}
							    	else{								    	
							    		alert("transaction failed to execute"); 
							    	}	    
							    }
							},
							error: function (e) {
								$('#addReprofiling').val("ADD WHEEL REPROFILING DATA");
								$('#addReprofiling').prop('disabled', false);
								alert("transaction failed to execute with error"+e);
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