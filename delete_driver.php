<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Driver</title>
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
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #567981;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
          
        }

        .button:hover {
            background-color: #384e52;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Driver</h2>
        
        <form action="delete_driver_process.php" method="post">
            <div class="form-group">
                <label for="driver_id">Select Driver:</label>
                <select id="driver_id" name="driver_id">
                    <!-- PHP code to fetch driver records from database and populate the dropdown -->
                    <?php
                    // Database connection
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

                    // Fetch driver records from the database
                    $sql = "SELECT driver_id, CONCAT(d_first_name, ' ', d_middle_name, ' ', d_last_name) AS full_name FROM driver";
                    $result = $conn->query($sql);

                    // Populate the dropdown with driver records
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["driver_id"] . '">' . $row["full_name"] . '</option>';
                        }
                    } else {
                        echo '<option value="">No drivers found</option>';
                    }

                    // Close the connection
                    $conn->close();
                    ?>
                </select>
            </div>
            <button type="submit" class="button">Delete Driver</button>
            <a href="#" class="button" onclick="history.back()" style="margin-left: 73%;">Back</a>
        </form>
    </div>
</body>
</html>
