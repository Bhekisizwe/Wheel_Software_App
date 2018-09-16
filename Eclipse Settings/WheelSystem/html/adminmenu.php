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
        <title>Administrator Menu</title>
        </head>
        <body style="background-color:#ccccff">
        <div class="containter-fluid" align="center">
        <h3 class="h3">Administrator Menu</h3>
            	<i><div style="font-family:arial;font-size:14pt">Logged in as:<b><?php echo $_SESSION["name"]." ".$_SESSION["surname"]; ?></b></div></i><p>
            	[<a href='logout.php' class='active'><b>Logout</b></a>]<p>
            <div style="width:20%">            	
            	<div id="tree" align="left">
            		 <ul>
                      	<li>Manage User Access Control
                      		<ul>
                      			<li>User Roles Management
                      				<ul>
                      					<li>Create User Role</li>
                      					<li>Edit User Role Access Rights</li>
                      				</ul>                      			
                      			</li>
                      			<li>User Accounts Management
                      				<ul>
                      					<li>Create User Account</li>
                      					<li>Edit User Account</li>
                      				</ul> 
                      			</li>                      		
                      		</ul>                      	
                      	</li>                        
                      	<li>Manage System Settings
                      		<ul>
                      			<li>Asset Register Management
                      				<ul>
                      					<li>Add Asset to System</li>
                      					<li>Import Asset Register</li>
                      					<li>Edit Asset in System</li>
                      				</ul> 
                      			</li>
                      			<li>Number of Axles Per Coach Management</li>  
                      			<li>Axle Serial Number-Coach Mapping Management
                      				<ul>
                      					<li>Add Axle Serial Number-Coach Mapping</li>
                      					<li>Import Axle Serial Number-Coach Mapping</li>
                      					<li>Edit Axle Serial Number-Coach Mapping</li>
                      				</ul> 
                      			</li>
                      			<li>MiniProf Wheel Measurements Alarm Settings Management</li>  
                      			<li>Manual Wheel Measurements Alarm Settings Management</li>
                      			<li>Wheel Wear Rate Settings Management</li>  
                      			<li>Daily Distance Travelled Setting Management</li>                   		
                      		</ul>                      	
                      	</li>                     
                          <li>Manage Wheel Measurements
                          	<ul>
                          		<li>MiniProf Wheel Measurements Management
                          			<ul>                      					
                      					<li>Import MiniProf Wheel Measurements</li>
                      					<li>View Wheel Measurements</li>
                      				</ul>                          		
                          		</li>
                      			<li>Manual Wheel Measurements Management</li>                    			
                      			<li>Wheel Measurements Alarm Event Management</li>  
                          	</ul>                	
                          </li>                    
                      	<li>Login Password Management</li>
                      	<li>Wheel Measurements Planning Report Management</li>
                      	<li>Wheel Reprofiling Data Management
                  			<ul>
              					<li>Add Wheel Reprofiling Data</li>              					
              					<li>Edit Wheel Reprofiling Data</li>
              				</ul> 
                      	</li>
                      	<li>System Activity Logs Management</li>
                      	
                      </ul>         	
            	</div>            	   		
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
        	
			$("#tree").jstree();		
		
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