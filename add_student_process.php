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

// Prepare and bind the INSERT statement for student
$stmt_student = $conn->prepare("INSERT INTO student (s_first_name, s_middle_name, s_last_name, s_drno, s_location, s_city, s_state, s_gender, s_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_student->bind_param("sssssssss", $first_name, $middle_name, $last_name, $drno, $location, $city, $state, $gender, $status);

// Set parameters from the form submission
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$drno = $_POST['drno'];
$location = $_POST['location'];
$city = $_POST['city'];
$state = $_POST['state'];
$gender = $_POST['gender'];
$status = $_POST['status'];

// Execute the prepared statement for student
$success_student = $stmt_student->execute();

if ($success_student) {
    // Get the auto-generated student_id
    $student_id = $conn->insert_id;

    // Prepare and bind the INSERT statements for student contact and email
    $stmt_contact = $conn->prepare("INSERT INTO student_contact (student_id, contact) VALUES (?, ?)");
    $stmt_contact->bind_param("is", $student_id, $contact_phone);
    
    $stmt_email = $conn->prepare("INSERT INTO student_email (student_id, email_id) VALUES (?, ?)");
    $stmt_email->bind_param("is", $student_id, $email_id);

    // Set contact phone and email parameters
    $contact_phone = $_POST['contact_phone'];
    $email_id = $_POST['email'];

    // Execute the prepared statements for student contact and email
    $success_contact = $stmt_contact->execute();
    $success_email = $stmt_email->execute();

    if ($success_contact && $success_email) {
        // Redirect to the student page after adding a new record
        header("Location: view_student.php");
        exit();
    } else {
        echo "Error: " . $stmt_contact->error;
        echo "Error: " . $stmt_email->error;
    }

    // Close the student contact and email statements
    $stmt_contact->close();
    $stmt_email->close();
} else {
    echo "Error: " . $stmt_student->error;
}

// Close the student statement and connection
$stmt_student->close();
$conn->close();
?>
