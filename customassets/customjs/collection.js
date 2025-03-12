document.addEventListener("DOMContentLoaded", function () {
    fetchBills(); // Load bills from the database when the page loads
});

function fetchBills() {
    fetch("customassets/cnn/fetch_bills.php")
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

// Handle form submission
document.getElementById("billForm").addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("customassets/cnn/add_bill.php", {
        method: "POST",
        body: formData,
    })
    .then((response) => response.text())
    .then((message) => {
        alert(message);
        fetchBills(); // Refresh the table with updated data
        document.getElementById("billForm").reset();
        toggleForm();
    })
    .catch((error) => console.error("Error adding bill:", error));
});

// Delete a bill
function deleteBill(id) {
    if (!confirm("Are you sure you want to delete this bill?")) return;

    fetch("customassets/cnn/delete_bill.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${id}`,
    })
    .then((response) => response.text())
    .then((message) => {
        alert(message);
        fetchBills(); // Refresh the table after deletion
    })
    .catch((error) => console.error("Error deleting bill:", error));
}

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
