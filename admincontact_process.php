<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Assuming there's no password for your MySQL server
$dbname = "bus";

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if admin_id and a_contact are set and not empty
    if (isset($_POST['admin_id'], $_POST['a_contact']) && !empty($_POST['admin_id']) && !empty($_POST['a_contact'])) {
        // Retrieve admin_id and a_contact from the form
        $admin_id = $_POST['admin_id'];
        $a_contact = $_POST['a_contact'];

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare an SQL statement to update contact info in the admin_contact table
        $sql_contact = "UPDATE admincontact SET a_contact = ? WHERE admin_id = ?";
        
        // Prepare and bind the contact statement
        $stmt_contact = $conn->prepare($sql_contact);
        $stmt_contact->bind_param("si", $a_contact, $admin_id);

        // Execute the contact statement
        if ($stmt_contact->execute()) {
            // If update is successful, redirect to view_acontact.php
            header("Location: view_acontact.php");
            exit();
        } else {
            // If an error occurs, display an error message
            echo "Error: " . $stmt_contact->error;
        }

        // Close the statement and connection
        $stmt_contact->close();
        $conn->close();
    } else {
        // If admin_id or a_contact is not set or empty, redirect back to the previous page
        header("Location: admincontact.php?admin_id=" . $_POST['admin_id']);
        exit();
    }
} else {
    // If the form data is not submitted via POST method, redirect back to the previous page
    header("Location: admincontact.php?admin_id=" . $_POST['admin_id']);
    exit();
}
?>
