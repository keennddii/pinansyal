<?php
include('customassets/cnn/booking.php');


$bookings = fetchBookings(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking and Revenue Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>



<div class="container my-5">
    <h2>Bookings and Revenue Management</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Customer Name</th>
                <th>Booking Date</th>
                <th>Total Amount</th>
                <th>Revenue Generated</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the bookings array and display each booking
            if (!empty($bookings)) {
                foreach ($bookings as $booking) {
                    echo "<tr>
                            <td>{$booking['booking_id']}</td>
                            <td>{$booking['customer_name']}</td>
                            <td>{$booking['booking_date']}</td>
                            <td>{$booking['total_amount']}</td>
                            <td>{$booking['revenue_generated']}</td>
                            <td>{$booking['payment_status']}</td>
                            <td>
                                <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#paymentModal' data-booking-id='{$booking['booking_id']}'>Add Payment</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No bookings found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Add Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="asd.php" method="POST">
                    <input type="hidden" id="bookingId" name="bookingId">
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Payment Amount</label>
                        <input type="number" class="form-control" id="paymentAmount" name="paymentAmount" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Payment Method</label>
                        <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                            <option value="cash">Cash</option>
                            <option value="gcash">GCash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="credit_card">Credit Card</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Populate the Payment Modal with the selected booking ID
    var paymentModal = document.getElementById('paymentModal');
    paymentModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var bookingId = button.getAttribute('data-booking-id'); // Extract booking ID
        var bookingIdInput = paymentModal.querySelector('#bookingId');
        bookingIdInput.value = bookingId; // Set the booking ID in the form
    });
</script>

</body>
</html>
