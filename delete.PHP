<?php
// Check if del parameter is set and numeric
if(isset($_GET['del']) && is_numeric($_GET['del'])) {
    $del_id = $_GET['del'];
    
    // Delete data from database based on the del_id
    $conn = mysqli_connect("localhost", "root", "", "sams");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = "DELETE FROM c_assign WHERE a_id = $del_id";
    mysqli_query($conn, $query);
    mysqli_close($conn);
    
    // Redirect back to the main page after deletion
    header("Location: view1.php");
    exit();
} else {
    // If del parameter is not set or not numeric, redirect back to the main page
    header("Location: index.php");
    exit();
}
?>
