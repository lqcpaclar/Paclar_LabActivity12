<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Form</title>
</head>
<body>
<style>
    {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
   body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
            background-image: url('https://wallpapercave.com/wp/wp5824693.jpg'); 
            background-size: cover;
            background-position: center;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
          
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: inherit;
            filter: blur(1.5px); 
            z-index: -1; 
            background-size: cover;
            background-position: center;
        }

        .container{
            max-width: 500px;
            margin: 60px;
            margin-left: auto; 
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-size: cover;
            background-position: center;
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
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "paclar";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addInformation($conn, $fullname, $age, $address, $contact) {
   
    if(strlen($age) > 10) { // Adjust the maximum length as per your database schema
        echo "Error: Age is too long.";
        return;
    }
    
    $sql = "INSERT INTO information (fullname, age, address, contact) VALUES ('$fullname', '$age', '$address', '$contact')";
    if ($conn->query($sql) === TRUE) {
        echo "New information added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['add_information'])) {
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];

    addInformation($conn, $fullname, $age, $address, $contact);
    header("Location: paclar.php");
    exit();
}
?>

<div class="container">

    <div class="form-container form-animation">
        <form method="post" action="paclar.php">
            <input type="text" name="fullname" placeholder="FullName"><br>
            <input type="text" name="age" placeholder="Age"><br>
            <input type="text" name="address" placeholder="Address"><br>
            <input type="text" name="contact" placeholder="Contact"><br>
            <button type="submit" name="add_information">Add information</button>
        </form>
    </div>

    <?php
    echo '<div class="table-container table-animation">';
    echo '<table>';
    echo '<tr>';
    echo '<th>FullName</th>';
    echo '<th>Age</th>';
    echo '<th>Address</th>';
    echo '<th>Contact</th>';
    echo '<th>Actions</th>'; 
    echo '</tr>';

    $result = $conn->query("SELECT * FROM information");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['fullname'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . $row['address'] . '</td>';
            echo '<td>' . $row['contact'] . '</td>';
    

            echo '<td>';
            echo '<form method="post" action="edit_information.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="edit_information">Edit</button>';
            echo '</form>';
            echo '<form method="post" action="delete_information.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="delete_information">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
    }

    echo '</table>';
    echo '</div>';
    ?>
</div>


<?php $conn->close(); ?>