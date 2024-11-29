<?php 
include("user.php");
$sql = "SELECT * FROM tbl_pinansyal_acc";
$result = mysqli_query($con, $sql);

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM tbl_pinansyal_acc WHERE employee_id = ?";
    
    // Create a prepared statement
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $employee_id); 

    
    if (mysqli_stmt_execute($stmt)) {
        
        $_SESSION['message'] = "Record deleted successfully.";
        header("Location: /pinansyal/adminacc.php");
        exit();
    } else {
       
        echo "Error deleting record: " . mysqli_error($con);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Fullname = mysqli_real_escape_string($con, $_POST['Fullname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $position = mysqli_real_escape_string($con, $_POST['position']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO tbl_pinansyal_acc (Fullname, username, position, password) VALUES ('$Fullname', '$username', '$position', '$password')";

    if (mysqli_query($con, $sql)) {
        $_SESSION['message'] = "New Employee Account Added Successfully!";
        header("Location: adminacc.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}


// Close the database connection
mysqli_close($con);


