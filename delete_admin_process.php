<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if admin_id is set and not empty
if (isset($_POST['admin_id']) && !empty($_POST['admin_id'])) {
    // Retrieve the selected admin ID
    $admin_id = $_POST['admin_id'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Disable foreign key checks to enable deletion cascade
    $conn->query("SET FOREIGN_KEY_CHECKS=0");

    // Prepare a delete statement
    $sql = "DELETE FROM admin WHERE admin_id = ?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);

    // Execute the statement
    if ($stmt->execute()) {
        // If deletion is successful, redirect back to the admin page
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
    // If admin_id is not set or empty, redirect back to the delete admin page
    header("Location: delete_admin.php");
    exit();
}
?>
