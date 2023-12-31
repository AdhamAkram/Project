<?php
session_start();
$user_id = $_SESSION['user_id'];

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  // Access user details
  $user_id = $_SESSION['user_id'];

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



?>



<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Checkout</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    
    <link href="checkout-page.css" rel="stylesheet">
    
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
                      <svg class="bi d-block mx-auto mb-1" width="24" height="24" >
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
<div class="container">
  <main>

  <form class="needs-validation" novalidate method="post">
    <div class="checkout-header"></div>
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-black">Your cart</span>
         
        </h4>
        <?php
        $eventId = isset($_POST['event_id']) ? $_POST['event_id'] : '';
        
        $sql = "
        SELECT * 
        FROM events
            WHERE
            event_id LIKE '%$eventId%'
            
        ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">' . $row["artist_name"] . '</h6>
              <small class="text-body-secondary">'. $row["location"] .'</small>
            </div>
          </li>
         
        
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (EGP)</span>
            <strong>'. $row["price"] .'</strong>
          </li>
        </ul>
        ';
      }
    } else {
        echo "No matches found.";
    }
  
    
        ?>
       
      </div>
      <div class="col-md-7 col-lg-8">
        

        
         
          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            
            <div class="form-check">
              <input id="cash" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="cash">Cash</label>
            </div>
          </div>

          <div class="row gy-3" id="paymentDetails">
            <div id="newElementContainer">
                <!-- The new element will be added here -->
              </div>
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-body-secondary">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>

          <hr class="my-4">
          <input type="hidden" name="event_id" value="<?php echo $eventId; ?>" />
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />


<button class="w-100 btn btn-dark btn-lg" type="submit" name="Checkout">Proceed to checkout</button>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Checkout'])) {
    // Assuming $match_id, $category_name, etc. are PHP variables from form fields
    $eventId = isset($_POST['event_id']) ? $_POST['event_id'] : '';
    if (empty($eventId)) {
        echo 'Invalid event ID.';
    } else {
        // Insert the booking into the events_booking table
        $sqlInsertBooking = "INSERT INTO events_booking (user_id, event_id) VALUES ($user_id, '$eventId')";

        // Execute the SQL query
        if ($conn->query($sqlInsertBooking) === TRUE) {
            echo 'Booking successful';
        } else {
            echo 'Error: ' . $conn->error;
        }
    }
}

?>


        </form>
      </div>
    </div>
  </main>
 



  
</div>
<hr>
<div class="px-3 py-2 text-bg-dark border-bottom">
  <div class="container">
    <footer class="py-3 my-4">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-primary text-white">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-primary text-white">Contact Us</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-primary text-white">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-primary text-white">About</a></li>
      </ul>
      <p class="text-center text-body-primary">© 2023 Company, Inc</p>
    </footer>
  </div>
</div>


<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Remove the comment tags around this script block -->
    <script>
$(document).ready(function () {
    // Handle form submission when "Proceed to checkout" button is clicked
    $(".needs-validation").submit(function (event) {
        // Prevent the default form submission
        
        
        console.log("Form submitted"); // Debugging statement

        // Get form data
        var formData = new FormData(this);

        // Send AJAX request to the server-side script
        $.ajax({
            type: "POST",
            url: "events-checkout.php", // Replace with the actual server-side script URL
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
               

               
                window.location.href = "mytickets.php";
            },
            error: function (error) {
                console.error("AJAX request failed:", error);
                alert("Error: Unable to process the booking.");
            }
        });
    });
});

</script>

  
<script src="checkout-page.js"></script></body>
  </body>
</html>
