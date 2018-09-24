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
        <title>Manage Wheel Wear Rate Settings</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Manage Wheel Wear Rate Settings</h3>
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
    			<form style="border:1px solid #888888;width:30%;background-color:#eeeeee" class="rounded" id="wearForm">    				
    				<div id="populateForm"></div>
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
			var wearArray;
        	url="/wearratessettings/parameters"; 
        	$.ajaxSetup({cache: false});           
        	var jqxhr=$.getJSON(    
		    url,    			    
		    function(data,status){    			    	
		    	//alert(data["staffNumber"]);    			        
		    }).done(function(data){		    
		    	//successfully executed transaction	
		    	var html_str="";
		    	for(var i=0;i<data["wearRate2DArray"].length;i++){			    	
					html_str+='<label>'+data["wearRate2DArray"][i]["paramName"]+' Wear Rate:</label><br><input type="number" min="0.0000001" max="1" step="0.0000001" id="wearRate'+i+'" required><label>mm/km</label><br>';
					html_str+='<input type="hidden" value="'+data["wearRate2DArray"][i]["paramID"]+'" id="paramID'+i+'">';					
					html_str+='<input type="hidden" value="" id="wearID'+i+'">';					
		    	} 
		    	$("#populateForm").html(html_str); 
		    	wearArray=data["wearRate2DArray"];     
		    }).fail(function(data){
		    	alert("Error:transaction failed");    			    	
		    }); 

        	url="/wearratessettings";            
        	var jqxhr=$.getJSON(    
		    url,    			    
		    function(data,status){    			    	
		    	//alert(data["staffNumber"]);    			        
		    }).done(function(data){		    
		    	//successfully executed transaction
		    	if(data["transactionStatus"]){
		    		var html_str="";
		    		if(data["wearRate2DArray"]!=null){
		    			for(var i=0;i<data["wearRate2DArray"].length;i++){			    	
							$("#wearRate"+i).val(data["wearRate2DArray"][i]["wearRate"]);
							$("#wearID"+i).val(data["wearRate2DArray"][i]["wearID"]);
							$("#paramID"+i).val(data["wearRate2DArray"][i]["paramID"]);						
				    	}
		    			html_str='<input type="submit" id="editWear" class="btn btn-primary" value="EDIT WHEEL WEAR RATES"><p>';
						$("#buttonID").html(html_str); 		    			
		    		}
		    		else{
		    			html_str='<input type="submit" id="addWear" class="btn btn-primary" value="SET WHEEL WEAR RATES"><p>';
						$("#buttonID").html(html_str); 
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
                                                   
            //$holder_add=$("#addLicense").detach();
            //$holder_edit=$("#editLicense").detach();
			$("#wearForm").on("submit",function(event){				
				if($("#wearForm")[0].checkValidity()){						
					//initialise object literal.
					objData={"wearRate2DArray":{}};
					for(var j=0;j<wearArray.length;j++){
						objData["wearRate2DArray"][""+j+""]={"wearID":$("#wearID"+j).val(),"paramID":$("#paramID"+j).val(),"wearRate":$("#wearRate"+j).val()};
					}		
																				
					json_data=JSON.stringify(objData);	
					//alert(json_data);					
					if($("#addWear").length>0){
						$('#addWear').val("SETTING WHEEL WEAR RATES");
						$('#addWear').prop('disabled', true);
						//we are assigning
						//assign number of axles
						$.ajax({
						type: "POST",
						contentType: "application/json",
						url: "/wearratessettings/add",	
						data:json_data,						
						dataType: 'json',
						cache: false,							
						success: function (data) { 
							$('#addWear').val("SET WHEEL WEAR RATES");
							$('#addWear').prop('disabled', false);							               							
							if(data["transactionStatus"]){
								alert("Successfully Set Wheel Wear Rates!");								
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
							$('#addWear').val("SET WHEEL WEAR RATES");
							$('#addWear').prop('disabled', false);	
							alert("transaction failed to execute with error "+e.responseText);
						}
					  });
									
					}
					if($("#editWear").length>0){
						$('#editWear').val("UPDATING WHEEL WEAR RATES");
						$('#editWear').prop('disabled', true);
						//we are assigning
						//assign number of axles
						$.ajax({
						type: "POST",
						contentType: "application/json",
						url: "/wearratessettings/update",	
						data:json_data,						
						dataType: 'json',
						cache: false,							
						success: function (data) { 
							$('#editWear').val("EDIT WHEEL WEAR RATES");
							$('#editWear').prop('disabled', false);							               							
							if(data["transactionStatus"]){
								alert("Successfully Updated Wheel Wear Rates!");								
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
							$('#editWear').val("EDIT WHEEL WEAR RATES");
							$('#editWear').prop('disabled', false);	
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