<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Bus Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #2e3944;
            color: whitesmoke;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #212a31;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Bus Details</h2>
        
        <?php
        // Check if bus_id is provided in the URL
        if(isset($_GET['bus_id']) && !empty($_GET['bus_id'])) {
            $bus_id = $_GET['bus_id'];

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = ""; // Assuming there's no password for your MySQL server
            $dbname = "bus";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 

            // SQL to select bus details
            $sql = "SELECT * FROM bus WHERE bus_id = $bus_id";
            $result = $conn->query($sql);

            if ($result) {
                // Check if there is at least one row returned
                if ($result->num_rows > 0) {
                    // Fetch bus details
                    $row = $result->fetch_assoc();
                    ?>
                    <form action="update_bus_process.php" method="post">
                        <input type="hidden" name="bus_id" value="<?php echo $bus_id; ?>">
                        <div class="form-group">
                            <label for="admin_id">Admin ID:</label>
                            <input type="text" id="admin_id" name="admin_id" value="<?php echo $row['admin_id']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="driver_id">Driver ID:</label>
                            <input type="text" id="driver_id" name="driver_id" value="<?php echo $row['driver_id']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="b_route">Route:</label>
                            <input type="text" id="b_route" name="b_route" value="<?php echo $row['b_route']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="b_arrival_time">Arrival Time:</label>
                            <input type="text" id="b_arrival_time" name="b_arrival_time" value="<?php echo $row['b_arrival_time']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="b_departure_time">Departure Time:</label>
                            <input type="text" id="b_departure_time" name="b_departure_time" value="<?php echo $row['b_departure_time']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Bus" class="btn">
                        </div>
                    </form>
                    <?php
                } else {
                    echo "No bus found with ID: " . $bus_id;
                }
            } else {
                echo "Error: " . $conn->error;
            }
            $conn->close();
        } else {
            echo "Bus ID not provided in the URL.";
        }
        ?>
    <!-- </div> -->
</body>
</html>
