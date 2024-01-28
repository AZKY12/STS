<?php
$servername = getenv('localhost');
$username = getenv('id19785199_id19785199_kss2');
$password = getenv('126112512@Ks2');
$dbname = getenv('id19785199_sts');
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process Device Exchange Form
    if (isset($_POST['action']) && $_POST['action'] == 'exchange') {
        $deviceName = $_POST['deviceName'];
        $deviceCondition = $_POST['deviceCondition'];
        $deviceDescription = $_POST['deviceDescription'];
        $devicePrice = $_POST['devicePrice'];

        // Insert data into the database
        $sql = "INSERT INTO devices (deviceName, deviceCondition, deviceDescription, devicePrice) VALUES ('$deviceName', '$deviceCondition', '$deviceDescription', '$devicePrice')";
        
        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully
            echo "Device data inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    $result = $conn->query("SELECT * FROM devices");

    if ($result === false) {
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["deviceName"] . '</h5>';
                echo '<p class="card-text">Condition: ' . $row["deviceCondition"] . '</p>';
                echo '<p class="card-text">Description: ' . $row["deviceDescription"] . '</p>';
                echo '<p class="card-text">Price: $' . $row["devicePrice"] . '</p>';
                echo '</div></div></div>';
            }
        } else {
            echo "0 results";
        }
    }


    }

// Close the database connection
$conn->close();
?>