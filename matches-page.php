<?php
session_start();
$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  // Access user details
  $userId = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  // Access other relevant details
} else {
   // Redirect to the login page if not logged in
   echo '<script>window.location.href = "signin-form.php";</script>';
   exit();
}
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$ticketSql = "SELECT category_name, price FROM ticket_pricing";
$ticketResult = $conn->query($ticketSql);

if (!$ticketResult) {
    die("Error retrieving ticket categories: " . $conn->error);
}

// Store ticket categories and prices in an array
$ticketCategories = array();
while ($ticketRow = $ticketResult->fetch_assoc()) {
    $ticketCategories[] = $ticketRow;
}




function getNames($column , $table, $conn) {
    $sql = "SELECT $column FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $names = [];
        while($row = $result->fetch_assoc()) {
            $names[] = $row[$column];
        }
        return $names;
    } else {
        return null;
    }
}


$team = getNames("team_name","team", $conn);


?>
<?php
// Fetch the user's profile_pic_url from the database
$userId = $_SESSION['user_id']; // Assuming you have a user session
$selectQuery = "SELECT profile_pic_url FROM users WHERE user_id = $userId";
$result = mysqli_query($conn, $selectQuery);
$row = mysqli_fetch_assoc($result);

// Check if the user has a custom profile picture, otherwise use the default
$profilePicUrl = !empty($row['profile_pic_url']) ? $row['profile_pic_url'] : 'default_profile_pic_url.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches</title>
    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.3/examples/headers/"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@docsearch/css@3"
    />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    </svg>
    
        
    </svg>
    <div class="px-3 py-2 text-bg-dark border-bottom">
        <div class="container">
          <div
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"
          >
            <a
              href="/"
              class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none"
            >
            <img src="2.svg" width="55" height="55" style="margin-top:15px" alt="Your SVG Image">
            </a>
  
            <ul
              class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small"
            >
              <li>
                <a href="homepage.php" class="nav-link text-white">
                  <svg class="bi d-block mx-auto mb-1" width="24" height="24" >
                    <use xlink:href="#home" />
                  </svg>
                  Home
                </a>
              </li>
              <li>
                  <a href="myprofile.php" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                      <use xlink:href="#profile" />
                    </svg>
                    My Profile
                  </a>
                </li>
                <li>
                    <a href="logout.php" class="nav-link text-white">
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
          <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; margin-right: 20px; margin-left: 80px;" src="<?php echo ''.$profilePicUrl.'';  ?>">
            <div class="info">
            <div class="welcome">Welcome</div>
                <div class="name"><?php echo '' .$_SESSION['username'].'';  ?></div>
                <div class="fan-id">
                    <span class="text-grey-light">ID:</span>
                    <span class="id-num"><?php echo '' .$_SESSION['user_id'].'';  ?></span>
                </div>
                <div class="fan-id vaccin-info"><!----></div>
            </div>
            <ul class="navbar-nav col-lg-6 justify-content-lg-center">
                <ul
                class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li class="nav-icon">
                  <a href="matches-page.php" class="nav-link text-black">
                    <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                        <use xlink:href="#football" />
                      </svg>                    Matches
                  </a>
                </li>
                <li class="nav-icon">
                    <a href="events.php" class="nav-link text-dark">
                      <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                        <use xlink:href="#event" />
                      </svg>
                      Events
                    </a>
                  </li>
                  <li class="nav-icon">
                      <a href="mytickets.php" class="nav-link text-black">
                        <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                            <use xlink:href="#ticket" />
                          </svg>
                                                My Tickets
                      </a>
                    </li>
               
              </ul>
              
              
              </li>
            </ul>
           
          </div>
        </div>
      </nav>
      
      <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
            <a class="navbar-brand col-lg-3 me-0" >Matches</a>
            <ul class="navbar-nav col-lg-9 justify-content-lg-center">
    <li class="nav-item">
        <form id="yourFormId" method="post" action="">
            <div class="d-flex">
                <select id="team" name="selectedTeam" class="form-control" style="width: 250px;">
                    <option id="allTeams" <?php if(isset($_POST['selectedTeam']) && $_POST['selectedTeam'] == 'All Teams'){echo 'selected';} ?>>All Teams</option>
                    <?php foreach ($team as $team): ?>
                        <option id="selectedTeam" <?php if(isset($_POST['selectedTeam']) && $_POST['selectedTeam'] == $team){echo 'selected';} ?> value="<?php echo $team; ?>"><?php echo $team; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="submit" class="button button-black " style="width: 200px;">Filter</button>
            </div>
        </form>
    </li>

          </div>
        </div>
      </nav>
      
      
      <?php
      
      if(isset($_POST['selectedTeam']))
{
$filtered = $_POST['selectedTeam'];

$sql = "
SELECT
    m.match_id,
    m.match_date,
    m.match_time,
    t.tournament_name,
    s.stadium_name,
    m.week,
    m.stage,
    team1.team_name AS team1_name,
    team1.team_logo_url AS team1_logo_url,
    team2.team_name AS team2_name,
    team2.team_logo_url AS team2_logo_url
FROM
    matches m
JOIN
    team team1 ON m.team1_id = team1.team_id
JOIN
    team team2 ON m.team2_id = team2.team_id
    JOIN
    tournament t ON m.tournament_id = t.tournament_id
JOIN
    stadium s ON m.stadium_id = s.stadium_id
    
    WHERE
    CASE
        WHEN '$filtered' = 'All Teams' THEN 1
        ELSE team1.team_name LIKE '%$filtered%' OR team2.team_name LIKE '%$filtered%'
    END
    AND NOT EXISTS (
      SELECT 1
      FROM booking b
      WHERE b.user_id = '$userId'
      AND b.match_id = m.match_id
  )

    ORDER BY
    m.match_date ASC
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    
  while ($row = $result->fetch_assoc()) {
      echo '
          <div class="all-matches snipcss-UkjXK">
              <div class="ng-star-inserted">
                  <div class="match active">
                      <div class="top clearfix">
                          <div class="teams">
                              <div class="image-holder first">
                                  <div class="flag-icon style-GZKDY" id="style-GZKDY">
                                      <img src="' . $row["team1_logo_url"] . '" class="rounded-circle" alt="Team 1 Logo">  
                                  </div>
                              </div>
                              <div class="image-holder second">
                                  <div class="flag-icon style-jQWQz" id="style-jQWQz">
                                      <img src="' . $row["team2_logo_url"] . '" class="rounded" alt="Team 2 Logo">  
                                  </div>
                              </div>
                              <div class="team-names">
                                  <div class="team-name first">
                                      ' . $row["team1_name"] . '
                                  </div>
                                  <div class="team-name-holder">
                                      <div class="vs">
                                          vs
                                      </div>
                                      <div class="team-name second">
                                          ' . $row["team2_name"] . '
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="blocks">
                              <div class="one-block stadium">
                                  <div class="image-holder">
                                      <img alt="" src="https://tazkarti.com/assets/images/svg/stadium.svg">
                                  </div>
                                  <div class="info">
                                      <h6>' . $row["stadium_name"] . '</h6>
                                  </div>
                              </div>
                              <div class="one-block when">
                                  <div class="image-holder">
                                      <img alt="" src="https://tazkarti.com/assets/images/calendar.svg">
                                  </div>
                                  <div class="info">
                                      <div class="first">
                                          ' . date("D j M Y", strtotime($row["match_date"])) . '
                                      </div>
                                      <div class="second">
                                          Time: ' . $row["match_time"] . ' PM 
                                      </div>
                                  </div>
                              </div>
                             
                              <button class="button button-black width-auto book-ticket-btn" 
                              data-bs-toggle="modal" 
                              data-bs-target="#staticBackdrop"
                              data-match-id="' . $row["match_id"] . '"
                              data-team1-name="' . $row["team1_name"] . '"
                              data-team1-logo="' . $row["team1_logo_url"] . '"
                              data-team2-name="' . $row["team2_name"] . '"
                              data-team2-logo="' . $row["team2_logo_url"] . '"
                             
                              onclick="bookTicket(this)">
                              Book Ticket
                          </button>
            </div>
          </div>
          <div class="bottom">
            <div class="one">
              <div class="first">
                Tournament
              </div>
              <div class="second style-oF12b" id="style-oF12b">
              '. $row["tournament_name"] .'
              </div>
            </div>
            <div class="one">
              <div class="first">
                Match No.
              </div>
              <div class="second style-qTcj7" id="style-qTcj7">
              '. $row["match_id"] .'
              </div>
            </div>
            <div class="one">
              <div class="first ng-star-inserted">
                Group : 
              </div>
              <div class="second style-tabpl" id="style-tabpl">
              '. $row["week"] .' 
              </div>
            </div>
            <div class="one">
              <div class="second style-h4N5j" id="style-h4N5j">
              '. $row["stage"] .'
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div> <hr>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">Book Ticket</h4>
              <div><button type="button" class="btn-close" onClick="window.location.reload();" aria-label="Close"></button></div>
          </div>
          <div class="modal-body text-center">
          
                  <input type="hidden" name="matchId" id="matchIdInput">
                  <input type="hidden" name="ticketCategory" id="ticketCategoryInput">
                  <input type="hidden" name="ticketPrice" id="ticketPriceInput">
              <div class="teams-images modal-body text-center d-flex justify-content-center align-items-center">
                  <div class="d-inline-block mx-4 image-holder">
                  <img src="" class="rounded-circle img-fluid team-logo-1" alt="Team 1 Logo">
                      <div class="team-name first team-name-1"></div>
                  </div>
                  <div class="d-inline-block mx-5 image-holder">
                  <img src="" class="rounded-circle img-fluid team-logo-2" alt="Team 2 Logo">
                      <div class="team-name first team-name-2"></div>
                  </div>
              </div>
             
          <div class="mt-3">
              <div>Choose a seat</div>
              <select id="cat-select" class="cat-select">
                 ';

                    foreach ($ticketCategories as $category) {
                        echo '<option value="' . $category['category_name'] . '|' . $category['price'] .'|' . $adham . '">' . $category['category_name'] . ' - ' . $category['price'] . 'EGP</option>';
                    }
                    $selectedOption = $_POST['cat-select'];
                
          
                  echo '
                  </select>
                  
              </div>
          </div>
          <div class="modal-footer">
            <button type="button"  class="btn btn-secondary" onClick="window.location.reload();" >Close</button>
            <button type="submit" class="button button-black width-auto book-ticket-btn" 
  data-bs-toggle="modal" 
  data-bs-target="#staticBackdrop"
  id="bookButton"
  
  ">
  Book Ticket
</button>
</form>
          </div>
      </div>
  </div>
</div>
    ';
  }
} else {
  echo "No matches found.";
}


}
if(!isset($_POST['selectedTeam']))
{

$sql = "
SELECT
    m.match_id,
    m.match_date,
    m.match_time,
    t.tournament_name,
    s.stadium_name,
    m.week,
    m.stage,
   
    team1.team_name AS team1_name,
    team1.team_logo_url AS team1_logo_url,
    team2.team_name AS team2_name,
    team2.team_logo_url AS team2_logo_url
FROM
    matches m
JOIN
    team team1 ON m.team1_id = team1.team_id
JOIN
    team team2 ON m.team2_id = team2.team_id
    JOIN
    tournament t ON m.tournament_id = t.tournament_id
JOIN
    stadium s ON m.stadium_id = s.stadium_id

    WHERE NOT EXISTS (
      SELECT 1
      FROM booking b
      WHERE b.user_id = '$userId'
      AND b.match_id = m.match_id
  )
    ORDER BY
    m.match_date ASC
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    
    while ($row = $result->fetch_assoc()) {
        echo '
            <div class="all-matches snipcss-UkjXK">
                <div class="ng-star-inserted">
                    <div class="match active">
                        <div class="top clearfix">
                            <div class="teams">
                                <div class="image-holder first">
                                    <div class="flag-icon style-GZKDY" id="style-GZKDY">
                                        <img src="' . $row["team1_logo_url"] . '" class="rounded-circle" alt="Team 1 Logo">  
                                    </div>
                                </div>
                                <div class="image-holder second">
                                    <div class="flag-icon style-jQWQz" id="style-jQWQz">
                                        <img src="' . $row["team2_logo_url"] . '" class="rounded" alt="Team 2 Logo">  
                                    </div>
                                </div>
                                <div class="team-names">
                                    <div class="team-name first">
                                        ' . $row["team1_name"] . '
                                    </div>
                                    <div class="team-name-holder">
                                        <div class="vs">
                                            vs
                                        </div>
                                        <div class="team-name second">
                                            ' . $row["team2_name"] . '
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blocks">
                                <div class="one-block stadium">
                                    <div class="image-holder">
                                        <img alt="" src="https://tazkarti.com/assets/images/svg/stadium.svg">
                                    </div>
                                    <div class="info">
                                        <h6>' . $row["stadium_name"] . '</h6>
                                    </div>
                                </div>
                                <div class="one-block when">
                                    <div class="image-holder">
                                        <img alt="" src="https://tazkarti.com/assets/images/calendar.svg">
                                    </div>
                                    <div class="info">
                                        <div class="first">
                                            ' . date("D j M Y", strtotime($row["match_date"])) . '
                                        </div>
                                        <div class="second">
                                            Time: ' . $row["match_time"] . ' PM 
                                        </div>
                                    </div>
                                </div>
                               
                                <button class="button button-black width-auto book-ticket-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#staticBackdrop"
                                data-match-id="' . $row["match_id"] . '"
                                data-team1-name="' . $row["team1_name"] . '"
                                data-team1-logo="' . $row["team1_logo_url"] . '"
                                data-team2-name="' . $row["team2_name"] . '"
                                data-team2-logo="' . $row["team2_logo_url"] . '"
                               
                                onclick="bookTicket(this)">
                                Book Ticket
                            </button>
              </div>
            </div>
            <div class="bottom">
              <div class="one">
                <div class="first">
                  Tournament
                </div>
                <div class="second style-oF12b" id="style-oF12b">
                '. $row["tournament_name"] .'
                </div>
              </div>
              <div class="one">
                <div class="first">
                  Match No.
                </div>
                <div class="second style-qTcj7" id="style-qTcj7">
                '. $row["match_id"] .'
                </div>
              </div>
              <div class="one">
                <div class="first ng-star-inserted">
                  Group : 
                </div>
                <div class="second style-tabpl" id="style-tabpl">
                '. $row["week"] .' 
                </div>
              </div>
              <div class="one">
                <div class="second style-h4N5j" id="style-h4N5j">
                '. $row["stage"] .'
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div> <hr>
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Book Ticket</h4>
                <div><button type="button" class="btn-close" onClick="window.location.reload();" aria-label="Close"></button></div>
            </div>
            <div class="modal-body text-center">
            
                    <input type="hidden" name="matchId" id="matchIdInput">
                    <input type="hidden" name="ticketCategory" id="ticketCategoryInput">
                    <input type="hidden" name="ticketPrice" id="ticketPriceInput">
                <div class="teams-images modal-body text-center d-flex justify-content-center align-items-center">
                    <div class="d-inline-block mx-4 image-holder">
                    <img src="" class="rounded-circle img-fluid team-logo-1" alt="Team 1 Logo">
                        <div class="team-name first team-name-1"></div>
                    </div>
                    <div class="d-inline-block mx-5 image-holder">
                    <img src="" class="rounded-circle img-fluid team-logo-2" alt="Team 2 Logo">
                        <div class="team-name first team-name-2"></div>
                    </div>
                </div>
               
            <div class="mt-3">
                <div>Choose a seat</div>
                <select id="cat-select" class="cat-select">
                   ';

                      foreach ($ticketCategories as $category) {
                          echo '<option value="' . $category['category_name'] . '|' . $category['price'] .'|">' . $category['category_name'] . ' - ' . $category['price'] . 'EGP</option>';
                      }
                      $selectedOption = $_POST['cat-select'];
                  
            
                    echo '
                    </select>
                    
                </div>
            </div>
            <div class="modal-footer">
              <button type="button"  class="btn btn-secondary" onClick="window.location.reload();" >Close</button>
              <button type="submit" class="button button-black width-auto book-ticket-btn" 
    data-bs-toggle="modal" 
    data-bs-target="#staticBackdrop"
    id="bookButton"
    
    ">
    Book Ticket
</button>
</form>
            </div>
        </div>
    </div>
</div>
      ';
    }
} else {
    echo "No matches found.";
}


}


$conn->close();

?>
<div id="resultContainer"></div>

<div class="px-3 py-2 text-bg-dark border-bottom">
      <div class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="Homepage.php" class="nav-link px-2 text-body-primary text-white">Home</a></li>
            <li class="nav-item"><a href="contact us.html" class="nav-link px-2 text-body-primary text-white">Contact Us</a></li>
            <li class="nav-item"><a href="FAQ.html" class="nav-link px-2 text-body-primary text-white">FAQs</a></li>
            <li class="nav-item"><a href="about.html" class="nav-link px-2 text-body-primary text-white">About</a></li>
          </ul>
          <p class="text-center text-body-primary">© 2024 Reserva</p>
        </footer>
      </div>
    </div>
          
          
            
      <script>
        var matchId;
function bookTicket(button) {
    var modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));

    // Get data attributes from the clicked button
     matchId = button.getAttribute('data-match-id');
    var team1Name = button.getAttribute('data-team1-name');
    var team1Logo = button.getAttribute('data-team1-logo');
    var team2Name = button.getAttribute('data-team2-name');
    var team2Logo = button.getAttribute('data-team2-logo');
    // Update modal content with the selected match data
    document.querySelector('.team-name-1').innerText = team1Name;
    document.querySelector('.team-name-2').innerText = team2Name;
    document.querySelector('.team-logo-1').src = team1Logo;
    document.querySelector('.team-logo-2').src = team2Logo;
  

    // Open the modal

    modal.show();
   
  
}


    $(document).ready(function () {
        // Event listener for the book button
        $('#bookButton').on('click', function () {
            // Get the selected option value
            var selectedCategory = $('#cat-select').val();
           
            // Log the selected value to the console
         
            var values = selectedCategory.split('|');

// Extract the price and category name
var price = values[1];
var categoryName = values[0];

proceedToCheckout();
       

});
    });

    function proceedToCheckout() {
    // Get the selected category from your modal
    var selectedCategory = $('#cat-select').val();
    var values = selectedCategory.split('|');
    var price = values[1];
    var categoryName = values[0];

    // Create a form element
    var form = document.createElement('form');
    form.method = 'post'; // You can change this to 'get' if needed
    form.action = 'checkout-page.php';

    // Create hidden input fields for the data you want to pass
    var matchIdInput = document.createElement('input');
    matchIdInput.type = 'hidden';
    matchIdInput.name = 'match_id';
    matchIdInput.value = matchId; // Use the global variable here

    var categoryNameInput = document.createElement('input');
    categoryNameInput.type = 'hidden';
    categoryNameInput.name = 'category_name';
    categoryNameInput.value = categoryName;

    var priceInput = document.createElement('input');
    priceInput.type = 'hidden';
    priceInput.name = 'price';
    priceInput.value = price;

    // Append the input fields to the form
    form.appendChild(matchIdInput);
    form.appendChild(categoryNameInput);
    form.appendChild(priceInput);

    // Append the form to the body and submit it
    document.body.appendChild(form);
    form.submit();
}
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>