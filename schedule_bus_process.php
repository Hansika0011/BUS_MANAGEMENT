<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set and not empty
    if (!empty($_POST['schedule_id']) && !empty($_POST['admin_id']) && !empty($_POST['student_id']) && !empty($_POST['s_start_date']) && !empty($_POST['s_end_date'])) {
        // Retrieve data from the form
        $schedule_id = $_POST['schedule_id'];
        $admin_id = $_POST['admin_id'];
        $student_id = $_POST['student_id'];
        $s_start_date = $_POST['s_start_date'];
        $s_end_date = $_POST['s_end_date'];

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = ""; // Assuming there's no password for your MySQL server
        $dbname = "bus"; 

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        // Prepare and bind the update statement
        $sql = "UPDATE schedule SET schedule_id=?, admin_id=?, student_id=?, s_start_date=?, s_end_date=? WHERE schedule_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiisss", $schedule_id, $admin_id, $student_id, $s_start_date, $s_end_date, $schedule_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the view schedule page after successful update
            header("Location: view_schedule.php");
            exit(); // Exit to prevent further execution
        } else {
            // Error handling if the update fails
            echo "Error updating schedule details. Please try again later.";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Error message if any required field is empty
        echo "All fields are required!";
    }
} else {
    // Error message for invalid request method
    echo "Invalid request method!";
}
?>
