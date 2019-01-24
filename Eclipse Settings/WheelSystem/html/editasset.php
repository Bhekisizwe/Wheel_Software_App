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
        <title>Edit Asset</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Edit Asset</h3>
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
            	<form style="border:1px solid #888888;width:30%;background-color:#eeeeee" class="rounded" id="searchForm">
            		<input type="text" id="searchBox" class="form-control" placeholder="Asset register search occurs as you type Coach Number" autocomplete="off">
    				<!-- <input type="submit" id="searchButton" class="btn btn-primary" value="SEARCH"><p>-->
            	</form></div><p>
            	<div class="form-group">
    			<form style="border:1px solid #888888;width:30%;background-color:#eeeeee" class="rounded" id="assetForm">
    				<input type="hidden" id="assetID" value="">   				   			  				
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
		    		<input type="submit" id="editAsset" class="btn btn-primary" value="EDIT ASSET"><p>	
		    		
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
		    
            //Search for asset
            
            $("#searchBox").on("keyup",function(){				
			    var coachNumber=$("#searchBox").val().trim();			    
			    //alert(staffNumber);
			    if(coachNumber!=""){
			    	$.ajax({
						type: "GET",
						contentType: "application/json",
						url: "/assetregisterservice/"+coachNumber,							
						dataType: 'json',
						cache: false,							
						success: function (data) {							
							if(data["transactionStatus"]){								
								$("#assetID").val(data["assetID"]);
								$("#coachNumber").val(data["coachNumber"]);
								$("#coachType").val(data["coachDetails2DArray"][0]["coachType"]);
								$("#coachCategory").val(data["coachDetails2DArray"][0]["coachCategory"].toUpperCase());																														
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
						    		alert("Transaction execution failed");	
						    	}	
							}
						},
						error: function (e) {
							alert("Error:transaction failed to execute with error "+e);
						}
			    	});	
			    }
			    else{			    	
			    	$("#coachNumber").val("");		
			    	$("#coachType").val("");	
			    	$("#coachCategory").val("");		
			    }	    	
		    }); 
            
			$("#assetForm").on("submit",function(event){													
				//var data_arr=new Array();
				if($("#assetForm")[0].checkValidity()){					
					//initialise object literal.
					objData={"assetID":0,
							"coachNumber":"",
							"coachDetails2DArray":{}
							};
					objData["assetID"]=$("#assetID").val();
					objData["coachNumber"]=$("#coachNumber").val().trim();	
					objData["coachDetails2DArray"]["0"]={"coachCategory":$("#coachCategory").val(),"coachType":$("#coachType").val().trim()};						
					
					json_data=JSON.stringify(objData);
					
					if($("#editAsset").length>0){
						$('#editAsset').val("UPDATING ASSET");
						$('#editAsset').prop('disabled', true);
						//we are updating!!!												
						//update the account
						$.ajax({
						type: "POST",
						contentType: "application/json",
						url: "/assetregisterservice/update",	
						data:json_data,						
						dataType: 'json',
						cache: false,							
						success: function (data) {
							$('#editAsset').val("EDIT ASSET");
							$('#editAsset').prop('disabled', false);
							//alert(data["transactionStatus"]);
							if(data["transactionStatus"]){
								alert("Asset Successfully Updated!");
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
							$('#editAsset').val("EDIT ASSET");
							$('#editAsset').prop('disabled', false);
							alert("transaction failed to execute with error "+e);
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