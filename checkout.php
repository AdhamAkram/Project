<?php

session_start();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  // Access user details
  $user_id = $_SESSION['user_id'];
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



// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proceedToCheckout'])) {
    // Assuming $match_id, $category_name, etc. are PHP variables from form fields
    $match_id = isset($_POST['match_id']) ? $_POST['match_id'] : '';
    $category_name = isset($_POST['category_name']) ? $_POST['category_name'] : '';

    // Your SQL query for retrieving pricing_id
    $sqlPricingId = "SELECT pricing_id FROM ticket_pricing WHERE category_name LIKE '$category_name'";
    $resultPricingId = $conn->query($sqlPricingId);

    if ($resultPricingId) {
        $rowPricingId = $resultPricingId->fetch_assoc();

        if ($rowPricingId) {
            $pricingId = $rowPricingId['pricing_id'];

            // Your SQL query for inserting into the booking table
            $sqlInsertBooking = "INSERT INTO booking (user_id, match_id, ticket_category_id, booking_date) VALUES ('$user_id', '$match_id', '$pricingId', NOW())";

            // Execute the insertion query
            if ($conn->query($sqlInsertBooking) === TRUE) {
                echo 'Booking successful';
            } else {
                echo "Error creating booking: " . $conn->error;
            }
        } else {
            echo "No matching record found for pricing_id.";
        }
    } else {
        echo "Error executing pricing_id query: " . $conn->error;
    }
}

?>