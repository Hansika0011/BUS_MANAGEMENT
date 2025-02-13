<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if form fields are set and not empty
if (isset($_POST['student_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['drno'], $_POST['location'], $_POST['city'], $_POST['state'], $_POST['gender'],$_POST['status']) && 
    !empty($_POST['student_id']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['drno']) && !empty($_POST['location']) && 
    !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['gender'])  && !empty($_POST['status'])) {
    
    // Retrieve form data
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $drno = $_POST['drno'];
    $location = $_POST['location'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare an update statement
    $sql = "UPDATE student SET s_first_name=?, s_middle_name=?, s_last_name=?, s_drno=?, s_location=?, s_city=?, s_state=?, s_gender=? , s_status=? WHERE student_id=?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);

    // Check if middle_name is empty and adjust binding accordingly
    if (!empty($_POST['middle_name'])) {
        $stmt->bind_param("sssssssssi", $first_name, $middle_name, $last_name, $drno, $location, $city, $state, $gender, $status, $student_id);
    } else {
        // Provide an empty string for middle_name if it's not set
        $empty_middle_name = '';
        $stmt->bind_param("sssssssssi", $first_name, $empty_middle_name, $last_name, $drno, $location, $city, $state, $gender, $status, $student_id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        // If update is successful, redirect back to the view student page
        header("Location: view_student.php");
        exit();
    } else {
        // If an error occurs, display an error message
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If any form field is missing or empty, redirect back to the update student page
    header("Location: update_student.php");
    exit();
}
?>
