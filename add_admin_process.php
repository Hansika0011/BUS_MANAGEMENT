<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the INSERT statement for admin
$stmt_admin = $conn->prepare("INSERT INTO admin (a_first_name, a_middle_name, a_last_name, a_drno, a_location, a_city, a_state, a_gender, a_designation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_admin->bind_param("sssssssss", $first_name, $middle_name, $last_name, $drno, $location, $city, $state, $gender, $designation);

// Set parameters from the form submission
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$drno = $_POST['drno'];
$location = $_POST['location'];
$city = $_POST['city'];
$state = $_POST['state'];
$gender = $_POST['gender'];
$designation = $_POST['designation'];

// Execute the prepared statement for admin
$success_admin = $stmt_admin->execute();

if ($success_admin) {
    // Get the auto-generated admin_id
    $admin_id = $conn->insert_id;
    
    // Prepare and bind the INSERT statement for admincontact
    $stmt_contact = $conn->prepare("INSERT INTO admincontact (admin_id, a_contact) VALUES (?, ?)");
    $stmt_contact->bind_param("is", $admin_id, $contact_phone);

    // Set contact phone parameter
    $contact_phone = $_POST['contact_phone'];

    // Execute the prepared statement for admincontact
    $success_contact = $stmt_contact->execute();

    if ($success_contact) {
        // Redirect to the admin page after adding a new record
        header("Location: view_admin.php");
        exit();
    } else {
        echo "Error: " . $stmt_contact->error;
    }

    // Close the admincontact statement
    $stmt_contact->close();
} else {
    echo "Error: " . $stmt_admin->error;
}

// Close the admin statement and connection
$stmt_admin->close();
$conn->close();
?>
