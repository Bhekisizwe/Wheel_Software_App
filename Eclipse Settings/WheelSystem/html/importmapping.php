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
        <title>Import Axle Serial Number-Coach Mapping</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Import Axle Serial Number-Coach Mapping</h3>
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
            	<form style="border:1px solid #888888;width:30%;background-color:#eeeeee" class="rounded" id="importForm">
            		<input type="file" id="axleMapping" name="axlemapping" class="form-control" required>
    				<input type="submit" id="uploadButton" class="btn btn-primary" value="UPLOAD AXLE-COACH MAPPING"><p>
            	</form></div><p>            	
            </div>
       
         <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="dist/jstree.min.js"></script>
        <!-- <script src="js/bootstrap-treeview.js"></script> -->       
        <script>
        $(document).ready(function () {

            $("#importForm").submit(function (event) {

                //stop submit the form, we will post it manually.
                event.preventDefault();

                // Get form
                var form = $('#importForm')[0];

        		// Create an FormData object 
                var data = new FormData(form);

        		// If you want to add an extra field for the FormData
                //data.append("CustomField", "This is some extra data, testing");

        		// disabled the submit button
        		if($('#importForm')[0].checkValidity()){
        			$("#uploadButton").val("UPLOADING AXLE-COACH MAPPING");
                    $("#uploadButton").prop("disabled", true);

                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "/axlecoachmappingservice/import/",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {
                        	$("#uploadButton").val("UPLOAD AXLE-COACH MAPPING");
                            $("#uploadButton").prop("disabled", false);
                           	if(data["transactionStatus"]){
								alert("Successfully Imported the Axle-Coach Mapping!");
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
								else if(data["errorAssocArray"]["errorCode"]=="0x05"){
									alert(data["errorAssocArray"]["errorDescription"]);
								}
								else if(data["errorAssocArray"]["errorCode"]=="0x11"){
									alert(data["errorAssocArray"]["errorDescription"]);
								}
								else if(data["errorAssocArray"]["errorCode"]=="0x09"){
									alert(data["errorAssocArray"]["errorDescription"]);
								}
								else if(data["errorAssocArray"]["errorCode"]=="0x03"){
									alert(data["errorAssocArray"]["errorDescription"]);
								}
						    	else{								    	
						    		alert("Transaction execution failed");	
						    	}
                           	}
                        },
                        error: function (e) {
                        	$("#uploadButton").val("UPLOAD AXLE-COACH MAPPING");
                            $("#uploadButton").prop("disabled", false);
                           	alert("Transaction failed with error: "+e.responseText);                            
                        }
                    });
        		}        		
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