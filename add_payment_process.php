<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['student_id']) && !empty($_POST['student_id'])) {
        $student_id = $_POST['student_id'];
        $amount = $_POST['amount'];
        $date = date("Y-m-d");
        $type = $_POST['p_type']; 
        $description = $_POST['p_description']; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if a payment for the selected student already exists
        $check_sql = "SELECT * FROM payment WHERE student_id = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("i", $student_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // Update the existing payment details
            $update_sql = "UPDATE payment SET amount = ?, p_date = ?, p_type = ?, p_description = ? WHERE student_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("dsssi", $amount, $date, $type, $description, $student_id);
            if ($update_stmt->execute()) {
                header("Location: view_payment.php");
                exit();
            } else {
                echo "Error updating payment: " . $update_stmt->error;
            }
        } else {
            // Insert a new payment
            $insert_sql = "INSERT INTO payment (student_id, amount, p_date, p_type, p_description) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("idsss", $student_id, $amount, $date, $type, $description);
            if ($insert_stmt->execute()) {
                header("Location: view_payment.php");
                exit();
            } else {
                echo "Error inserting payment: " . $insert_stmt->error;
            }
        }

        $check_stmt->close();
        $update_stmt->close();
        $insert_stmt->close();
        $conn->close();
    } else {
        header("Location: add_payment.php");
        exit();
    }
} else {
    header("Location: add_payment.php");
    exit();
}
?>
