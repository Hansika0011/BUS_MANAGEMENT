<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['bus_id']) && isset($_POST['admin_id']) && isset($_POST['driver_id']) && isset($_POST['b_route']) && isset($_POST['b_arrival_time']) && isset($_POST['b_departure_time'])) {
        // Retrieve data from the form
        $bus_id = $_POST['bus_id'];
        $admin_id = $_POST['admin_id'];
        $driver_id = $_POST['driver_id'];
        $b_route = $_POST['b_route'];
        $b_arrival_time = $_POST['b_arrival_time'];
        $b_departure_time = $_POST['b_departure_time'];

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = ""; // Assuming there's no password for your MySQL server
        $dbname = "bus"; 

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        // SQL to update bus details
        $sql = "UPDATE bus SET admin_id='$admin_id', driver_id='$driver_id', b_route='$b_route', b_arrival_time='$b_arrival_time', b_departure_time='$b_departure_time' WHERE bus_id='$bus_id'";

        if ($conn->query($sql) === TRUE) {
            header("Location: view_bus.php");
        } else {
            echo "Error updating bus details: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "All fields are required!";
    }
} else {
    echo "Invalid request method!";
}
?>