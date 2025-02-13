<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>
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

        form {
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

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
            background-color: #2e3944;
            color: whitesmoke;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .button:hover {
            background-color: #212a31;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Admin</h2>
        
        <?php
        // Database connection details
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

        // Check if a driver ID is provided in the URL
        if (isset($_GET['admin_id']) && !empty($_GET['admin_id'])) {
            $admin_id = $_GET['admin_id'];

            // Prepare a select statement to fetch the driver details
            $sql = "SELECT * FROM admin WHERE admin_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $admin_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form action="update_admin_process.php" method="post">
    <input type="hidden" name="admin_id" value="<?php echo $row['admin_id']; ?>">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $row['a_first_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name" value="<?php echo $row['a_middle_name']; ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $row['a_last_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="drno">Door Number</label>
                <input type="text" id="drno" name="drno" value="<?php echo $row['a_drno']; ?>" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" value="<?php echo $row['a_location']; ?>" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php echo $row['a_city']; ?>" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" value="<?php echo $row['a_state']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="male" <?php if ($row['a_gender'] == 'male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if ($row['a_gender'] == 'female') echo 'selected'; ?>>Female</option>
                    <option value="other" <?php if ($row['a_gender'] == 'other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" id="designation" name="designation" value="<?php echo $row['a_designation']; ?>" required>
            </div>
            <button type="submit" class="button">Update Admin</button>
        </form>
        <?php
            } else {
                echo "No admin found with the provided ID.";
            }
        } else {
            echo "Admin ID is missing.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
