<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost"; // Change this if your database is hosted elsewhere
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "sams";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from form
    $edit_id = $_POST['edit_id'];
    $topic = $_POST['topic']; 
    $class = $_POST['class']; 
    $subject = $_POST['subject']; 
    $start_date = $_POST['s_date']; 
    $end_date = $_POST['e_date']; 

    // SQL query to update data
    $sql = "UPDATE c_assign SET a_topic='$topic', a_class='$class', a_sub='$subject', a_s_date='$start_date', a_e_date='$end_date' WHERE a_id=$edit_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Redirect to view page after update
    header("Location: view1.php");
    exit();

}
?>
