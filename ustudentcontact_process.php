<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if student_id, contact, and email are set and not empty
    if (isset($_POST['student_id'], $_POST['contact'], $_POST['email']) && !empty($_POST['student_id']) && !empty($_POST['contact']) && !empty($_POST['email'])) {
        // Retrieve student_id, contact, and email from the form
        $student_id = $_POST['student_id'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare an SQL statement to update contact info in the student_contact table
        $sql_contact = "UPDATE student_contact SET contact = ? WHERE student_id = ?";
        // Prepare and bind the contact statement
        $stmt_contact = $conn->prepare($sql_contact);
        $stmt_contact->bind_param("si", $contact, $student_id);

        // Prepare an SQL statement to update email info in the student_email table
        $sql_email = "UPDATE student_email SET email_id = ? WHERE student_id = ?";
        // Prepare and bind the email statement
        $stmt_email = $conn->prepare($sql_email);
        $stmt_email->bind_param("si", $email, $student_id);

        // Execute both statements
        if ($stmt_contact->execute() && $stmt_email->execute()) {
            // If update is successful, redirect to view_contact.php
            header("Location: view_contact.php");
            exit();
        } else {
            // If an error occurs, display an error message
            echo "Error: " . $conn->error;
        }

        // Close the statements and connection
        $stmt_contact->close();
        $stmt_email->close();
        $conn->close();
    } else {
        // If student_id, contact, or email is not set or empty, redirect back to the previous page
        header("Location: ustudentcontact.php?student_id=" . $_POST['student_id']);
        exit();
    }
} else {
    // If the form data is not submitted via POST method, redirect back to the previous page
    header("Location: ustudentcontact.php?student_id=" . $_POST['student_id']);
    exit();
}
?>
