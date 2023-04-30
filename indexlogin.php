<!-- A logged in home page where users can search the available games, favorite, and rate
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
  // getting cookie holding user id
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
        // used in the header
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
    <!-- the header with the logo and links to home, about us, cost, and profile dropdown -->
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
              // makes the dropdown drop on click
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
    <!-- page header and search bar -->
    <h1>Search Our Games</h1>
    <input type="text" id="getGame" onkeyup="searchFunction()" placeholder="Search">
    
    <!-- style for the favorites heart checkboxes -->
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

    <!-- printing the game data, favorites, and ratings buttons -->
    <?php 
      echo "<form name='myform' class='myform' action='checkAltered.php' method='post'>";
      if ($result->num_rows > 0) {
        echo "<table id='gameTable' style='width:90%' class='center'>"; 
        echo "<tr class='spaceAbove'>"; 
        echo "<th style='width:10%'>Title</th>"; 
        echo "<th style='width:1%'></th>"; //blank
        echo "<th style='width:20%'>Description</th>"; 
        echo "<th style='width:1%'></th>"; //blank
        echo "<th style='width:10%'>Cost</th>"; 
        echo "<th style='width:1%'></th>"; //blank
        echo "<th style='width:10%'>Number of Players</th>"; 
        echo "<th style='width:1%'></th>"; //blank
        echo "<th style='width:10%'>Genre</th>"; 
        echo "<th style='width:1%'></th>"; //blank
        echo "<th style='width:10%'>Rating</th>"; 
        echo "<th style='width:1%'></th>"; //blank
        echo "<th style='width:10%'>Favorite</th>"; 
        echo "<th style='width:1%'></th>"; //blank
        echo "<th style='width:10%'>Rate It</th>"; 
        echo "</tr>";
        while($row = $result->fetch_assoc()) {
          echo "<tr class='spaceUnder'>";
          echo "<td class='searchable'>" . $row["Game_Name"] . "</td>";
          echo "<td></td>"; 
          echo "<td>" . $row["Game_Info"] . "</td>";
          echo "<td></td>"; 
          echo "<td class='searchable'>" . $row["Game_Cost"] . "</td>";
          echo "<td></td>"; 
          echo "<td class='searchable'>" . $row["Num_of_Players"] . "</td>";
          echo "<td></td>"; 
          echo "<td class='searchable'>" . $row["Game_Genre"] . "</td>";
          echo "<td></td>"; 
          // printing the game rating or -/5 if there are no ratings yet
          if ($row["Game_Rating"] == 0) {
            echo "<td class='searchable'>-/5</td>";
          } else {
            echo "<td class='searchable'>" . $row["Game_Rating"] . "/5</td>";
          }
          echo "<td></td>"; 

          // determining which favorites hearts should be shown as red and which should be shown as white
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
          echo "<td></td>"; 
          // printing the rate this game buttons
          echo "</form>";
            echo "<form name='ratingform' class='ratingform' action='ratingPage.php' method='post'>";
            echo "<td><button id='myBtn' name='rdb' value=" . $row["Game_ID"] . " onclick='ratingFunction()'>Rate This Game</button></td>";
          echo "</form>";
          echo "</tr>";
        }
        echo "</table>";

      }
    ?>

    <script>
      // used to submit favorites on click
      function favoriteFunction() {
        document.myform.submit();
      }
    </script>

    <script>
      // used to open ratings page for a game on click
      function ratingFunction() {
        document.ratingform.submit();
      }
    </script>

    <!-- JS for the search functionality without refresh -->
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
