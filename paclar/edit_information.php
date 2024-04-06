<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <style>
        html {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
            background-image: url('https://wallpapercave.com/wp/wp5824693.jpg'); 
            background-size: cover;
            background-position: cover;
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; 
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://wallpapercave.com/wp/wp5824693.jpg');
            filter: blur(1.5px); 
            z-index: -1; 
            background-size: cover;
            background-position: center;
        }

        .container {
            max-width: 500px;
            margin: 0 20px; /* Adjust margin as needed */
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #ff4d4d;
            margin-top: 20px;
            font-size: 24px;
        }

        input[type="text"],
        input[type="email"],
        button {
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f7f7f7;
            color: #333;
        }

        button {
            background-color: #ff4d4d;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e63e3e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
            font-size: 16px;
            color: #333;
        }

        th {
            background-color: #ff4d4d;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        button {
            padding: 8px 16px;
            margin-right: 8px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 14px;
            color: #fff;
        }

        button.edit {
            background-color: #4CAF50;
        }

        button.delete {
            background-color: #DC3545;
        }

        button:hover {
            background-color: #ff3333;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "paclar";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['edit_information'])) {
    $id = $_POST['id'];

    // Fetch the employee data based on the ID
    $result = $conn->query("SELECT * FROM information WHERE id = $id");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
       
        echo '<div class="container">';
        echo '<form method="post" action="update_information.php">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="text" name="fullname" value="' . $row['fullname'] . '" placeholder="Full Name"><br>';
        echo '<input type="text" name="age" value="' . $row['age'] . '" placeholder="Age"><br>';
        echo '<input type="text" name="address" value="' . $row['address'] . '" placeholder="Address"><br>';
        echo '<input type="text" name="contact" value="' . $row['contact'] . '" placeholder="Contact"><br>';
        echo '<button type="submit" name="update_information">Update</button>';
        echo '</form>';
        echo '</div>';
    } else {
        echo 'Information not found.';
    }
}

$conn->close();
?>
</body>
</html>
