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
        <title>Generate Planning Report</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Generate Planning Report</h3>
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
            		           		
            		<label>Planning Report Start Date:</label>
    				<input type="date" id="startDate" class="form-control" value="" min="2010-01-01" max="2040-01-01" required>    				
    				<label>Planning Report End Date:</label>
    				<input type="date" id="endDate" class="form-control" value="" min="2010-01-01" max="2110-01-01" required><p>
    				<input type="submit" id="viewButton" class="btn btn-primary" value="GENERATE PLANNING REPORT">
            	</form></div><p>
            	
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
            
            $("#searchForm").on("submit",function(event){		
			    var startDate=$("#startDate").val();
			    var endDate=$("#endDate").val();		    
			    //alert("/axlecoachmappingservice/"+axleSerialNumber+"_"+startDate+"_"+endDate);
			    if($("#searchForm")[0].checkValidity()){
				    $("#viewButton").val("GENERATING MS-EXCEL REPORT...");
				    $("#viewButton").prop("disabled",true);
			    	$.ajax({
						type: "GET",
						contentType: "application/json",
						url: "/planningreportservice/"+startDate+"_"+endDate,							
						dataType: 'json',
						cache: false,							
						success: function (data) {
							$("#viewButton").val("GENERATE PLANNING REPORT");
						    $("#viewButton").prop("disabled",false);							
							if(data["transactionStatus"]){	
								alert("MS-EXCEL Planning Report successfully generated and emailed to relevant Stakeholders");									
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
								else if(data["errorAssocArray"]["errorCode"]=="0x14"){
									alert(data["errorAssocArray"]["errorDescription"]);
                                    window.location="manualalarms.php";
								}
								else if(data["errorAssocArray"]["errorCode"]=="0x13"){
									alert(data["errorAssocArray"]["errorDescription"]);
                                    window.location="distancesetting.php";
								}
								else if(data["errorAssocArray"]["errorCode"]=="0x12"){
									alert(data["errorAssocArray"]["errorDescription"]);
                                    window.location="wearsettings.php";
								}
						    	else{								    	
						    		alert("Transaction execution failed");	
						    	}	
							}
						},
						error: function (e) {
							$("#viewButton").val("GENERATE PLANNING REPORT");
						    $("#viewButton").prop("disabled",false);	
							alert("Error:transaction failed to execute with error "+e.responseText);
						}
			    	});	
			    }
			    else{			    	
			    	//$("#tableContents").hide();		
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