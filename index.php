<?php
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
        $servername = "sql9.freesqldatabase.com";
        $username = "sql9610600";
        $password = "ZE1RGDLzSD";
        $dbname = "sql9610600";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * from games";
        $result = $conn->query($sql);
?>  

<html>
	<head>
        <?php echo '<link rel="stylesheet" type="text/css" href="css/main.css"></head>'; ?>
		<title>InfoGamer</title>
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
			<!--
			<nav class="topnav" id="myTopnav">
				<div style="display: flex; justify-content: space-between;">
					<img src="img/logo.png" width = "200px" style="padding: 0px 20px;"
						" alt="cool graphic" title="nice huh"/>
					<div class="links" style="padding: 20px 0px 0px 380px;">
						<a href="about_us_page.html" float="center" style="padding: 0px 60px 0px 0px;">About Us</a>
						<a href="cost.html">Cost</a>
					</div>
					<a href="javascript:void(0);" class="icon" onclick="myFunction()">
					<a><button onclick="document.getElementById('id01').style.display='block'" float="right" 
						style="width:auto; position: absolute; right: 0;">Login</button></a>
						<i class="fa fa-bars"></i></a>
				</div>
			</nav>
			-->
		<nav class="topnav" id="myTopnav" >
            <div style="display: flex; justify-content: space-between;">
                
                    <img src="img/ALlogo.png" width = "200px" style="padding: 5px 20px;" alt="Logo"/>
                <div class="links" style="padding: 20px 0px 0px 380px;" float="right">
                    <a href="index.html">Home</a>
                    <a href="about_us_page.html">About Us</a>
                    <a href="cost.html">Cost</a>
                </div>
                <a href="login.html"  float="right" 
                    style="width:100px; font-weight: 900; padding: 33.9px 0px 0px 0px">Login</a>
            </div>
		</nav>
			
		</header>

<input type="text" placeholder="Search Bar">


        <?php 
         if ($result->num_rows > 0) {
              echo "<table style='width:75%' class='center'>"; 
              echo "<tr class='spaceUnder'>"; 
              echo "<th style='width:20%'>Game Title</th>"; 
              echo "<th style='width:50%'>Game Info</th>"; 
              echo "<th style='width:10%'>Number of Players</th>"; 
              echo "<th style='width:20%'>Game Genre</th>"; 
              echo "</tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr class='spaceUnder'>";
                echo "<td>" . $row["Game_Name"] . "</td>";
                echo "<td>" . $row["Game_Info"] . "</td>";
                echo "<td>" . $row["Num_of_Players"] . "</td>";
                echo "<td>" . $row["Game_Genre"] . "</td>";
                echo "</tr>";
              }
              echo "</table>";
        }
        ?>

</body>
</html>