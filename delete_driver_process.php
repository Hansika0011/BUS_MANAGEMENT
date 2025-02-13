<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if driver_id is set and not empty
if (isset($_POST['driver_id']) && !empty($_POST['driver_id'])) {
    // Retrieve the selected driver ID
    $driver_id = $_POST['driver_id'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Delete associated data from the bus table
        $sql_delete_bus = "DELETE FROM bus WHERE driver_id = ?";
        $stmt_delete_bus = $conn->prepare($sql_delete_bus);
        $stmt_delete_bus->bind_param("i", $driver_id);
        $stmt_delete_bus->execute();
        $stmt_delete_bus->close();

        // Now, delete the driver
        $sql_delete_driver = "DELETE FROM driver WHERE driver_id = ?";
        $stmt_delete_driver = $conn->prepare($sql_delete_driver);
        $stmt_delete_driver->bind_param("i", $driver_id);
        $stmt_delete_driver->execute();
        $stmt_delete_driver->close();

        // Commit the transaction
        $conn->commit();

        // If deletion is successful, redirect back to the driver page
        header("Location: view_driver.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn->close();
} else {
    // If driver_id is not set or empty, redirect back to the delete driver page
    header("Location: delete_driver.php");
    exit();
}

?>
