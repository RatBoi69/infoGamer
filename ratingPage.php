<?php
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
    $servername = "sql.freedb.tech";
    $username = "freedb_cse201";
    $password = "?NHU8n?7FWyYUPK";
    $dbname = "freedb_cse201";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $cookie_name = "ArcadeLegacyUID";
    if(!isset($_COOKIE[$cookie_name])) {
        header('Location: login.php');
        $conn->close();
    }
    $identify = $_COOKIE[$cookie_name];
?>

<html>
<head>
    <title>Rate A Game</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <style>
        /* Style the dropdown button */
        .dropdown {
  position: relative;
  display: inline-block;
}

/* Style the dropdown content */
.dropdown-content {
  display: none;
  position: absolute;
  z-index: 1;
  background-color: #f1f1f1;
  margin-top: 5px;
  margin-left: -120;
}

/* Style the links in the dropdown menu */
.dropdown-content a {
  display: block;
  padding: 12px 16px;
  text-decoration: none;
  color: white;
}

/* Style the links in the dropdown menu when hovering over them */
.dropdown-content a:hover {
  background-color: #00DBFF;
}
    </style>

    <script>
function myFunction() {
var x = document.getElementById("myTopnav");
if (x.className === "topnav") {
x.className += " responsive";
} else {
x.className = "topnav";
}
}
</script>


</head>
<body>

    <header>
		<nav class="topnav" id="myTopnav" >
            <div style="display: flex; justify-content: space-between;">
                
                    <img src="img/ALlogo.png" width = "200px" style="padding: 5px 20px;" alt="Logo"/>
                <div class="links" style="padding: 20px 0px 0px 380px;" float="right">
                    <a href="indexlogin.php">Home</a>
                    <a href="about_us_page_logged_In.html">About Us</a>
                    <a href="costLogin.html">Cost</a>
                </div>

		<!-- Create the clickable image -->
  		<div class="dropdown">
    		<img src="circle-user-solid.svg" width = "50px" style="padding: 15px 20px; position: relative; top: 0px; left: -120px;" alt="User Image" onclick="toggleDropdown()">
    		<!-- Create the dropdown menu -->
    		<div class="dropdown-content" id="dropdown">
      	<div>
        	<a href="account.php"><b>Profile</b></a>
      	</div>
      	<div>
        		<a href="https://www.website2.com"><b>Favorites</b></a>
      	</div>
		    <div>
		      	<a href="index.php"><b>Log Out</b></a>
		    </div>

		  <script>
			function toggleDropdown() {
			  var dropdown = document.getElementById("dropdown");
			  if (dropdown.style.display === "block") {
				dropdown.style.display = "none";
			  } else {
				dropdown.style.display = "block";
			  }
			}
		  </script>
    </div>
  </div>
		</nav>
			
		</header>

        </body>
        </html>