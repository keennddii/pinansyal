document.addEventListener("DOMContentLoaded", function () {
    fetchBills(); // Load bills from the database when the page loads
});

function fetchBills() {
    fetch("customassets/collection/fetch_bills.php")
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("billTable").innerHTML = data;
        })
        .catch((error) => console.error("Error fetching bills:", error));
}

function toggleForm() {
    let formContainer = document.getElementById("billFormContainer");
    formContainer.style.display = formContainer.style.display === "none" ? "block" : "none";
}


//Delete a bill
let invoiceNo = null;

function confirmDelete(invoiceNoParam) {
  invoiceNo = invoiceNoParam;
  const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
  deleteModal.show();
}

document.getElementById('confirmDelete').addEventListener('click', function() {
  if (invoiceNo !== null) {
    // Send the invoice_no via POST request for deletion
    fetch('customassets/collection/delete_bill.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `invoice_no=${invoiceNo}` // <-- sends invoice_no value to PHP
    })
    .then(response => response.text())
    .then(data => {
      console.log('Response:', data);
      location.reload();  // Reload the page after successful delete
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }
});




// Edit a bill (prefill the form with existing data)
let editId = null;

function openEditModal(id, clientName, invoiceNo, amount, paymentMethod, paymentDate, status, remarks) {
  editId = id;
  document.getElementById('editClientName').value = clientName;
  document.getElementById('editAmount').value = amount;
  document.getElementById('editPaymentMethod').value = paymentMethod;
  document.getElementById('editPaymentDate').value = paymentDate;
  document.getElementById('editStatus').value = status;
  document.getElementById('editRemarks').value = remarks;

  // Remove the invoice_no from the modal as it is not editable
  // (No need to show it in the modal because it's not part of the form anymore)
  document.getElementById('editInvoiceNo').value = invoiceNo;  // Keep the invoice number, but do not include in the update request.

  const editModal = new bootstrap.Modal(document.getElementById('editModal'));
  editModal.show();
}

document.getElementById('saveEditBtn').addEventListener('click', function() {
  if (editId !== null) {
    const clientName = document.getElementById('editClientName').value;
    const amount = document.getElementById('editAmount').value;
    const paymentMethod = document.getElementById('editPaymentMethod').value;
    const paymentDate = document.getElementById('editPaymentDate').value;
    const status = document.getElementById('editStatus').value;
    const remarks = document.getElementById('editRemarks').value;

    fetch('customassets/collection/update_bill.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `id=${editId}&client_name=${encodeURIComponent(clientName)}&amount=${amount}&payment_method=${encodeURIComponent(paymentMethod)}&payment_date=${paymentDate}&status=${encodeURIComponent(status)}&remarks=${encodeURIComponent(remarks)}`
    })
    .then(response => response.text())
    .then(data => {
      console.log('Update response:', data);
      location.reload(); // Reload the page to show updated data
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }
});

