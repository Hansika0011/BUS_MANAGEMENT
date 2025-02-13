<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Admin</title>
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
        <h2>Delete Bus</h2>
        
        <form action="delete_bus_process.php" method="post">
            <div class="form-group">
                <label for="bus_id">Select Bus:</label>
                <select id="bus_id" name="bus_id">
                    <!-- PHP code to fetch bus records from database and populate the dropdown -->
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

                    // Fetch bus records from the database
                    $sql = "SELECT bus_id FROM bus";
                    $result = $conn->query($sql);

                    // Populate the dropdown with bus records
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="'. $row["bus_id"] . '">' . $row["bus_id"] . '</option>';
                        }
                    } else {
                        echo '<option value="">No buses found</option>';
                    }

                    // Close the connection
                    $conn->close();
                    ?>
                </select>
            </div>
            <button type="submit" class="button">Delete Bus</button>
            <a href="#" class="button" onclick="history.back()" style="margin-left: 73%;">Back</a>

        </form>
    </div>
</body>
</html>
