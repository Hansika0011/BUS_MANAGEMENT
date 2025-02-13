<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Admin</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        /* Style for the button */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #5e728b;
            color: whitesmoke;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        /* Hover effect */
        .btn:hover {
            background-color: #124e66;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Info</h2>
        
        <table>
            <tr>
                <th>Admin ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = ""; // Assuming there's no password for your MySQL server
            $dbname = "bus"; 

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 

            // SQL to select all drivers
            $sql = "SELECT * FROM admin";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["admin_id"] . '</td>';
                    echo '<td>' . $row["a_first_name"] . ' ' . $row["a_middle_name"] . ' ' . $row["a_last_name"] . '</td>';
                    echo '<td>' . $row["a_drno"] . ', ' . $row["a_location"] . ', ' . $row["a_city"] . ', ' . $row["a_state"] . '</td>';
                    echo '<td>' . $row["a_gender"] . '</td>';
                    echo '<td>' . $row["a_designation"] . '</td>';
                    echo '<td><a href="update_admin.php?admin_id=' . $row["admin_id"] . '" class="btn"">Update</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='5'>No admins found</td></tr>";
            }
            $conn->close();
            ?> 
        </table>
        
        <!-- Link back to the home page as a button -->
        <a href="home.html" class="btn">Back to Home</a>
        <a href="#" class="btn" onclick="history.back()" style="margin-left: 70%;">Back</a>

    </div>
</body>
</html>
