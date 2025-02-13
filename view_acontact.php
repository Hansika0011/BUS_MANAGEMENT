<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Admin Contacts</title>
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
            margin-bottom: 20px;
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

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5e728b;
            color: whitesmoke;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-right: 10px; /* Add margin to the right of the button */
        }

        .btn:hover {
            background-color: #124e66;
        }

        /* Reduce width of the "Action" column */
        .action-column {
            width: 100px; /* Adjust the width as needed */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Info</h2>
        
        <table>
            <tr>
                <th>Admin ID</th>
                <th>Admin Name</th> <!-- Display Admin Name -->
                <th>Contact</th>
                <th class="action-column">Action</th> <!-- Added class to adjust width -->
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

            $sql = "SELECT ac.admin_id, a.a_first_name AS admin_name, ac.a_contact 
            FROM admincontact ac 
            INNER JOIN admin a ON ac.admin_id = a.admin_id"; // Joining admin and admincontact tables
    
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["admin_id"] . '</td>';
                    echo '<td>' . $row["admin_name"] . '</td>'; // Displaying admin first name
                    echo '<td>' . $row["a_contact"] . '</td>';
                    echo '<td><a href="admincontact.php?admin_id=' . $row["admin_id"] . '" class="btn">Update</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='4'>No admins found</td></tr>";
            }
            $conn->close();
            ?> 
        </table>
        
        <!-- Link back to the home page as a button -->
        <a href="home.html" class="btn">Back to Home</a>
        <a href="#" class="btn" onclick="history.back()" style="margin-left: 67%;">Back</a>

    </div>
</body>
</html>
