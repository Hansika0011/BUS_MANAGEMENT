<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bus and Schedule Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Increased specificity for the .button selector */
        form .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2E3944;
            color: whitesmoke;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .button:hover {
            background-color: #212a31;
        }

        /* Styling for redirection option dropdown */
        select#redirect_option {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px; /* Change border color to match button color */
            border-radius: 5px;
            box-sizing: border-box;
            color: black; /* Text color */
            appearance: none; /* Remove default arrow */
        }

        select#redirect_option option {
            color: black; /* Text color */
        }

        /* Adjust margin for buttons */
        .button-left {
            margin-right: 10px;
        }

        .button-right {
            float: right;
        }
    </style>
</head>
<body>
    <h1>Add Bus and Schedule Details</h1>
    <!-- Bus and Schedule Details Form -->
    <form action="add_bus_process.php" method="post">
        <!-- Bus ID input field -->
        <label for="bus_id">Bus ID:</label>
        <input type="text" id="bus_id" name="bus_id" required>
        
        <!-- Bus details fields -->
        <label for="driver_id">Driver ID:</label>
        <input type="text" id="driver_id" name="driver_id" required>
        <label for="b_route">Route:</label>
        <input type="text" id="b_route" name="b_route" required>
        <label for="b_arrival_time">Arrival Time:</label>
        <input type="text" id="b_arrival_time" name="b_arrival_time" required>
        <label for="b_departure_time">Departure Time:</label>
        <input type="text" id="b_departure_time" name="b_departure_time" required>
        
        <!-- Schedule details fields -->
        <label for="s_start_date">Start Date:</label>
        <input type="text" id="s_start_date" name="s_start_date" required>
        <label for="s_end_date">End Date:</label>
        <input type="text" id="s_end_date" name="s_end_date" required>
        
        <!-- Additional field for redirection option -->
        <label for="redirect_option"></label>
        <select name="redirect_option" id="redirect_option" required>
            <option value="view_bus">View Bus</option>
            <option value="view_schedule">View Schedule</option>
        </select>
        
        <!-- Submit button for bus and schedule details -->
        <button type="submit" class="button button-left">Submit</button>
        <a href="#" class="button button-right" onclick="history.back()">Back</a>
    </form>
</body>
</html>
