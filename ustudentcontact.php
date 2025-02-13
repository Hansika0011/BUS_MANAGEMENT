<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Contact</title>
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
            background-color: #2e3944;
            color: whitesmoke;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .button:hover {
            background-color: #212a31;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Update Student Contact</h2>
        <?php
        // Check if student_id is provided in the URL
        if(isset($_GET['student_id']) && !empty($_GET['student_id'])) {
            $student_id = $_GET['student_id'];

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = ""; // Assuming there's no password for your MySQL server
            $dbname = "bus";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 

            // SQL to select student contact information from both tables
            $sql = "SELECT student_contact.contact, student_email.email_id 
                    FROM student_contact 
                    INNER JOIN student_email ON student_contact.student_id = student_email.student_id
                    WHERE student_contact.student_id = $student_id";
            $result = $conn->query($sql);

            if ($result) {
                // Check if there is at least one row returned
                if ($result->num_rows > 0) {
                    // Output form for updating contact info
                    $row = $result->fetch_assoc();
                    ?>
                    <form action="ustudentcontact_process.php" method="post">
                        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                        <div class="form-group">
                            <label for="contact">Contact:</label>
                            <input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $row['email_id']; ?>" required>
                        </div>
                        <button type="submit" class="button">Update Contact</button>
                    </form>
                    <?php
                } else {
                    echo "No student found with ID: " . $student_id;
                }
            } else {
                echo "Error: " . $conn->error;
            }
            $conn->close();
        } else {
            echo "Student ID not provided in the URL.";
        }
        ?>

        <!-- Link back to the home page as a button -->
        <a href="view_contact.php" class="button">Back</a>
    </div>
</body>
</html>
