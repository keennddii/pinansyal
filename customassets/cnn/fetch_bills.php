<?php
include 'cnncollection.php';

$sql = "SELECT * FROM bills ORDER BY due_date ASC";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['bill_type']}</td>
                <td>{$row['amount']}</td>
                <td>{$row['due_date']}</td>
                <td>{$row['status']}</td>
                <td>{$row['remarks']}</td>
                <td>
                    <button class='btn btn-warning btn-sm' onclick='editBill({$row['id']})'>Edit</button>
                    <button class='btn btn-danger btn-sm' onclick='deleteBill({$row['id']})'>Delete</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found.</td></tr>";
}

$con->close();
?>
