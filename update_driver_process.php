<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if form fields are set and not empty
if (isset($_POST['driver_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name']) && 
    !empty($_POST['driver_id']) && !empty($_POST['first_name']) && !empty($_POST['last_name'])) {
    
    // Retrieve form data and sanitize if necessary
    $driver_id = $_POST['driver_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare an update statement
    $sql = "UPDATE driver SET d_first_name=?, d_middle_name=?, d_last_name=? WHERE driver_id=?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);

    // Prepare and bind the statement
    if (!empty($_POST['middle_name'])) {
        $stmt->bind_param("sssi", $first_name, $middle_name, $last_name, $driver_id);
    } else {
        $empty_middle_name = '';
        $stmt->bind_param("sssi", $first_name, $empty_middle_name, $last_name, $driver_id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        // If update is successful, redirect back to the view drivers page
        header("Location: view_driver.php");
        exit();
    } else {
        // If an error occurs, log the error and redirect to an error page
        error_log("Error updating driver: " . $stmt->error);
        header("Location: error_page.php");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If any form field is missing or empty, redirect back to the update driver page
    header("Location: update_driver.php");
    exit();
}
?>