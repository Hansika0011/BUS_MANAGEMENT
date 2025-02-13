<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if driver_id is set and not empty
if (isset($_POST['student_id']) && !empty($_POST['student_id'])) {
    // Retrieve the selected driver ID
    $student_id = $_POST['student_id'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a delete statement
    $sql = "DELETE FROM student WHERE student_id = ?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);

    // Execute the statement
    if ($stmt->execute()) {
        // If deletion is successful, redirect back to the driver page
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
    // If driver_id is not set or empty, redirect back to the delete driver page
    header("Location: delete_student.php");
    exit();
}
?>
