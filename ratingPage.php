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

  $gid = $_POST['rdb'];
    $getGame = "SELECT * from games WHERE Game_ID=$gid";
        $targetGame = $conn->query($getGame);
        if ($targetGame->num_rows == 1) {
            $row = $targetGame->fetch_assoc(); 
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

 <!----------------------------------------------------------------------------------------------------->
        <?php 
        echo "<h1>Rate " . $row["Game_Name"] . "</h1>";
        echo "<p><br><b>Description:</b> " . $row["Game_Info"] . "</br>";
        if ($row["Game_Rating"] == 0) {
            echo "<p><br><b>Overall Rating: </b>-/5</br>";
          } else {
            echo "<p><br><b>Overall Rating: </b> " . $row["Game_Rating"] . "/5</br>";
          }
        ?>

<!-----------need to cite------------------->

<style>
.rate {
    float: left;
    height: 60px;
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
    font-size:60px;
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

</style>


<form name='myform' class='myform' action='checkRatings.php' method='post'>
<div class="rate">
    <?php 
        echo "<input type='hidden' name='hiddenVal' value=" . $row["Game_ID"] . ">";
    ?>
    <input type="radio" id="star5" name="rate" value="5" onclick="ratingFunction()"/>
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" onclick="ratingFunction()"/>
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" onclick="ratingFunction()"/>
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" onclick="ratingFunction()"/>
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" onclick="ratingFunction()"/>
    <label for="star1" title="text">1 star</label>
  </div>
</form>

<script>
  function ratingFunction() {
    document.myform.submit();
}
</script>



</body>
</html>
