<?php
include_once 'config/database.php';

$conn = (new Database())->getConnection();

// Auto-generate Payment ID
function generatePaymentID($conn) {
    $prefix = "PAY-";
    $date = date("Ymd");
    $query = "SELECT COUNT(*) as count FROM core_payments WHERE DATE(date) = CURDATE()";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $row['count'] + 1;
    return $prefix . $date . "-" . str_pad($count, 3, "0", STR_PAD_LEFT);
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = $_POST['payment_id'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $date = $_POST['date'] ?? '';
    $reference_number = $_POST['reference_number'] ?? '';
    $customer_name = $_POST['customer_name'] ?? '';
    $payment_method = $_POST['payment_method'] ?? '';

    if ($payment_id && $amount && $date && $reference_number && $customer_name && $payment_method) {
        try {
            $query = "INSERT INTO core_payments (payment_id, amount, date, reference_number, customer_name, payment_method)
                      VALUES (:payment_id, :amount, :date, :reference_number, :customer_name, :payment_method)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':payment_id', $payment_id);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':reference_number', $reference_number);
            $stmt->bindParam(':customer_name', $customer_name);
            $stmt->bindParam(':payment_method', $payment_method);
            $stmt->execute();
            echo "<script>
                window.onload = () => {
                    Swal.fire('Success', 'Payment saved!', 'success').then(() => {
                        window.location.href = window.location.href;
                    });
                }
            </script>";
        } catch (Exception $e) {
            echo "<script>
                window.onload = () => {
                    Swal.fire('Error', '" . addslashes($e->getMessage()) . "', 'error');
                }
            </script>";
        }
    } else {
        echo "<script>
            window.onload = () => {
                Swal.fire('Warning', 'All fields are required.', 'warning');
            }
        </script>";
    }
}

$payments = [];
try {
    $stmt = $conn->prepare("SELECT * FROM core_payments ORDER BY date DESC");
    $stmt->execute();
    $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $message = "Fetch Error: " . $e->getMessage();
}
$generated_id = generatePaymentID($conn);
?>