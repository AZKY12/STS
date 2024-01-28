


<?php
// Connect to the database (replace with your database credentials)
$conn = new mysqli("99.000webhost.io", "id21828798_sts12", "126112512@Sts", "id21828798_sts12");


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
