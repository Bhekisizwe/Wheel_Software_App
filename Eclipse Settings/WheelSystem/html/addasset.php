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
        <title>Add Asset to Asset Register</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Add Asset to Asset Register</h3>
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
    			<form style="border:1px solid #888888;width:30%;background-color:#eeeeee" class="rounded" id="assetForm">
    				 				
    				<input type="text" class="form-control" placeholder="Enter Coach Type {e.g 10M2,10M2T, e.t.c}" id="coachType" pattern="[0-9a-zA-Z\-\s]{2,}" title="Two or more {i.e Only Digits, Letters, Space and Hyphens allowed} characters necessary for the Coach Type" autocomplete="on" required><p>
		    		<p>
		    		<label>Select Coach Category:</label>
		    		<select id="coachCategory" required>
		    			<option value=''>--Select Coach Category--</option>
		    			<option value='T'>Trailer Coach</option>
		    			<option value='M'>Motor Coach</option>
		    			<option value='L'>Locomotive</option>
					<option value='W'>Wagon</option>
		    		</select><p>		    			
		    		<input type="text" class="form-control" placeholder="Enter Coach Number {e.g 10M2800T,10118, e.t.c}" id="coachNumber" pattern="[0-9a-zA-Z\-\s]{2,}" title="Two or more {i.e Only Digits, Letters, Space and Hyphens allowed} characters necessary for the Coach Number" autocomplete="on" required><p>
		    		<p>		    		 		
		    		<input type="submit" id="addAsset" class="btn btn-primary" value="ADD ASSET TO REGISTER"><p>	
		    		
    			</form>
	    	
            </div>
            <div style='position:fixed;bottom:0px;text-align:center;width:100%'>&copy Gqunsu Engineering Pty Ltd 2018-</div>
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
            //$holder_add=$("#addLicense").detach();
            //$holder_edit=$("#editLicense").detach();
			$("#assetForm").on("submit",function(event){												
				
				if($("#assetForm")[0].checkValidity()){						
					//initialise object literal.
					var coachType=$("#coachType").val();
					var coachNumber=$("#coachNumber").val();
					objData={"coachDetails2DArray":{}};				
					objData["coachDetails2DArray"]["0"]={"coachType":coachType.trim(),"coachCategory":$("#coachCategory").val()};					
					objData["coachNumber"]=coachNumber.trim();																
					json_data=JSON.stringify(objData);	
					//alert(json_data);					
					if($("#addAsset").length>0){
						$('#addAsset').val("ADDING ASSET TO REGISTER");
						$('#addAsset').prop('disabled', true);
						//we are adding
						//add admin account
						$.ajax({
							type: "GET",
							contentType: "application/json",
							url: "/assetregisterservice/checkexistence/"+objData["coachNumber"],							
							dataType: 'json',
							cache: false,							
							success: function (data) {								
								if(data["transactionStatus"]){
									$('#addAsset').val("ADD ASSET TO REGISTER");
									$('#addAsset').prop('disabled', false);
									if(data["dataExistsStatus"]){
										//then we know that there is a duplicate Coach Number										
										alert("The coach number entered already exists in the system,\n please try another one.");
									}
									else{
										//add the asset
										$.ajax({
                						type: "POST",
                						contentType: "application/json",
                						url: "/assetregisterservice/add",	
                						data:json_data,						
                						dataType: 'json',
                						cache: false,							
                						success: function (data) {                							
											if(data["transactionStatus"]){
												alert("Asset Successfully Added!");													
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
                							$('#addAsset').val("ADD ASSET TO REGISTER");
        									$('#addAsset').prop('disabled', false);
                							alert("transaction failed to execute with error "+e.responseText);
                						}
									  });
									}								    								    	
							    }
							    else{
							    	$('#addAsset').val("ADD ASSET TO REGISTER");
									$('#addAsset').prop('disabled', false);
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
								$('#addAsset').val("ADD ASSET TO REGISTER");
								$('#addAsset').prop('disabled', false);
								alert("transaction failed to execute with error"+e.responseText);
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