function approveExpense(button) {
    const row = button.parentNode.parentNode;
    row.cells[4].innerText = 'Approved';
    button.disabled = true;
}

function rejectExpense(button) {
    const row = button.parentNode.parentNode;
    row.cells[4].innerText = 'Rejected';
    button.disabled = true;
}

function addExpense() {
    alert("Redirecting to the add new expense form.");
    // Here you can implement redirection to a form page or modal
}
