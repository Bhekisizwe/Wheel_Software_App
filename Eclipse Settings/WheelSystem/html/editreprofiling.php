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
        <title>Update Wheel Reprofiling Data</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Update Wheel Reprofiling Data</h3>
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
            	<form style="border:1px solid #888888;width:35%;background-color:#eeeeee" class="rounded" id="searchForm">
            		<label>Axle Serial Number:</label>
            		<input type="text" id="axleSerialNumber" class="form-control" placeholder="Enter Axle Serial Number" autocomplete="on" required>            		
            		<label>Search Start Date:</label>
    				<input type="date" id="startDate" class="form-control" value="" min="2010-01-01" max="2110-01-01" required><p>
    				<p>
    				<label>Search End Date:</label>
    				<input type="date" id="endDate" class="form-control" value="" min="2010-01-01" max="2110-01-01" required><p>
    				<p>
    				<input type="submit" id="viewButton" class="btn btn-primary" value="SEARCH FOR WHEEL REPROFILING DATA">
            	</form></div><p> 
            	<caption><b>Search Results:</b></caption><p>            	         	
    			<div id="tableContents" style="width:100%"></div> 
    			<div class="form-group">
    			<form style="border:1px solid #888888;width:35%;background-color:#eeeeee" class="rounded" id="reprofilingForm">  
    				<div id="populateForm"></div><p>
    				<div id="buttonID"></div>   	
            	</form></div>
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
		    var reprofilingArray;
		    var save_index;
            //Search for asset
            
            $("#searchForm").on("submit",function(event){				
			    var axleSerialNumber=$("#axleSerialNumber").val();	
			    var startDate=$("#startDate").val();
			    var endDate=$("#endDate").val();		    
			    //alert("/axlecoachmappingservice/"+axleSerialNumber+"_"+startDate+"_"+endDate);
			    if($("#searchForm")[0].checkValidity()){
				    $("#viewButton").val("SEARCHING...");
				    $("#populateForm").hide();
					$("#buttonID").hide();
			    	$.ajax({
						type: "GET",
						contentType: "application/json",
						url: "/wheelreprofiling/"+axleSerialNumber+"_"+startDate+"_"+endDate,							
						dataType: 'json',
						cache: false,							
						success: function (data) {
							$("#viewButton").val("SEARCH FOR WHEEL REPROFILING DATA");							
							if(data[0]["transactionStatus"]){	
								var html_str="";
								html_str+="<table class='table table-striped table-light' style='width:100%'>";
								html_str+="<th>Axle Serial Number</th><th>Initial Left Diameter</th><th>Final Left Diameter</th><th>Left Wheel Cut length</th><th>Initial Right Diameter</th><th>Final Right Diameter</th><th>Right Wheel Cut length</th><th>Cost of Service</th><th>Date of Service</th><th>Service Provider</th><th>Select Profile to Update</th>";							
								for(var i=0;i<data.length;i++){
									html_str+="<tr><td>"+data[i]["axleSerialNumber"]+"</td>";
									html_str+="<td>"+data[i]["initialLeftDiameter"]+"mm</td>";
									html_str+="<td>"+data[i]["finalLeftDiameter"]+"mm</td>";	
									html_str+="<td>"+data[i]["leftWheelCutLength"]+"mm</td>";
									html_str+="<td>"+data[i]["initialRightDiameter"]+"mm</td>";
									html_str+="<td>"+data[i]["finalRightDiameter"]+"mm</td>";
									html_str+="<td>"+data[i]["rightWheelCutLength"]+"mm</td>";	
									html_str+="<td>R"+data[i]["costOfService"]+"</td>";
									html_str+="<td>"+data[i]["dateOfService"]+"</td>";
									html_str+="<td>"+data[i]["serviceProviderName"]+"</td>";									
									html_str+="<td><input type='radio' name='reprofilingID' value='"+data[i]["reprofilingID"]+"'></td></tr>";
								}
								reprofilingArray=data;
								html_str+="</table><p>";
								//alert(html_str);
								if(data[0]["serviceProviderName"]!=""){
									//alert(html_str);
									$("#tableContents").html(html_str);
									$("#tableContents").show();
								}
								else{
									$("#tableContents").hide();										
								}							
							}
							else{																			
								if(data[0]["errorAssocArray"]["errorCode"]=="0x19"){
							    	//session has expired
							    	alert(data[0]["errorAssocArray"]["errorDescription"]);
							    	window.location="index.html";
						    	}
								else if(data[0]["errorAssocArray"]["errorCode"]=="0x18"){
									alert(data[0]["errorAssocArray"]["errorDescription"]);
								}
						    	else{								    	
						    		alert("Transaction execution failed");	
						    	}	
							}
						},
						error: function (e) {
							$("#viewButton").val("SEARCH FOR WHEEL REPROFILING DATA");	
							alert("Error:transaction failed to execute with error "+e);
						}
			    	});	
			    }
			    else{			    	
			    	$("#tableContents").hide();		
			    }
			    event.preventDefault();	    	
		    }); 

            $(document).on("change","[type='radio']",function(event){
			    //var target_id=event.target.id;			    
				var reprofilingID=$('input[name=reprofilingID]:checked').val();				
				for(var i=0;i<reprofilingArray.length;i++){
					var html_str="";
					if(reprofilingArray[i]["reprofilingID"]==reprofilingID){
						save_index=i;												
						html_str+="<label>Axle Serial Number:</label><br><input type='text' class='form-control' id='axleSerialNumberUpdate' pattern='[0-9a-zA-Z\\-\\s]{2,}' title='Two or more characters {i.e Only Digits, Letters, Hyphens and Spaces allowed} for the Axle Serial Number' value='"+reprofilingArray[i]['axleSerialNumber']+"' autocomplete='on' required><p>";
						html_str+="<label>Initial Left Wheel Taperline Diameter (mm):</label><br><input type='number' id='initialLeftDiameter' class='form-control' min='500' max='2000' value='"+reprofilingArray[i]['initialLeftDiameter']+"' step='0.01' required><p>";
						html_str+="<label>final Left Wheel Taperline Diameter (mm):</label><br><input type='number' id='finalLeftDiameter' class='form-control' min='500' max='2000' value='"+reprofilingArray[i]['finalLeftDiameter']+"' step='0.01' required><p>";
						html_str+="<label>Initial Right Wheel Taperline Diameter (mm):</label><br><input type='number' id='initialRightDiameter' class='form-control' min='500' max='2000' value='"+reprofilingArray[i]['initialRightDiameter']+"' step='0.01' required><p>";						
						html_str+="<label>final Right Wheel Taperline Diameter (mm):</label><br><input type='number' id='finalRightDiameter' class='form-control' min='500' max='2000' value='"+reprofilingArray[i]['finalRightDiameter']+"' step='0.01' required><p>";
						html_str+="<label>Cost of Wheel Reprofiling Service (R):</label><br><input type='number' id='costOfService' class='form-control' min='0' max='1000000000' value='"+reprofilingArray[i]['costOfService']+"' step='0.01' required><p>";
						html_str+="<label>Date of Service:</label><br><input type='date' min='2010-01-01' max='2110-01-01' class='form-control' id='dateOfService' value='"+reprofilingArray[i]['dateOfService']+"'required><p>";
						html_str+="<input type='hidden' id='reprofilingID' value='"+reprofilingID+"'>";
						html_str+="<label>Service Provider Name:</label><br><input type='text' class='form-control' id='serviceProviderName' pattern='[0-9a-zA-Z\\-\\s]{2,}' title='Two or more characters {i.e Only Digits, Letters, Hyphens and Spaces allowed} for the Service Provider Name' value='"+reprofilingArray[i]['serviceProviderName']+"' autocomplete='on' required><p>";
						$("#populateForm").html(html_str);
						$("#populateForm").show();							
						html_str="<input type='submit' class='btn btn-primary' value='EDIT WHEEL REPROFILING DATA' id='editReprofiling'>";
						$("#buttonID").html(html_str);						
						$("#buttonID").show();
					}
				}				
		    });

            $("#reprofilingForm").on("submit",function(event){				
				if($("#reprofilingForm")[0].checkValidity()){						
					//initialise object literal.
					objData={};
					objData["axleSerialNumber"]=$("#axleSerialNumberUpdate").val();
					objData["initialLeftDiameter"]=$("#initialLeftDiameter").val();	
					objData["initialRightDiameter"]=$("#initialRightDiameter").val();
					objData["finalLeftDiameter"]=$("#finalLeftDiameter").val();	
					objData["finalRightDiameter"]=$("#finalRightDiameter").val();
					objData["costOfService"]=$("#costOfService").val();
					objData["dateOfService"]=$("#dateOfService").val();	
					objData["serviceProviderName"]=$("#serviceProviderName").val();
					objData["reprofilingID"]=$("#reprofilingID").val();	
					reprofilingArray[save_index]=objData;													
					json_data=JSON.stringify(objData);	
					//alert(json_data);					
					if($("#editReprofiling").length>0){
						$('#editReprofiling').val("UPDATING WHEEL REPROFILING DATA");
						$('#editReprofiling').prop('disabled', true);
						//we are assigning
						//assign number of axles
						$.ajax({
						type: "POST",
						contentType: "application/json",
						url: "/wheelreprofiling/update",	
						data:json_data,						
						dataType: 'json',
						cache: false,							
						success: function (data) { 
							$('#editReprofiling').val("EDIT WHEEL REPROFILING DATA");
							$('#editReprofiling').prop('disabled', false);							               							
							if(data["transactionStatus"]){
								alert("Successfully Updated Wheel Reprofiling Data!");								
								//location.reload();													
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
							$('#editReprofiling').val("EDIT WHEEL REPROFILING DATA");
							$('#editReprofiling').prop('disabled', false);	
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