<?php
include 'customassets/AP/cnnpayable.php'; 

$query = "SELECT * FROM payable_requests WHERE status = 'Pending'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="submit_payable_request.php" method="POST">
    <label for="payee">Payee:</label>
    <input type="text" id="payee" name="payee" required>
    
    <label for="amount">Amount:</label>
    <input type="number" id="amount" name="amount" required>
    
    <label for="due_date">Due Date:</label>
    <input type="date" id="due_date" name="due_date" required>
    
    <label for="department_id">Department:</label>
    <select id="department_id" name="department_id">
        <!-- Populate with departments -->
    </select>

    <label for="account_id">Account:</label>
    <select id="account_id" name="account_id">
        <!-- Populate with accounts -->
    </select>
    
    <label for="remarks">Remarks:</label>
    <textarea id="remarks" name="remarks"></textarea>
    
    <button type="submit">Submit Request</button>
</form>
<h3>Pending Payable Requests</h3>
<table>
    <thead>
        <tr>
            <th>Payee</th>
            <th>Amount</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['payee']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['due_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="approve_request.php?id=<?php echo $row['id']; ?>">Approve</a> | 
                <a href="reject_request.php?id=<?php echo $row['id']; ?>">Reject</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>