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

        // Prepare an SQL statement to insert contact info into the student_contact table
        $sql = "INSERT INTO student_contact (student_id, contact) VALUES (?, ?)";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $student_id, $contact);

        // Execute the statement
        if ($stmt->execute()) {
            // Insert email into student_email table
            $sql_email = "INSERT INTO student_email (student_id, email_id) VALUES (?, ?)";
            $stmt_email = $conn->prepare($sql_email);
            $stmt_email->bind_param("is", $student_id, $email);
            $stmt_email->execute();

            // If insertion is successful, redirect back to the view page
            header("Location: view_contact.php");
            exit();
        } else {
            // If an error occurs, display an error message
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // If student_id, contact, or email is not set or empty, redirect back to the previous page
        header("Location: add_student_contact.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student Contact</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Student Contact</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="student_id" value="<?php echo isset($_GET['student_id']) ? $_GET['student_id'] : ''; ?>">
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Submit</button>
        </form>
        <!-- Link back to the view page -->
        <a href="view_students.php">Back to View Students</a>
    </div>
</body>
</html>
