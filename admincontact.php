<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin Contact</title>
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

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2E3944;
            color: whitesmoke;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .button:hover {
            background-color: #212A31;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Update Admin Contact</h2>

<?php
// Check if admin_id is provided in the URL
if(isset($_GET['admin_id']) && !empty($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming there's no password for your MySQL server
    $dbname = "bus";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // SQL to select admin contact information
    $sql = "SELECT a_contact FROM admincontact WHERE admin_id = $admin_id";
    $result = $conn->query($sql);

    if ($result) {
        // Check if there is at least one row returned
        if ($result->num_rows > 0) {
            // Output form for updating contact info
            $row = $result->fetch_assoc();
?>
            <form action="admincontact_process.php" method="post">
                <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="a_contact" value="<?php echo $row['a_contact']; ?>" required>
                </div>
                <button type="submit" class="button">Update Contact</button>
            </form>
<?php
        } else {
            echo "No admin found with ID: " . $admin_id;
        }
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Admin ID not provided in the URL.";
}
?>
 <!-- Link back to the view admin contacts page -->
 <a href="view_acontact.php" class="button">Back</a>
    </div>
</body>
</html>
