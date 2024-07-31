<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/formStyle.css">
    <style>
       
    </style>
</head>
<body>
    <div class="container">
        <h1 class="heading" >Students Details</h1>
        <ul class="nav">
            <li> <a href="viewAll.php"> View All Records </a> </li>
        </ul>
        <section>
            <h1>Add New Student</h1>
            <div class="stud-form">
               
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="text" name="roll" placeholder="Roll No." value="">
                    <input type="text" name="name" placeholder="Full Name" value="">
                    <input type="date" name="dob" value="">
                    <input type="text" maxlength="10" name="mobile" placeholder="Mobile" value="">

                    <input type="submit" value="Add Record" name="insert-button" >
                </form>
<?php
if(isset($_REQUEST['insert-button'])){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "project1";

    $roll = $_REQUEST['roll'];
    $name = $_REQUEST['name'];
    $dob = $_REQUEST['dob'];
    $mobile = $_REQUEST['mobile'];

    $conn = new mysqli($host, $user, $pass, $db);

    if($conn->connect_error){
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Check if roll number already exists
    $checkSql = $conn->prepare("SELECT roll FROM student WHERE roll = ?");
    $checkSql->bind_param("i", $roll);
    $checkSql->execute();
    $checkSql->store_result();

    if($checkSql->num_rows > 0){
        echo "<script>alert('Roll number already exists. Please use a different roll number.');</script>";
    } else {
        // Insert new record
        $sql = $conn->prepare("INSERT INTO student (roll, name, dob, mobile) VALUES (?, ?, ?, ?)");
        $sql->bind_param("isss", $roll, $name, $dob, $mobile);

        if($sql->execute()){
            echo "<script>alert('Record Inserted Successfully');</script>";
        } else {
            echo "<script>alert('Sorry, record was not inserted.');</script>";
        }

        $sql->close();
    }

    $checkSql->close();
    $conn->close();
}
?>

</div>
</section>
</div>
</body>

</html>

