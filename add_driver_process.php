<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if form fields are set and not empty
if (isset($_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['drno'], $_POST['location'], $_POST['city'], $_POST['state'], $_POST['gender'], $_POST['phone_number']) && 
    !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['drno']) && !empty($_POST['location']) && 
    !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['gender']) && !empty($_POST['d_phoneno'])) {
    
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $drno = $_POST['drno'];
    $location = $_POST['location'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $gender = $_POST['gender'];
    $d_phoneno = $_POST['d_phoneno'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare an insert statement for driver details
    $sql_driver = "INSERT INTO driver (d_first_name, d_middle_name, d_last_name, d_drno, d_location, d_city, d_state, d_gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_driver = $conn->prepare($sql_driver);
    $stmt_driver->bind_param("ssssssss", $first_name, $middle_name, $last_name, $drno, $location, $city, $state, $gender);

    // Execute the driver details insert statement
    if ($stmt_driver->execute()) {
        // Retrieve the driver ID of the newly inserted driver
        $driver_id = $stmt_driver->insert_id;

        // Prepare an insert statement for driver contact info
        $sql_contact = "INSERT INTO drivercontact (driver_id, d_phoneno) VALUES (?, ?)";
        $stmt_contact = $conn->prepare($sql_contact);
        $stmt_contact->bind_param("is", $driver_id, $d_phoneno);

        // Execute the driver contact info insert statement
        if ($stmt_contact->execute()) {
            // If insertion is successful, redirect back to the view drivers page
            header("Location: view_driver.php");
            exit();
        } else {
            // If an error occurs with inserting contact info, display an error message
            echo "Error inserting driver contact info: " . $stmt_contact->error;
        }
    } else {
        // If an error occurs with inserting driver details, display an error message
        echo "Error inserting driver details: " . $stmt_driver->error;
    }

    // Close the statements and connection
    $stmt_driver->close();
    $stmt_contact->close();
    $conn->close();
} else {
    // If any form field is missing or empty, redirect back to the add driver page
    header("Location: add_driver.php");
    exit();
}
?>
