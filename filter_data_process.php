<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if city is selected
    if(isset($_POST["city"])) {
        $city = $_POST["city"];

        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = ""; // Assuming there's no password for your MySQL server
        $dbname = "bus";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Construct the SQL query based on selected options
        $options = isset($_POST["options"]) ? $_POST["options"] : [];
        $sql = "SELECT * FROM ";
        $tables = implode(", ", $options);
        $sql .= $tables;

        // Modify the SQL query to use the correct column name for the city condition
        if (in_array('students', $options)) {
            $sql .= " WHERE s_city = '$city'";
        } elseif (in_array('admin', $options)) {
            $sql .= " WHERE a_city = '$city'";
        } elseif (in_array('driver', $options)) {
            $sql .= " WHERE d_city = '$city'";
        }

        // Execute the SQL query
        $result = $conn->query($sql);

        // Check if query executed successfully
        if($result) {
            // Display the results in a table
            if ($result->num_rows > 0) {
                echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
                // Add table headers based on selected options
                echo "<tr>";
                foreach ($options as $option) {
                    echo "<th style='padding: 10px; text-align: left;'>$option</th>";
                }
                echo "</tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($options as $option) {
                        echo "<td style='padding: 10px;'>" . $row[$option] . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No data found for the selected options in $city";
            }
        } else {
            echo "Error: " . $conn->error;
        }

        // Close connection
        $conn->close();
    } else {
        echo "Please select a city.";
    }
}
?>
