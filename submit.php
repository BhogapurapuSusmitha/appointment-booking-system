<?php
// Database connection variables
$server = "localhost";
$username = "root";
$password = "";
$database = "appointmentSystem";

// Connect to MySQL server
$con = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data safely using POST
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';
$purpose = $_POST['purpose'] ?? '';

// Insert query
$sql = "INSERT INTO appointments (name, email, phone, appointment_date, appointment_time, purpose)
        VALUES ('$name', '$email', '$phone', '$date', '$time', '$purpose')";

// HTML & CSS output
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Appointment Confirmed</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #a8edea, #fed6e3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
        }
        h2 {
            color: #28a745;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        .back {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }
        .back:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>";

if (mysqli_query($con, $sql)) {
    echo "
    <div class='card'>
        <h2>✅ Thank you, $name! 🎉</h2>
        <p>Your appointment has been booked successfully.</p>
        <p>📅 <strong>Date:</strong> $date<br>
           ⏰ <strong>Time:</strong> $time<br>
           📞 <strong>We'll contact you at:</strong> $phone</p>
        <a class='back' href='index.html'>🔙 Book Another</a>
    </div>";
} else {
    echo "
    <div class='card'>
        <h2 style='color: red;'>❌ Error!</h2>
        <p>Something went wrong: " . mysqli_error($con) . "</p>
        <a class='back' href='index.html'>🔙 Try Again</a>
    </div>";
}

echo "</body></html>";

// Close connection
mysqli_close($con);
?>
