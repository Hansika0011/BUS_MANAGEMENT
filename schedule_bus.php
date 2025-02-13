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
            background-color: #212A31;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Schedule</h2>
        
        <?php
        // Check if schedule_id is provided in the URL
        if(isset($_GET['schedule_id']) && !empty($_GET['schedule_id'])) {
            $schedule_id = $_GET['schedule_id'];

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = ""; // Assuming there's no password for your MySQL server
            $dbname = "bus";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 

            // Prepare a statement
            $sql = "SELECT * FROM schedule WHERE schedule_id = ?";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("i", $schedule_id);

            // Execute the statement
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="Schedule_bus_process.php" method="post">
                    <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>">
                    <div class="form-group">
                        <label for="admin_id">Admin ID:</label>
                        <input type="text" id="admin_id" name="admin_id" value="<?php echo $row['admin_id']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="student_id">Student ID:</label>
                        <input type="text" id="student_id" name="student_id" value="<?php echo $row['student_id']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="s_start_date">Start date:</label>
                        <input type="text" id="s_start_date" name="s_start_date" value="<?php echo $row['s_start_date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="s_end_date">End date:</label>
                        <input type="text" id="s_end_date" name="s_end_date" value="<?php echo $row['s_end_date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update Schedule" class="btn">
                    </div>
                </form>
                <?php
            } else {
                echo "No Schedule found with ID: " . $schedule_id;
            }
            $stmt->close();
            $conn->close();
        } else {
            echo "Schedule ID not provided in the URL.";
        }
        ?>
    </div>
</body>
</html>
