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
  } else {
    $identify = $_COOKIE[$cookie_name];
  }

  $sqlRate = "SELECT * from ratings WHERE User_ID=$identify";
  $rates = $conn->query($sqlRate);
?>  

<html>
<head>
    <title>Rate Games</title>
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
        		<a href="favorites.php"><b>Favorites</b></a>
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

<input type="text" id="getGame" onkeyup="searchFunction()" placeholder="Search Bar">


<style>
/* hides the checkbox */
input {
  display: none;
}
input ~ label {
  color: white;
}
/* changes the color when selected */
input:checked ~ label {
  color: red;
}
/* for styling purpose only */
label {
  font-size: 2em;
}
</style>
        <?php 

        //handle form data, based on the value of the button press
        $rdb_value = $_POST['rdb'];
		echo $rdb_value;
        ?>

<script>
  function favoriteFunction() {
    document.myform.submit();
}


<form name='myform' class='myform' action='checkRatings.php' method='post'>
</form>



</script>

		<script>
		function searchFunction() {
			// Declare starting variables
			var input = document.getElementById("getGame");
			var filter = input.value.toUpperCase();
			var table = document.getElementById("gameTable");
			var trs = table.tBodies[0].getElementsByClassName("spaceUnder");
			// Loop through rows
			for (var i = 0; i < trs.length; i++) {
				// Define the cells
				var tds = trs[i].getElementsByClassName("searchable");
				// hide the row
				trs[i].style.display = "none";
				// loop through row cells
				for (var i2 = 0; i2 < tds.length; i2++) {
					// if there's a match
					if (tds[i2].innerHTML.toUpperCase().indexOf(filter) > -1) {
						// show the row
						trs[i].style.display = "";
						// skip to the next row
						continue;
					}
				}
			}
		}
		</script>

</body>
</html>
