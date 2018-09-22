<?php
use UserClasses\BusinessLayer\ManageSession;

session_start();
require __DIR__."\\..\\vendor\autoload.php";
$manageSession=new ManageSession();
if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
if(isset($_SESSION["staffNumber"]) && $_SESSION["userRoleName"]=="Admin"){
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
        <title>Create User Role</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        	<h3 class="h3">Create User Role</h3>
            	<i><div style="font-family:arial;font-size:14pt">Logged in as:<b><?php echo $_SESSION["name"]." ".$_SESSION["surname"]; ?></b></div></i><p>
            	[<a href='logout.php' class='active'><b>Logout</b></a>]
            	[<a href='adminmenu.php' class='active'><b>Back to Administrator Menu</b></a>]<p>
            
            	<div class="form-group">
    			<form style="border:1px solid #888888;width:40%;background-color:#eeeeee" class="rounded" id="roleForm">
    				 				
    				<input type="text" class="form-control" placeholder="Enter role name {e.g Artisan, Technician, e.t.c}" id="roleName" pattern="[a-zA-Z\-\s]{2,}" title="Two or more {i.e Only Letters, Space and Hyphens allowed} characters necessary for the Role Name" autocomplete="off" required><p>
		    		<p>	
		    		<label><b>Access Rights</b></label>	    		
		    		<div id="populateForm"></div>  
		    		<div id="columnVisibility"></div>  		
		    		<input type="submit" id="addRole" class="btn btn-primary" value="CREATE USER ROLE"><p>	
		    		
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
            var j;
            var generated_id; 
            var columnArray;
            var rightsArray;                                                            
            //$holder_add=$("#addLicense").detach();
            //$holder_edit=$("#editLicense").detach();
            url="/userrole";            
        	var jqxhr=$.getJSON(    
		    url,    			    
		    function(data,status){    			    	
		    	//alert(data["staffNumber"]);    			        
		    }).done(function(data){		    
		    	//successfully executed transaction	
		    	var html_str="<table style='width:100%'><th align='center'>Activity Name</th><th align='center'>Create</th><th align='center'>Read</th><th align='center'>Update</th><th align='center'>Delete</th>";
		    	for(var i=0;i<data['activityRights2DArray'].length;i++){
			    	if(data['activityRights2DArray'][i]['activityName']!="Planning Report Management"){			    				    	
    		    		html_str+="<tr><td align='left'>"+data['activityRights2DArray'][i]['activityName']+"<input type='hidden' id='activityName"+i+"' value='"+data['activityRights2DArray'][i]['activityID']+"'></td>";
    		    		html_str+="<td align='center'><input type='checkbox' id='activityName"+i+"Create' value='C'></td>";
    		    		html_str+="<td align='center'><input type='checkbox' id='activityName"+i+"Read' value='R' checked></td>";
    		    		html_str+="<td align='center'><input type='checkbox' id='activityName"+i+"Update' value='U'></td>";
    		    		html_str+="<td align='center'><input type='checkbox' id='activityName"+i+"Delete' value='D'></td></tr>";	
    		    		//alert(html_str);
		    		}
			    	else{
				    	j=i;
				    	generated_id="activityName"+j+"Read";				    	
			    	}
		    	}
		    	html_str+="<tr><td align='left'>"+data['activityRights2DArray'][j]['activityName']+"<input type='hidden' id='activityName"+j+"' value='"+data['activityRights2DArray'][j]['activityID']+"'></td>";
	    		html_str+="<td align='center'><input type='checkbox' id='activityName"+j+"Create' value='C'></td>";
	    		html_str+="<td align='center'><input type='checkbox' id='activityName"+j+"Read' value='R'></td>";
	    		html_str+="<td align='center'><input type='checkbox' id='activityName"+j+"Update' value='U'></td>";
	    		html_str+="<td align='center'><input type='checkbox' id='activityName"+j+"Delete' value='D'></td></tr>";	
		    	html_str+="</table><p>";
		    	$("#populateForm").append(html_str);		    	
		    	columnArray=data["columnVisibility2DArray"];
		    	rightsArray=data["activityRights2DArray"];
		    	var html_str="<table style='width:100%'><th align='center'>Planning Report Column Name</th><th align='center'>Visible</th><th align='center'>Invisible</th>";
		    	for(var i=0;i<columnArray.length;i++){        			    		    				    	
		    		html_str+="<tr><td align='left'>"+columnArray[i]['columnName']+"<input type='hidden' id='columnName"+i+"' value='"+columnArray[i]['columnID']+"'></td>";
		    		html_str+="<td align='center'><input type='radio' id='columnName"+i+"Visible' name='columnName"+i+"Visible' value='1'></td>";
		    		html_str+="<td align='center'><input type='radio' id='columnName"+i+"Visible' name='columnName"+i+"Visible' value='0' checked></td></tr>";        		
		    		//alert(html_str);        		    		
		    	}
		    	html_str+="</table><p>";        		    	       		    	
		    	$("#columnVisibility").html(html_str); 
		    	$("#columnVisibility").hide();	    	  			    	    			    	
		    }).fail(function(data){
		    	alert("Error:transaction failed");    			    	
		    });	

		    $(document).on("change","[type='checkbox']",function(event){
			    var target_id=event.target.id;
			    if(target_id==generated_id){
					//check if it is checked. If yes, then pull column names and show it
					if($("#"+target_id+":checked").length>0){
						//show the column data					       		    	       		    	
        		    	$("#columnVisibility").show();        		    	
					}
					else{
						//else hide the column data
						$("#columnVisibility").hide();
					}					
			    }
		    });
		    
			$("#roleForm").on("submit",function(event){													
				var n = $("input:checked").length;
				if(n>0){
					if($("#roleForm")[0].checkValidity()){						
						//initialise object literal.
						objData={"activityRights2DArray":{},
								"columnVisibility2DArray":{},
								"userRole2DArray":{}};
						
						var userRoleName=$("#roleName").val();
						objData["userRole2DArray"]={"0":{"userRoleName":userRoleName}};
						//Populate Object Literal Access Rights Array
						buildObjLiteral={};
						counter=0;
						for(var k=0;k<rightsArray.length;k++){							
							accessRightsCombined="";
							if($("#activityName"+k+"Create:checked").length>0){
								accessRightsCombined+="C ";	
							}
							if($("#activityName"+k+"Read:checked").length>0){
								accessRightsCombined+="R ";	
							}
							if($("#activityName"+k+"Update:checked").length>0){
								accessRightsCombined+="U ";	
							}
							if($("#activityName"+k+"Delete:checked").length>0){
								accessRightsCombined+="D";	
							}
							str=accessRightsCombined.trim();
							//if(str.length>0){    							
								buildObjLiteral[""+counter+""]={'activityID':$('#activityName'+k).val(),'activityRights':str};    							
								counter++;
							//}
						}
						objData["activityRights2DArray"]=buildObjLiteral;
						//Populate Object Literal Column Visibility Array						
						if($("#"+generated_id+":checked").length>0){
							//then we know that Planning report Read checkbox is ticked
							buildObjLiteral={};
    						for(var n=0;n<columnArray.length;n++){        						   							
    							buildObjLiteral[""+n+""]={'columnID':$('#columnName'+n).val(),'columnVisibility':$('input[name=columnName'+n+'Visible]:checked').val()};
    						}
    						objData["columnVisibility2DArray"]=buildObjLiteral;		
						}
						else{
							buildObjLiteral={};
    						for(var n=0;n<columnArray.length;n++){        						   							
    							buildObjLiteral[""+n+""]={'columnID':$('#columnName'+n).val(),'columnVisibility':0};
    						}
    						objData["columnVisibility2DArray"]=buildObjLiteral;	
						}
																							
						json_data=JSON.stringify(objData);	
						//alert(json_data);					
						if($("#addRole").length>0){
							$('#addRole').val("CREATING USER ROLE");
							$('#addRole').prop('disabled', true);
							//we are adding
							//add admin account
							$.ajax({
								type: "GET",
								contentType: "application/json",
								url: "/userrole/checkexistence/"+userRoleName,							
								dataType: 'json',
								cache: false,							
								success: function (data) {								
									if(data["transactionStatus"]){
										$('#addRole').prop('disabled', false);
										if(data["dataExistsStatus"]){
											//then we know that there is a duplicate Staff Number
											$('#addRole').val("CREATE USER ROLE");
											alert("The role name entered already exists in the system,\n please try another one.");
										}
										else{
											//create the account
											$.ajax({
	                						type: "POST",
	                						contentType: "application/json",
	                						url: "/userrole/add",	
	                						data:json_data,						
	                						dataType: 'json',
	                						cache: false,							
	                						success: function (data) {
	                							$('#addRole').val("CREATE USER ROLE");
												if(data["transactionStatus"]){
													alert("User Role Successfully Created!");													
												}
												else{												
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
	                					    	$('#addRole').val("CREATE USER ROLE");
	    										$('#addRole').prop('disabled', false);
	                							alert("transaction failed to execute with error "+e);
	                						}
										  });
										}								    								    	
								    }
								    else{
								    	$('#addRole').val("CREATE USER ROLE");
										$('#addRole').prop('disabled', false);
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
									$('#addRole').val("CREATE USER ROLE");
									$('#addRole').prop('disabled', false);
									alert("transaction failed to execute with error"+e);
								}
							});		
						}				
						
					}			
				}
				else alert("Please assign at least one access right to this user role");				
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