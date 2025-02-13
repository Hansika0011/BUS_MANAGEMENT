<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Filter Data</h2>
    <form action="filter_data_process.php" method="post">
        <label for="students">
            <input type="checkbox" name="options[]" value="students" id="students"> Students
        </label>
        <label for="admin">
            <input type="checkbox" name="options[]" value="admin" id="admin"> Admin
        </label>
        <label for="driver">
            <input type="checkbox" name="options[]" value="driver" id="driver"> Driver
        </label>
        <!-- Add more checkboxes for additional options -->
        <br><br>
        <label for="city">City:</label>
        <select name="city" id="city">
            <option value="Guntur">Guntur</option>
            <option value="Vijayawada">Vijayawada</option>
            <!-- Add more cities as needed -->
        </select>
        <br><br>
        <input type="submit" value="Filter">
    </form>
</body>
</html>
