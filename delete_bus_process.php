<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if bus_id is set and not empty
if (isset($_POST['bus_id']) && !empty($_POST['bus_id'])) {
    // Retrieve the selected bus ID
    $bus_id = $_POST['bus_id'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a delete statement
    $sql = "DELETE FROM bus WHERE bus_id = ?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bus_id);

    // Execute the statement
    if ($stmt->execute()) {
        // If deletion is successful, redirect back to the bus page
        header("Location: view_bus.php");
        exit();
    } else {
        // If an error occurs, display an error message
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If bus_id is not set or empty, redirect back to the delete bus page
    header("Location: delete_bus.php");
    exit();
}
?>
