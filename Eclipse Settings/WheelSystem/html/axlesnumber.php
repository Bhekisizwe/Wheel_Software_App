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
        <title>Manage Number of Axles Per Coach</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Manage Number of Axles Per Coach</h3>
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
    				<label>Select Coach Type:</label>
		    		<div id="populateDropDown"></div>
		    		<label>Select Number of Axles:</label><p>		    			
		    		<select id="axleNumber" required>
		    			<option value=''>--Select Number of Axles</option>
		    			<option value='2'>2</option>
		    			<option value='3'>3</option>
		    			<option value='4'>4</option>
		    			<option value='5'>5</option>
		    			<option value='6'>6</option>
		    		</select>
		    		<div id="buttonID"></div>	    		
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
        	url="/assetregisterservice";            
        	var jqxhr=$.getJSON(    
		    url,    			    
		    function(data,status){    			    	
		    	//alert(data["staffNumber"]);    			        
		    }).done(function(data){		    
		    	//successfully executed transaction	
		    	var html_str="<select id='coachTypes' required><option value='' selected>--Select Coach Type--</option>";
		    	for(var i=0;i<data['coachDetails2DArray'].length;i++){			    			    				    	
		    		html_str+="<option value='"+data['coachDetails2DArray'][i]['coachID']+"'>"+data['coachDetails2DArray'][i]['coachType']+"</option>";		    		
		    	}		    	
		    	html_str+="</select><p>";
		    	$("#populateDropDown").append(html_str);           
		    }).fail(function(data){
		    	alert("Error:transaction failed");    			    	
		    }); 

        	$("#populateDropDown").on("change","select",function() {
            	coachID=$("#coachTypes").val();
            	if(coachID!=""){
            		url="/axlespercoach/"+coachID;            
                	var jqxhr=$.getJSON(    
        		    url,    			    
        		    function(data,status){    			    	
        		    	//alert(data["staffNumber"]);    			        
        		    }).done(function(data){		    
        		    	//successfully executed transaction	
    		    	if(data["transactionStatus"]){
    					if(data["numberOfAxles"]!=0){
    						//then we know data exists
    						html_str='<input type="submit" id="editAxleNumber" class="btn btn-primary" value="RE-ASSIGN AXLE NUMBERS"><p>';	
    						$("#buttonID").html(html_str);
    						$("#axleNumber").val(data["numberOfAxles"]);
    					}
    					else{
    						html_str='<input type="submit" id="addAxleNumber" class="btn btn-primary" value="ASSIGN AXLE NUMBERS"><p>';		
    						$("#buttonID").html(html_str);
    						$("#axleNumber").val("");
    					}
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
        		    }).fail(function(data){
        		    	alert("Error:transaction failed");    			    	
        		    });
            	}        		
		    });   
		                                                         
            //$holder_add=$("#addLicense").detach();
            //$holder_edit=$("#editLicense").detach();
			$("#axleForm").on("submit",function(event){												
				
				if($("#axleForm")[0].checkValidity()){						
					//initialise object literal.
					objData={};				
					objData["coachID"]=$("#coachTypes").val();
					objData["numberOfAxles"]=$("#axleNumber").val();																
					json_data=JSON.stringify(objData);	
					//alert(json_data);					
					if($("#addAxleNumber").length>0){
						$('#addAxleNumber').val("ASSIGNING AXLE NUMBERS");
						$('#addAxleNumber').prop('disabled', true);
						//we are assigning
						//assign number of axles
						$.ajax({
						type: "POST",
						contentType: "application/json",
						url: "/axlespercoach/add",	
						data:json_data,						
						dataType: 'json',
						cache: false,							
						success: function (data) { 
							$('#addAxleNumber').val("ASSIGN AXLE NUMBERS");
							$('#addAxleNumber').prop('disabled', false);							               							
							if(data["transactionStatus"]){
								alert("Successfully Assigned Number of Axle to Coach Type!");								
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
							$('#addAxleNumber').val("ASSIGN AXLE NUMBERS");
							$('#addAxleNumber').prop('disabled', false);	
							alert("transaction failed to execute with error "+e.responseText);
						}
					  });
									
					}
					if($("#editAxleNumber").length>0){
						$('#editAxleNumber').val("RE-ASSIGNING AXLE NUMBERS");
						$('#editAxleNumber').prop('disabled', true);
						//we are assigning
						//assign number of axles
						$.ajax({
						type: "POST",
						contentType: "application/json",
						url: "/axlespercoach/update",	
						data:json_data,						
						dataType: 'json',
						cache: false,							
						success: function (data) { 
							$('#editAxleNumber').val("RE-ASSIGN AXLE NUMBERS");
							$('#editAxleNumber').prop('disabled', false);							               							
							if(data["transactionStatus"]){
								alert("Successfully Re-assigned Number of Axle to Coach Type!");								
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
							$('#editAxleNumber').val("RE-ASSIGN AXLE NUMBERS");
							$('#editAxleNumber').prop('disabled', false);	
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