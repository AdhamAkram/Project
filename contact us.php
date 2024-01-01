<?php
session_start();

// Check if the user is logged in
 if (isset($_SESSION['user_id'])) {
//   // Access user details
  $userId = $_SESSION['user_id'];
   $username = $_SESSION['username'];
//   // Access other relevant details
 } else {
//   // Redirect to the login page if not logged in
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



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
<link rel="stylesheet" href="contact us.css">

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
      <img class="rounded-circle" src="https://drive.google.com/file/d/1JyQu9_xWdoZ00GuQFNOUog-YVuFwQTsP/view">
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
          class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small"
        >
          <li class="nav-icon">
            <a href="matches-page.php" class="nav-link text-black">
              <svg class="bi d-block mx-auto mb-1" width="30" height="30">
                  <use xlink:href="#football" />
                </svg>                    Matches
            </a>
          </li>
          <li class="nav-icon">
              <a href="events.php" class="nav-link text-black">
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
    <html lang="en" data-bs-theme="dark"><head><script src="/docs/5.3/assets/js/color-modes.js"></script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.118.2">
        <title>Checkout example · Bootstrap v5.3</title>
    
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
    
        
    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    
    <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
        <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">
    
    
       
    
        
        <link href="checkout.css" rel="stylesheet">
      </head>
      <body class="bg-body-tertiary" data-new-gr-c-s-check-loaded="14.1145.0" data-gr-ext-installed="">
        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
          <symbol id="check2" viewBox="0 0 16 16">
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
          </symbol>
          <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
          </symbol>
          <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
          </symbol>
          <symbol id="sun-fill" viewBox="0 0 16 16">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
          </symbol>
        </svg>
    
        
    
        
    <div class="container">
      <main>
        <div class="py-5 text-center">
         
          
          <h2>Contact us</h2>
          <p class="lead">For inquiries, suggestions, or complaints, contact us at</p>
           <img class="d-block mx-auto mb-4" src="https://icons.getbootstrap.com/assets/icons/telephone.svg" alt="" width="72" height="57"><span><h1>00000</h1></span>
           <h6>Or fill in this form and we will get back to you.</h6>
        </div>
        
    
        <div class="row g-5">
         
          <div class="col-md-7 col-lg-8">
          
            <form class="needs-validation" novalidate="">
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="Subject" class="form-label">Subject</label>
                  <select class="form-select" id="Subject" required="">
                    <option value="">--Select--</option>
                    <option>Technical Support</option>
                    <option>Suggestion</option>
                    <option>Complaint</option>
                  </select>

                  <div class="invalid-feedback">
                    Valid Subject is required.
                  </div>
                </div>
    <samp>
                <div class="col-sm-6">
                  <label for="Name" class="form-label"> Name</label>
                  <input type="text" class="form-control" id="Name" placeholder="" value="" required="">
                  <div class="invalid-feedback">
                    Valid your name is required.
                  </div>
                </div>
    </samp>
                
    
                <div class="col-12">
                  <label for="email" class="form-label">Email </label>
                  <input type="email" class="form-control" id="email" placeholder="you@example.com"value="" required="">
                  <div class="invalid-feedback">
                    Please enter a valid email address is required.
                  </div>
                </div>
                
    
               
    
               
    
                
    
                
    
                
              </div>
    
              <hr class="my-4">
        
              
    
             
    
              <div class="row gy-3">
                
    
                <div class="col-md-6">
                  <label for="" class="form-label">Tazkarti ID</label>
                  <input type="number" class="form-control" id="" placeholder="" required="">
                  <div class="invalid-feedback">
                    Tazkarti ID number is required
                  </div>
                </div>
                <hr class="my-4">
    
               <samp> <div class="col-md-3">
                  
                  <label for="phone" class="form-label">Mobile Number</label>
                  <select class="form-select" id="phone" required="" >
                    <option value="+1">+20 (Egypt)</option>
                    <option value="+44">+44 (United Kingdom)</option>
                    <option value="+91">+91 (India)</option>
                    
                  </select>
                
                  <div class="invalid-feedback">
                    Mobile Number required
                    </samp>
                  </div>
                </div>
                <div class="more-inputs single" style="background-color: transparent;padding-bottom:20px"><!----><international-phone-number id="internationalphonenumber" name="mobileNumber" tabindex="4" _nghost-ohn-c5="" maxlength="20" class="ng-untouched ng-pristine ng-valid"><div _ngcontent-ohn-c5="" class="input-group"><span _ngcontent-ohn-c5="" class="input-group-addon flagInput"><div _ngcontent-ohn-c5="" class="dropdown"><button _ngcontent-ohn-c5="" class="dropbtn btn" type="button"><!----><span _ngcontent-ohn-c5="" class="flag flag-eg ng-star-inserted"></span><!----><span _ngcontent-ohn-c5="" class="arrow-down"></span></button><!----></div></span><!----><!----><input _ngcontent-ohn-c5="" class="form-control ng-pristine ng-valid ng-star-inserted ng-touched" maxlength="20" placeholder="Mobile Number" type="text"></div></international-phone-number>
              </div>
              <hr class="my-4">
    
                
                  <label for="Message" class="form-label">Message</label>
                 
                  
                  
                  <textarea name="" id="" cols="30" rows="10" class="form-control" style="background-color: rgba(15, 19, 23, 0.421);"></textarea>
                  <div class="invalid-feedback">
                    Security code required
                    
                  </div>
                </div>
              </div>
    
              <hr class="my-4">
    
              <button class="w-100 btn btn-primary btn-lg" type="submit">send</button>
            </form>
          </div>
        </div>
        <hr>
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
      </main>
    
      
    </div>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
        <script src="checkout.js"></script>
    
    <div id="torrent-scanner-popup" style="display: none;"></div></body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>
    </html>
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>