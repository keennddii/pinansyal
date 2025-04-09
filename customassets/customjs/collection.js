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




// Delete a bill
let deleteBillId = null;

function deleteBill(id) {
    deleteBillId = id; // Store the ID for confirmation
    let deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
    deleteModal.show();
}

// Handle actual deletion when user confirms
document.getElementById("confirmDelete").addEventListener("click", function () {
    if (deleteBillId) {
        fetch("customassets/collection/delete_bill.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id=${deleteBillId}`,
        })
        .then((response) => response.text())
        .then((message) => {
            showToast("✔ Bill deleted successfully!"); // Show success toast
            fetchBills(); // Refresh table
        })
        .catch((error) => console.error("Error deleting bill:", error));
        
        let deleteModal = bootstrap.Modal.getInstance(document.getElementById("deleteModal"));
        deleteModal.hide();
        deleteBillId = null;
    }
});



// Edit a bill (prefill the form with existing data)
function editBill(id, billType, amount, dueDate, status, remarks) {
    document.getElementById("billType").value = billType;
    document.getElementById("amount").value = amount;
    document.getElementById("dueDate").value = dueDate;
    document.getElementById("status").value = status;
    document.getElementById("remarks").value = remarks;

    // Add hidden input to store the ID of the bill being edited
    let form = document.getElementById("billForm");
    let hiddenInput = document.getElementById("editId");
    
    if (!hiddenInput) {
        hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.id = "editId";
        hiddenInput.name = "id";
        form.appendChild(hiddenInput);
    }
    
    hiddenInput.value = id;

    toggleForm();
}

// Search functionality
document.getElementById("search").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#billTable tr");

    rows.forEach((row) => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});

function openModal() {
    document.getElementById('collectionModal').classList.remove('hidden');
  }
  function closeModal() {
    document.getElementById('collectionModal').classList.add('hidden');
  }