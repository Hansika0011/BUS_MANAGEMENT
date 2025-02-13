<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 750px; /* Reduced max-width of container */
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
            width: 100%; /* Set table width to 100% */
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 7px;
            column-gap: 40px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            /* text-align: left; */
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            width: 50%; /* Adjust width of data columns */
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
        }

        .btn:hover {
            background-color: #124e66;
        }
        .action-column {
            width: 15%; /* Adjust the width of the action column */
            padding: 5px; /* Adjust padding for the action column */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Conatct Info</h2>
        
        <table>
            <tr>
                <th>Driver ID</th>
                <th>Phone No</th>
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

            // SQL to select contact and email information from student_contact and student_email tables
            $sql = "SELECT driver_id, d_phoneno FROM drivercontact";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["driver_id"] . '</td>';
                    echo '<td>' . $row["d_phoneno"] . '</td>';
                    echo '<td><a href="udriver_contact.php?driver_id=' . $row["driver_id"] . '" class="btn">Update</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='3'>No students found</td></tr>"; // Fixed colspan value
            }
            $conn->close();
            ?> 
        </table>
        
        <!-- Link back to the home page as a button -->
        <a href="home.html" class="btn">Back to Home</a>
        <a href="#" class="btn" onclick="history.back()" style="margin-left: 68%;">Back</a> <!-- Corrected margin-left value -->

    </div>
</body>
</html>
