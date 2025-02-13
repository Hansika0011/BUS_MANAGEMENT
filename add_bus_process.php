<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set and not empty
    if (!empty($_POST['bus_id']) && !empty($_POST['driver_id']) && !empty($_POST['b_route']) && !empty($_POST['b_arrival_time']) && !empty($_POST['b_departure_time']) && !empty($_POST['s_start_date']) && !empty($_POST['s_end_date']) && !empty($_POST['redirect_option'])) {
        // Retrieve data from the form
        $bus_id = $_POST['bus_id'];
        $driver_id = $_POST['driver_id'];
        $b_route = $_POST['b_route'];
        $b_arrival_time = $_POST['b_arrival_time'];
        $b_departure_time = $_POST['b_departure_time'];
        $s_start_date = $_POST['s_start_date'];
        $s_end_date = $_POST['s_end_date'];
        $redirect_option = $_POST['redirect_option'];

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = ""; // Assuming there's no password for your MySQL server
        $dbname = "bus"; 

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        // Prepare and bind the insert statements for bus and schedule tables
        $sql_bus = "INSERT INTO bus (bus_id, driver_id, b_route, b_arrival_time, b_departure_time) VALUES (?, ?, ?, ?, ?)";
        $stmt_bus = $conn->prepare($sql_bus);
        $stmt_bus->bind_param("iisss", $bus_id, $driver_id, $b_route, $b_arrival_time, $b_departure_time);

        $sql_schedule = "INSERT INTO schedule (schedule_id, s_start_date, s_end_date) VALUES (?, ?, ?)";
        $stmt_schedule = $conn->prepare($sql_schedule);
        $stmt_schedule->bind_param("iss", $bus_id, $s_start_date, $s_end_date);

        // Execute the statements
        $bus_inserted = $stmt_bus->execute();
        $schedule_inserted = $stmt_schedule->execute();

        if ($bus_inserted && $schedule_inserted) {
            // Choose the redirection based on user input
            if ($redirect_option == 'view_bus') {
                header("Location: view_bus.php");
            } elseif ($redirect_option == 'view_schedule') {
                header("Location: view_schedule.php");
            } else {
                // Redirect to a default page if the option is not recognized
                header("Location: add_bus.php");
            }
            exit(); // Exit to prevent further execution
        } else {
            // Error handling if the insertion fails
            echo "Error inserting data: " . $conn->error;
        }

        // Close the statements and connection
        $stmt_bus->close();
        $stmt_schedule->close();
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
