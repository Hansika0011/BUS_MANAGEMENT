<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if form fields are set and not empty
if (isset($_POST['admin_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['drno'], $_POST['location'], $_POST['city'], $_POST['state'], $_POST['gender'],$_POST['designation']) && 
    !empty($_POST['admin_id']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['drno']) && !empty($_POST['location']) && 
    !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['gender'])  && !empty($_POST['designation'])) {
    
    // Retrieve form data
    $admin_id = $_POST['admin_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $drno = $_POST['drno'];
    $location = $_POST['location'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $gender = $_POST['gender'];
    $designation = $_POST['designation'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare an update statement
    $sql = "UPDATE admin SET a_first_name=?, a_middle_name=?, a_last_name=?, a_drno=?, a_location=?, a_city=?, a_state=?, a_gender=? , a_designation=? WHERE admin_id=?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);

    // Check if middle_name is empty and adjust binding accordingly
    if (!empty($_POST['middle_name'])) {
        $stmt->bind_param("sssssssssi", $first_name, $middle_name, $last_name, $drno, $location, $city, $state, $gender, $designation, $admin_id);
    } else {
        // Provide an empty string for middle_name if it's not set
        $empty_middle_name = '';
        $stmt->bind_param("sssssssssi", $first_name, $empty_middle_name, $last_name, $drno, $location, $city, $state, $gender, $designation, $admin_id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        // If update is successful, redirect back to the view admin page
        header("Location: view_admin.php");
        exit();
    } else {
        // If an error occurs, display an error message
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If any form field is missing or empty, redirect back to the update admin page
    header("Location: update_admin.php");
    exit();
}
?>
