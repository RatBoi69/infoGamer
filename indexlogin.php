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
          echo "<form name='myform' class='myform' action='checkAltered.php' method='post'>";
         if ($result->num_rows > 0) {
              echo "<table id='gameTable' style='width:75%' class='center'>"; 
              echo "<tr class='spaceAbove'>"; 
              echo "<th style='width:20%'>Title</th>"; 
              echo "<th style='width:50%'>Description</th>"; 
              echo "<th style='width:20%'>Cost</th>"; 
              echo "<th style='width:10%'>Number of Players</th>"; 
              echo "<th style='width:20%'>Genre</th>"; 
              echo "<th style='width:20%'>Rating</th>"; 
              echo "<th style='width:40%'>Favorite</th>"; 
              echo "</tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr class='spaceUnder'>";
                echo "<td class='searchable'>" . $row["Game_Name"] . "</td>";
                echo "<td>" . $row["Game_Info"] . "</td>";
                echo "<td class='searchable'>" . $row["Game_Cost"] . "</td>";
                echo "<td class='searchable'>" . $row["Num_of_Players"] . "</td>";
                echo "<td class='searchable'>" . $row["Game_Genre"] . "</td>";
                echo "<td class='searchable'>" . $row["Game_Rating"] . "/5</td>";

              $x = 1;
              mysqli_data_seek($favs, 0);
              if ($favs->num_rows == 0) {
                $x = 1;
              }
              while($favRow = $favs->fetch_assoc()) {
                if ($row["Game_ID"] == $favRow["Game_ID"]) {
                  echo "<td><input type='checkbox' id=" . $row["Game_ID"] . " value=" . $row["Game_ID"] . " name='check_list[]' onclick='favoriteFunction()' checked><label for=" . $row["Game_ID"] . ">&#9829</label></td>";
                  $x = 0;
                }
                
              }
              if ($x == 1) {
                echo "<td><input type='checkbox' id=" . $row["Game_ID"] . " value=" . $row["Game_ID"] . " name='check_list[]' onclick='favoriteFunction()'><label for=" . $row["Game_ID"] . ">&#9829</label></td>";
              }

              

              
                             
                echo "</tr>";
                echo "<button id='myBtn'>Rate This Game</button>";
              }
              echo "</table>";
              echo "</form>";
        }
		
        ?>

<style>
/* Rating css devrived from https://codepen.io/hesguru/pen/BaybqXv */
  .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}



.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(25, 158, 207); /* Fallback color */
    background-color: rgba(25, 158, 207, 0.4); /* Black w/ opacity */
  }
  
  /* Modal Content */
  .modal-content {
    color: rgb(251, 235, 27);
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }
  
  /* The Close Button */
  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }



</style>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Rate This Game</p>
    <div class="rate">
    <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>
  </div>

</div>



<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>



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
