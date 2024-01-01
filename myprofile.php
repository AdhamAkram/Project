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

$sql = "SELECT * FROM users WHERE user_id LIKE $userId ";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch each row and store data in PHP variables
    while ($row = $result->fetch_assoc()) {
        $email = $row["email"];
        $phone = $row["phone"];
        
    }
} else {
    echo "0 results";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>My Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
<link rel="stylesheet" href="myprofile.css">
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
      <img src="2.svg" width="55" height="55" style="margin-top:15px" alt="Your SVG Image">

      </a>

      <ul
        class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small"
      >
        <li>
          <a href="homepage.php" class="nav-link text-white">
            <svg class="bi d-block mx-auto mb-1 color-black" width="24" height="24" >
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
        <img class="rounded-circle" src="https://media.istockphoto.com/id/1288538088/photo/portrait-young-confident-smart-asian-businessman-look-at-camera-and-smile.jpg?s=2048x2048&w=is&k=20&c=J-PEzTmJkg-2ngh-oKmIucEuzMX4l7C7lH2JG6U5NZw=">
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





<div class="d-md-flex flex-md-equal my-md-3 ps-md-3" style="width: 70%; margin-left: 15%;">
  <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
    <div class="my-3 p-3">
      <h1 class="display-5"><strong>Status</strong></h1>
      <h4 class="display-7"><?php echo '' .$_SESSION['username'].'';  ?></h4>
      <p1 class="lead">Reserva ID: <?php echo '' .$_SESSION['user_id'].'';  ?></p1>
    </div>
    <div class="background">
    <img src="https://media.istockphoto.com/id/1288538088/photo/portrait-young-confident-smart-asian-businessman-look-at-camera-and-smile.jpg?s=2048x2048&w=is&k=20&c=J-PEzTmJkg-2ngh-oKmIucEuzMX4l7C7lH2JG6U5NZw=">
    </div>
    <br>
  </div>
  <div class="container mt-5">
    <form class="needs-validation" method="post" novalidate>
        <hr>
        <h6 class="personal"><b>Personal information</b></h6>
        <div class="row g-4">
            <div class="col-md-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo '' .$_SESSION['username'].'';  ?>" required>
                <div class="invalid-feedback">
                    Please enter a username.
                </div>
            </div>

            <div class="col-md-4">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" value="<?php echo ' ' . $email. '';  ?>" id="email" required>
                <div class="invalid-feedback">
                    Please enter a valid email address.
                </div>
            </div>

            <div class="col-md-4">
                <label for="phone" class="form-label">Phone number</label>
                <input type="tel" class="form-control" name="phone" value="<?php echo ' ' . $phone. '';  ?>" id="phone" pattern="\d{11}" required>
                <div class="invalid-feedback">
                    Please enter a valid phone number with 11 digits.
                </div>
            </div>

            <div class="col-md-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <div class="invalid-feedback">
                    Please enter a password.
                </div>
            </div>

            <div class="col-md-4">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm" id="confirmPassword" required>
                <div class="invalid-feedback">
                    Password and Confirm Password do not match.
                </div>
            </div>

            <div class="col-md-12 mt-3 text-end">
                <button type="submit" class="btn btn-dark">Update</button>
            </div>
        </div>
    </form>
</div>

  
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form fields are set in the $_POST array
    if (isset($_POST['username'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['confirm'])) {
        
        // Retrieve data from the form inputs
        $newUsername = $_POST['username'];
        $newEmail = $_POST['email'];
        $newPhone = $_POST['phone'];
        $newPassword =  $_POST['password'];
        $confirmPassword =  $_POST['confirm'];
        echo ''.$newPassword.'';
      
      
        // Check if the confirm password matches the new password
        if ($confirmPassword == $newPassword) {
          $sqlUpdate = "UPDATE users SET username='$newUsername', password_hash='$newPassword',phone=' $newPhone' ,email='$newEmail' WHERE user_id='$userId'";

  $resultUpdate = $conn->query($sqlUpdate);

  if ($resultUpdate) {
      // Update successful
      echo '<script>alert("User UPDATED successfully!");</script>';
      echo '<script>window.location.href = "logout.php";</script>';
  } else {
      // Update failed
      echo "Error updating user: " . $conn->error;
  }
        } else {
            echo '';
        }
    } else {
        echo 'One or more form fields are not set.';
    }
}
?>


</div>

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















<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Bootstrap validation script -->

<!-- Bootstrap validation script -->
<script>
    (function () {
        'use strict';

        var form = document.querySelector('.needs-validation');

        form.addEventListener('submit', function (event) {
            var hasError = false;

            var inputs = form.querySelectorAll('input');
            inputs.forEach(function (input) {
                if (input.checkValidity() === false) {
                    displayError(input, input.validationMessage);
                    hasError = true;
                } else {
                    clearError(input);
                }
            });

            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            if (password !== confirmPassword) {
                displayError(document.getElementById('confirmPassword'), 'Password and Confirm Password do not match.');
                hasError = true;
            } else {
                clearError(document.getElementById('confirmPassword'));
            }

            if (hasError) {
                event.preventDefault();
                event.stopPropagation();
            }
        }, false);

        var inputs = form.querySelectorAll('input');
        inputs.forEach(function (input) {
            input.addEventListener('input', function () {
                var errorContainer = input.nextElementSibling;
                clearError(errorContainer);
            });
        });

        function displayError(input, message) {
            var errorContainer = input.nextElementSibling;
            errorContainer.innerHTML = message;
            input.classList.add('is-invalid');
        }

        function clearError(input) {
            input.innerHTML = '';
            input.previousElementSibling.classList.remove('is-invalid');
        }
    })();
</script>






<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>