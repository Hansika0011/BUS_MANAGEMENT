<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"], .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2E3944;
            color: whitesmoke;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            border: none;
            outline: none;
        }

        button[type="submit"]:hover, .button:hover {
            background-color: #212a31;
        }

        .button-container {
            text-align: right;
        }

        .button-container button[type="submit"] {
            float: left;
        }
    </style>
</head>
<body>
    <h1>Add Payment Details</h1>
    <!-- Payment Details Form -->
    <form action="add_payment_process.php" method="post">
        <!-- Select student dropdown -->
        <label for="student_id">Select Student:</label>
        <select name="student_id" id="student_id" required>
            <?php
            // Include your database connection code here
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

            // Query to fetch student names and ids from the student table
            $sql = "SELECT student_id, CONCAT(s_first_name, ' ', s_middle_name, ' ', s_last_name) AS full_name FROM student";
            $result = $conn->query($sql);

            // Check if there are any students in the database
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["student_id"] . '">' . $row["full_name"] . ' (' . $row["student_id"] . ')</option>';
                }
            } else {
                echo '<option value="" disabled>No students available</option>';
            }

            // Close database connection
            $conn->close();
            ?>
        </select>
        
        <!-- Payment details fields -->
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" required>
        
        <label for="p_type">Type:</label>
        <input type="text" id="p_type" name="p_type" required>
        
        <label for="p_description">Description:</label>
        <input type="text" id="p_description" name="p_description" required>
        <!-- Other payment details fields -->
        
        <!-- Submit button for payment details -->
        <div class="button-container">
            <button type="submit" class="button">Submit Payment Details</button>
            <a href="#" class="button" onclick="history.back()">Back</a>
        </div>
    </form>
</body>
</html>
