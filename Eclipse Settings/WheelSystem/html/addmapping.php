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
        <title>Add Axle Serial Number-Coach Mapping Entry</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Add Axle Serial Number-Coach Mapping Entry</h3>
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
    			<form style="border:1px solid #888888;width:30%;background-color:#eeeeee" class="rounded" id="axleForm">
    				 				
    				<input type="text" class="form-control" id="axleSerialNumber" placeholder="Enter Axle Serial Number" pattern="[0-9a-zA-Z\-\s]{2,}" title="Two or more {i.e Only Digits, Letters, Space and Hyphens allowed} characters necessary for the Axle Serial Number" autocomplete="on" required><p>
		    		<p>
		    		<label>Select Axle Number:</label>
		    		<select id="axleNumber" required>
		    			<option value=''>--Select Axle Number--</option>
		    			<option value='1'>1</option>
		    			<option value='2'>2</option>
		    			<option value='3'>3</option>
		    			<option value='4'>4</option>
		    		</select><p>
		    		<input type="text" class="form-control" placeholder="Enter Set Number {e.g N3,S4, e.t.c}" id="setNumber" pattern="[0-9a-zA-Z\-\s]{2,}" title="Two or more {i.e Only Digits, Letters, Space and Hyphens allowed} characters necessary for the Set Number" autocomplete="on" required><p>
		    		<p>		    			
		    		<input type="text" class="form-control" placeholder="Enter Coach Number {e.g 10M2800T,10118, e.t.c}" id="coachNumber" pattern="[0-9a-zA-Z\-\s]{2,}" title="Two or more {i.e Only Digits, Letters, Space and Hyphens allowed} characters necessary for the Coach Number" autocomplete="on" required><p>
		    		<p>		    		 		
		    		<input type="submit" id="addMapping" class="btn btn-primary" value="ADD AXLE-COACH MAPPING"><p>	
		    		
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
			$("#axleForm").on("submit",function(event){												
				
				if($("#axleForm")[0].checkValidity()){						
					//initialise object literal.
					objData={};				
					objData["setNumber"]=$("#setNumber").val();					
					objData["coachNumber"]=$("#coachNumber").val();	
					objData["axleNumber"]=$("#axleNumber").val();	
					objData["axleSerialNumber"]=$("#axleSerialNumber").val();																
					json_data=JSON.stringify(objData);	
					//alert(json_data);					
					if($("#addMapping").length>0){
						$('#addMapping').val("ADDING AXLE-COACH MAPPING");
						$('#addMapping').prop('disabled', true);
						//we are adding						
						
						//add the mapping
						$.ajax({
						type: "POST",
						contentType: "application/json",
						url: "/axlecoachmappingservice/add",	
						data:json_data,						
						dataType: 'json',
						cache: false,							
						success: function (data) {
							$('#addMapping').val("ADD AXLE-COACH MAPPING");
							$('#addMapping').prop('disabled', false);                							
							if(data["transactionStatus"]){
								alert("Axle-Coach Mapping Successfully Added!");													
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
							$('#addMapping').val("ADD AXLE-COACH MAPPING");
							$('#addMapping').prop('disabled', false);
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