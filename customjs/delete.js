document.addEventListener("DOMContentLoaded", function () {
    // Get elements
    const deleteBtn = document.getElementById("deleteBtn");
    const employeeSelect = document.getElementById("employeeSelect");
    const confirmDelete = document.getElementById("confirmDelete");
    const payrollTable = document.getElementById("payrollTable").getElementsByTagName("tbody")[0];

    // Show modal and populate the select options
    deleteBtn.addEventListener("click", function () {
        // Clear previous options
        employeeSelect.innerHTML = "";

        // Loop through table rows and add them as options
        const rows = payrollTable.rows;
        for (let i = 0; i < rows.length; i++) {
            const name = rows[i].cells[1].innerText; // Get employee name from second column
            const option = document.createElement("option");
            option.value = i; // The index of the row
            option.textContent = name;
            employeeSelect.appendChild(option);
        }

        // Show the modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    });

    // Handle deletion
    confirmDelete.addEventListener("click", function () {
        const selectedRow = employeeSelect.value;
        payrollTable.deleteRow(selectedRow);

        // Hide modal after deletion
        const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        deleteModal.hide();
    });
});
