<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "bus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['driver_id']) && !empty($_GET['driver_id'])) { 
    $driver_id = $_GET['driver_id'];

    $sql = "SELECT * FROM driver WHERE driver_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $driver_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Driver</title>
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

                .form-group input, .form-group select {
                    width: calc(100% - 16px);
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
                <h2>Update Driver</h2>
                <form action="update_driver_process.php" method="post">
                    <input type="hidden" name="driver_id" value="<?php echo $row['driver_id']; ?>">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo $row['d_first_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" value="<?php echo $row['d_middle_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="<?php echo $row['d_last_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="drno">Door Number</label>
                        <input type="text" id="drno" name="drno" value="<?php echo $row['d_drno']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" value="<?php echo $row['d_location']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" value="<?php echo $row['d_city']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" value="<?php echo $row['d_state']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="male" <?php if ($row['d_gender'] == 'male') echo 'selected'; ?>>Male</option>
                            <option value="female" <?php if ($row['d_gender'] == 'female') echo 'selected'; ?>>Female</option>
                            <option value="other" <?php if ($row['d_gender'] == 'other') echo 'selected'; ?>>Other</option>
                        </select>
                    </div>
                    <button type="submit" class="button">Update Driver</button>
                </form>
            </div>
        </body>
        </html>
<?php
    } else {
        echo "No driver found with the provided ID.";
    }
} else {
    echo "Driver ID is missing.";
}

// Close the database connection
$conn->close();
?>
