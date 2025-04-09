<?php
include 'cnncollection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM bills WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        echo "Bill deleted successfully";
    } else {
        echo "Error deleting record: " . $con->error;
    }
}

$con->close();
?>
