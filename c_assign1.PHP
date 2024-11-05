<!DOCTYPE html>
<html>
<head>
<style>

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh;
}

nav {
            background-color: #000000;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
        }

form {
    margin: 100px; /* Adjust margin to create space from top */
    width: 300px; /* You can adjust the width as needed */
}

label {
    display: block;
    margin-bottom: 5px;
}
input[type="text"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type="submit"]:hover {
    background-color: #45a049;
}

input[type ="date"]{
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
}
body{
    background-color: #000000;
    background-size: cover;
}
p{
    color:#ffffff;
}
header {
    background-color: #4caf50;
    color: white;
    text-align: center;
    padding: 10px;
}
</style>
</head>
<body>

<div>

<?php
$conn = mysqli_connect("localhost","root","","sams");
if(isset($_POST['submit']))
{
    $a_topic = $_POST['topic'];
    $a_class = $_POST['class'];
    $a_sub = $_POST['sub'];
    $a_s_date = $_POST['s_date'];
    $a_e_date = $_POST['e_date'];

    $que = "INSERT INTO c_assign (a_topic, a_class, a_sub, a_s_date, a_e_date) VALUES ('$a_topic','$a_class','$a_sub','$a_s_date','$a_e_date')";
    if(mysqli_query($conn, $que)){
        echo  "<script>alert('Assignment created successfully'); window.location.href = 'mainpage.html';</script>";
    } else {
        echo "Error: " . $que . "<br>" . mysqli_error($conn);
    }
}
?>
<nav>
    <div>
        <a href="mainpage.html">Home</a>
        <a href="c_assign1.PHP">Create Assignments</a>
        <a href="view1.PHP">View Assignment</a>
        <a href="submitted.php">submitted</a>
    </div>
</nav>
<center>
<header>
    <h1>Student Assignment Management System</h1>
</header>
<br><br><br>
<div class="container">
    <form id="myForm" method='post' action=''>
        
        <input type="text" id="topic" name="topic" placeholder="Topic" required><br><br>
        
        <input type="text" id="subject" name="sub" placeholder="Subject" required><br><br>
        
        <select id="class" name="class" required>
            <option value="">Select a class</option>
            <option value="BSC MECS A">BSC MECS A</option>
            <option value="BSC MECS B">BSC MECS B</option>
            <option value="BSC MSCS A">BSC MSCS A</option>
            <option value="BSC MSCS B">BSC MSCS B</option>
            <option value="BSC MPCS A">BSC MPCS A</option>
            <option value="BSC MPCS B">BSC MPCS B</option>
            <option value="BSC HDS">BSC HDS</option>
        </select><br><br>
        
        <label for="start_date" style="color:#ffffff">Start Date:</label>
        <input type="date" id="start_date" name="s_date" required onchange="setMinEndDate()">
        
        <label for="end_date" style="color:#ffffff">End Date:</label>
        <input type="date" id="end_date" name="e_date" required><br><br>
        
        <input type="submit" name="submit" value="Submit" >
    </form>
</div>
</center>
</div>

<script>
function setMinEndDate() {
    var startDate = document.getElementById("start_date").value;
    document.getElementById("end_date").min = startDate;
}
</script>

</body>
</html>


