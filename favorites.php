<!-- A PHP file to display to users their favorite games along with other similar games
     Copyright: 2023
-->

<?php
	// displaying any errors
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
	// database information
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
	// getting user ID from cookie
	$cookie_name = "ArcadeLegacyUID";
	if(!isset($_COOKIE[$cookie_name])) {
		header('Location: login.php');
		$conn->close();
	} else {
		$identify = $_COOKIE[$cookie_name];
	}
	// getting game data
	$sql = "SELECT * from games";
	$result = $conn->query($sql);
	// getting game data to use in a different place
	$sqlDbl = "SELECT * from games";
	$Dbl = $conn->query($sqlDbl);
	// getting the users favorites
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
					<img src="img/circle-user-solid.svg" width = "50px" style="padding: 15px 20px; position: relative; top: 0px; left: -120px;" alt="User Image" onclick="toggleDropdown()">
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

		<!-- style for heart shaped favorites checkboxes -->
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
			td {
			font-size: 30px;
			}
		</style>

		<?php 
			// displaying to users their favorite games and they=n the next three games not in their favorites but in the same category

			$data = array();

			$genreData = array();
			$idData = array();
			$nameData = array();
			while($newFavRow = $favs->fetch_assoc()) {
				$data[] = $newFavRow['Game_ID'];
			}
			while($checkRow = $Dbl->fetch_assoc()) {
				$genreData[] = $checkRow['Game_Genre'];
				$idData[] = $checkRow['Game_ID'];
				$nameData[] = $checkRow['Game_Name'];
			}

			echo "<h1>Your Favorites</h1>";
			echo "<form name='myform' class='myform' action='checkAlteredFavoritePage.php' method='post'>";
			while($row = $result->fetch_assoc()) {
				mysqli_data_seek($favs, 0);
				while($favRow = $favs->fetch_assoc()) {
					echo "<table id='gameTable' style='width:30%' class='center'>"; 
					echo "<tr>";
					if ($row["Game_ID"] == $favRow["Game_ID"]) {
						echo "<td>" . $row["Game_Name"] . "</td>";

						//make favorite - this doesn't work

						echo "<td><input type='checkbox' id=" . $row["Game_ID"] . " value=" . $row["Game_ID"] . " 
						name='check_list[]' onclick='favoriteFunction()' checked><label for=" . $row["Game_ID"] . ">
						&#9829</label></td>";
						$x = 0;

						if ($x == 1) {
							echo "<td><input type='checkbox' id=" . $row["Game_ID"] . " value=" . $row["Game_ID"] . "
							name='check_list[]' onclick='favoriteFunction()'><label for=" . $row["Game_ID"] . ">
							&#9829</label></td>";
						}
						//

						echo "<tr class='spaceBelow'>"; 
						echo "<td style='font-size: 20px; padding: 0px 20px 0px 20px;'><u>More Like This</u></td>";
						//make tables
						// search table for row[gamegenre]
						//display top 3
						$i = 0;


						for ($n = 0; $n < count($idData); $n++) {
							if ($i < 3) {
								if ($row["Game_Genre"] == $genreData[$n] and !(in_array($idData[$n], $data))) {
									echo "<tr><td style='font-size: 20px; padding: 0px 20px 0px 20px;'>" . $nameData[$n] . "</td>";

									//make favorite - this doesn't work

									$j = 1;

									if ($j == 1) {
										echo "<td style='font-size: 20px; padding: 0px 20px 0px 20px;'><input type='checkbox' id=" . $idData[$n] . " value=" . $idData[$n] . "
										name='check_list[]' onclick='favoriteFunction()'><label for=" . $idData[$n] . ">
										&#9829</label></td>";
									}
									//
									echo "</tr>";
									$i++;
								}
							}
						}
						echo "</tr>";
					}
					echo "</tr>";
					echo "</table>";
				}
			}
			echo "</form>";
		?>

		<script>
			function favoriteFunction() {
				document.myform.submit();
			}
		</script>

		<!-- JS for the search functionality without refresh
		<script>
			function searchFunction(String s) {
			// Declare starting variables
			var input = document.getElementById("getGame");
			var filter = input.value.toUpperCase();
			var table = document.getElementById("gameTable");
			var trs = table.tBodies[0].getElementsByClassName("spaceUnder");
			// Loop through rows
			for (var i = 0; i < trs.length; i++) {
			// Define the cells
			var tds = trs[i].getElementsByClassName(s);
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
			 -->
	</body>
</html>
