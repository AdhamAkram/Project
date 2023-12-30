<?php
session_start();
$servername = "localhost:3307";
$matchname = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $matchname, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$table_name="matches";
$_SESSION['table_name'] = $table_name;
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the selected option from the form
  $selectedOption = isset($_POST['myDropdown']) ? $_POST['myDropdown'] : "";

  // Store the selected option in the session
  $_SESSION['selectedOption'] = $selectedOption;
}

// Retrieve match data from the database
$sql = "SELECT matches.match_id, teams1.team_name AS team1_name, teams2.team_name AS team2_name
        FROM $table_name AS matches
        JOIN team AS teams1 ON matches.team1_id = teams1.team_id
        JOIN team AS teams2 ON matches.team2_id = teams2.team_id";

$result = $conn->query($sql);

// Check if the selected option is stored in the session
if (isset($_SESSION['selectedOption'])) {
  // Access the selected option from the session
  $selectedOption = $_SESSION['selectedOption'];
} else {
  // Default value if no option is selected
  $selectedOption = "None";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Matches</title>
    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.3/examples/headers/"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@docsearch/css@3"
    />

    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="matches-page.css" />
    


</head>
<body>
  
<div class="px-3 py-2 text-bg-dark border-bottom">
      <div class="container">
        <div
          class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"
        >
          <a
            href="/"
            class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none"
          >
            <svg
              class="bi me-2"
              width="40"
              height="32"
              role="img"
              aria-label="Bootstrap"
            >
              <use xlink:href="#bootstrap" />
            </svg>
          </a>
      
          <ul
            class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small"
          >
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1 color-black" width="24" height="24" >
                  <use xlink:href="#home" />
                </svg>
                Home
              </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                  <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                    <use xlink:href="#profile" />
                  </svg>
                  My Profile
                </a>
              </li>
              <li>
                  <a href="#" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                      <use xlink:href="#signout" />
                    </svg>
                    Sign Out
                  </a>
                </li>
      
          </ul>
        </div>
        </div>
      </div>

      <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
            <img class="rounded-circle" src="https://media.istockphoto.com/id/1288538088/photo/portrait-young-confident-smart-asian-businessman-look-at-camera-and-smile.jpg?s=2048x2048&w=is&k=20&c=J-PEzTmJkg-2ngh-oKmIucEuzMX4l7C7lH2JG6U5NZw=">
            <div class="info">
                <div class="welcome">Welcome</div>
                <div class="name">أدهم سامي</div>
                <div class="fan-id">
                    <span class="text-grey-light">Tazkarti ID</span>
                    <span class="id-num">102011900989962</span>
                </div>
                <div class="fan-id vaccin-info"></div>
            </div>
            <ul class="navbar-nav col-lg-6 justify-content-lg-center">
                <ul
                class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small"
              >
                <li class="nav-icon">
                  <a href="#" class="nav-link text-black">
                    <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                        <use xlink:href="#football" />
                      </svg>                    Matches
                  </a>
                </li>
                <li class="nav-icon">
                    <a href="#" class="nav-link text-dark">
                      <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                        <use xlink:href="#event" />
                      </svg>
                      Events
                    </a>
                  
                      <li class="nav-icon">
                        <a href="#" class="nav-link text-black">
                          <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                              <use xlink:href="#ticket" />
                            </svg>
                            My Tickets
                        </a>
                      </li>
                    </a>
                  
                    <li class="nav-icon">
                      <a href="#" class="nav-link text-black">
                        <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                            <use xlink:href="#match" />
                          </svg>
                         match
                      </a>
                    </li>
                    <li class="nav-icon">
                        <a href="#" class="nav-link text-black">
                          <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                              <use xlink:href="#tournament" />
                            </svg>
                            tournament
                        </a>
                      </li>
                      <li class="nav-icon">
                        <a href="#" class="nav-link text-black">
                          <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                              <use xlink:href="#team" />
                            </svg>
                            team
                        </a>
                      </li>
              </ul>
              
              
              </li>
            </ul>
           
          </div>
        </div>
    </nav>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="bootstrap" viewBox="0 0 118 94">
          <title>Bootstrap</title>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
        </symbol>
        <symbol id="home" viewBox="0 0 16 16">
          <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
        </symbol>
        <symbol id="profile" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
        </symbol>
        <symbol id="signout" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
        </symbol>
        <symbol id="football" height="30" width="30" viewBox="0 0 512 512">
            <path d="M417.3 360.1l-71.6-4.8c-5.2-.3-10.3 1.1-14.5 4.2s-7.2 7.4-8.4 12.5l-17.6 69.6C289.5 445.8 273 448 256 448s-33.5-2.2-49.2-6.4L189.2 372c-1.3-5-4.3-9.4-8.4-12.5s-9.3-4.5-14.5-4.2l-71.6 4.8c-17.6-27.2-28.5-59.2-30.4-93.6L125 228.3c4.4-2.8 7.6-7 9.2-11.9s1.4-10.2-.5-15l-26.7-66.6C128 109.2 155.3 89 186.7 76.9l55.2 46c4 3.3 9 5.1 14.1 5.1s10.2-1.8 14.1-5.1l55.2-46c31.3 12.1 58.7 32.3 79.6 57.9l-26.7 66.6c-1.9 4.8-2.1 10.1-.5 15s4.9 9.1 9.2 11.9l60.7 38.2c-1.9 34.4-12.8 66.4-30.4 93.6zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm14.1-325.7c-8.4-6.1-19.8-6.1-28.2 0L194 221c-8.4 6.1-11.9 16.9-8.7 26.8l18.3 56.3c3.2 9.9 12.4 16.6 22.8 16.6h59.2c10.4 0 19.6-6.7 22.8-16.6l18.3-56.3c3.2-9.9-.3-20.7-8.7-26.8l-47.9-34.8z"/>
        </symbol>
        <symbol id="event" height="30" width="30" viewBox=" 0 0 16 16">
            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
        </symbol>  
        <symbol id="ticket" height="30" width="30" viewBox=" 0 0 16 16">
            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4 1a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5m0 5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5M4 8a1 1 0 0 0 1 1h6a1 1 0 1 0 0-2H5a1 1 0 0 0-1 1"/>
        </symbol>  
        <symbol id="match" height="30" width="30" viewBox=" 0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
        </symbol> 
        <symbol id="tournament" height="30" width="30" viewBox=" 0 0 16 16">
            <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935"/>
        </symbol>  
        <symbol id="team" height="30" width="30" viewBox=" 0 0 16 16">
            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
        </symbol> 
         
    </svg>
    <div class="container">
    
    <?php
// Check if the form is submitted

?>
<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div>
  <div class="d-flex justify-content-end">
<button class="button button-black width-auto  book-ticket-btn" style="margin : 1px; margin-top: 1%;"  id="addNewmatchButton" type="submit"  name="add">Add new match</button></div>
        <h5 style="font-weight : bold; margin: 1%;" for="myDropdown">Select Match </h5>
        <div>
        <select id="myDropdown" name="myDropdown" class="form-control" onchange="this.form.submit()">
        <option value="">Select a match</option>
        <?php
            // Populate the dropdown with match data
            while ($row = $result->fetch_assoc()) {
                $match_id = $row['match_id'];
                $team1 = $row['team1_name'];
                $team2 = $row['team2_name'];
                echo "<option value='$match_id' " . ($selectedOption == "$match_id" ? 'selected' : '') . ">$match_id - $team1 vs $team2</option>";
            }
            ?>
        </select>
    </form>

  <?php
   
  $sqlColumns = "SHOW COLUMNS FROM $table_name";
  $resultColumns = $conn->query($sqlColumns);
  
  // Fetch data for match with id = 1
  $sqlData = "SELECT * FROM $table_name WHERE match_id LIKE '%$selectedOption%'";
  $resultData = $conn->query($sqlData);
  
  if ($resultData->num_rows > 0) {
      $rowData = $resultData->fetch_assoc();
  if ($selectedOption!="") {
      // Display column names and corresponding data in spans
      while ($rowColumn = $resultColumns->fetch_assoc()) {
          $columnName = $rowColumn['Field'];
          $columnData = $rowData[$columnName];
  
          // Generate unique IDs for each input field
          $inputId = 'input_' . $columnName;
    if ($columnName!= 'match_id') {
    // Echo the column name in a span
    echo '<span style="font-weight : bold;">' . $columnName . '</span>';

    // Echo the input field with a unique ID and disabled text
    echo '<form method="post" action=""> 
    <input class="form-control" id="' . $inputId . '" type="text" placeholder="' . $columnData . '" value="' . $columnData . '"  name="' . $columnName . '_id" readonly>';
      
    }
      }
      echo '
      <form method="post" action="">
      <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex justify-content-end">
      <input type="hidden" name="match_id" value='.$selectedOption.'>
      
      <button class="button button-black width-auto  book-ticket-btn" style="margin : 1px;"  type="submit" name="delete">Delete</button>
        <button class="button button-black width-auto book-ticket-btn editAllButton" style="margin : 1px;"  type="button" name="edit">Edit</button>
        <button class="button button-black width-auto book-ticket-btn" style="margin : 1px;"  type="submit" name="save" >Confirm Edit </button>
      </div>
      </div>
      </form>
';
  } 
}
  
  ?>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Assuming you have a form with buttons named "edit" and "delete"
    
if (isset($_POST['save'])) {
  $matchIdToEdit= $_POST['match_id'];
  $team1 = ($_POST['team1_id_id']);
  $team2 = ($_POST['team2_id_id']);
  $matchDate = ($_POST['match_date_id']) ;
  $matchTime = ($_POST['match_time_id']) ;
  $week=($_POST['week_id']) ;
  $stage=($_POST['stage_id']) ;
  $tournament=($_POST['tournament_id_id']) ;
  $stadium=($_POST['stadium_id_id']) ;
// Update the match data in the database
$sqlUpdate = "UPDATE $table_name 
              SET team1_id='$team1', team2_id='$team2', match_date='$matchDate', 
                  match_time='$matchTime', week='$week', stage='$stage', 
                  tournament_id='$tournament', stadium_id='$stadium' 
              WHERE match_id='$matchIdToEdit'";
  $resultUpdate = $conn->query($sqlUpdate);

  if ($resultUpdate) {
      // Update successful
      echo '<script>alert("match UPDATED successfully!");</script>';
      echo '<script>window.location.href = "admin-match.php";</script>';
  } else {
      // Update failed
      echo "Error updating match: " . $conn->error;
  }
} 
        
    elseif (isset($_POST['delete']) ) {
        // Handle the delete action
         $matchIdToDelete = $_POST['match_id'];  // Assuming you have an input with the name "match_id"
        
         $matchnameId = ($_POST['matchname_id']);

          $sqlDelete = "DELETE FROM $table_name WHERE match_id = '$matchIdToDelete'";
          $resultDelete = $conn->query($sqlDelete);
        
          if ($resultDelete) {
              // Deletion successful
              echo '<script>alert("match DELETED successfully!");</script>';
              echo '<script>window.location.href = "admin-match.php";</script>';
              // Redirect or perform other actions...
          } else {
              // Deletion failed
            echo "Error deleting match: " . $conn->error;
          }
     }
     if (isset($_POST['add'])) {
      echo '<script>window.location.href = "admin-add-match.php";</script>';
  } 
    }
 
$conn->close();
?>

          
</div>

      
</body>
<script>
// JavaScript to enable all input fields on button click
document.querySelector('.editAllButton').addEventListener('click', function() {
    // Select all input fields with class "form-control" and remove the "disabled" attribute
    document.querySelectorAll('.form-control').forEach(function(inputField) {
        inputField.removeAttribute('readonly');
    });
});
</script>


</html>