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

        $sql = "SELECT * from games";
        $result = $conn->query($sql);

        $sqlFav = "SELECT * from favorites WHERE User_ID=$identify";
        $favs = $conn->query($sqlFav);


?>  

<html>
<head>
    <title>InfoGamer</title>
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
          $favRow = $favs->fetch_assoc();
          $x = $favs->num_rows;
          echo "<form name='myform' class='myform' action='checkAltered.php' method='post'>";
         if ($result->num_rows > 0) {
              echo "<table id='gameTable' style='width:75%' class='center'>"; 
              echo "<tr class='spaceAbove'>"; 
              echo "<th style='width:20%'>Game Title</th>"; 
              echo "<th style='width:50%'>Game Info</th>"; 
              echo "<th style='width:20%'>Game Cost</th>"; 
              echo "<th style='width:10%'>Number of Players</th>"; 
              echo "<th style='width:20%'>Game Genre</th>"; 
              echo "<th style='width:40%'> Favorite </th>"; 
              echo "</tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr class='spaceUnder'>";
                echo "<td class='searchable'>" . $row["Game_Name"] . "</td>";
                echo "<td>" . $row["Game_Info"] . "</td>";
                echo "<td class='searchable'>" . $row["Game_Cost"] . "</td>";
                echo "<td class='searchable'>" . $row["Num_of_Players"] . "</td>";
                echo "<td class='searchable'>" . $row["Game_Genre"] . "</td>";
               
              if ($x == 0) {
                echo "<td><input type='checkbox' id=" . $row["Game_ID"] . " value=" . $row["Game_ID"] . " name='check_list[]' onclick='favoriteFunction()'><label for=" . $row["Game_ID"] . ">&#9829</label></td>";
              } else {
                if ($row["Game_ID"] == $favRow["Game_ID"]) {
                  echo "<td><input type='checkbox' id=" . $row["Game_ID"] . " value=" . $row["Game_ID"] . " name='check_list[]' onclick='favoriteFunction()' checked><label for=" . $row["Game_ID"] . ">&#9829</label></td>";
                  $x -= 1;
                  $faveRow = $favs->fetch_assoc();
                } else {
                  echo "<td><input type='checkbox' id=" . $row["Game_ID"] . " value=" . $row["Game_ID"] . " name='check_list[]' onclick='favoriteFunction()'><label for=" . $row["Game_ID"] . ">&#9829</label></td>";
                }
                
              }
               
                echo "</tr>";
              }
              echo "</table>";
              echo "</form>";
        }
		
        ?>

<script>
  function favoriteFunction() {
    document.myform.submit();
}
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
