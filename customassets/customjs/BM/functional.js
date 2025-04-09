// Budget Data Array
let budgets = [];
let currentPage = 1;
const rowsPerPage = 5;

// Open Modal to Add New Budget
function openAddBudgetModal() {
  const modal = new bootstrap.Modal(document.getElementById('addBudgetModal'));
  document.getElementById('addBudgetForm').reset();
  modal.show();
}

// Save New Budget
function saveNewBudget() {
  const date = document.getElementById('budgetDate').value;
  const id = document.getElementById('budgetID').value.trim();
  const department = document.getElementById('budgetDepartment').value.trim();
  const amount = parseFloat(document.getElementById('budgetAmount').value);
  const status = document.getElementById('budgetStatus').value;

  // Validate form fields
  if (!date || !id || !department || isNaN(amount) || !status) {
    showToast('Please fill out all fields correctly.', 'danger');
    return; // Prevent modal from closing if validation fails
  }

  // Show loading spinner
  showLoading();

  // Push the new budget data to the budgets array
  budgets.push({ date, id, department, amount, status });

  // Simulate saving (replace with actual save logic)
  setTimeout(() => {
    // Hide loading spinner after the "add" operation
    hideLoading();

    // Update table and overview
    updateBudgetTable();
    updateBudgetOverview();

    // Close the modal
    bootstrap.Modal.getInstance(document.getElementById('addBudgetModal')).hide();

    // Show success toast
    showToast('Budget successfully added!', 'success');
  }, 2000); // Simulate 2 seconds delay
}

// Update Budget Table
function updateBudgetTable() {
  const tbody = document.getElementById('budgetTableBody');
  tbody.innerHTML = '';

  const filtered = getFilteredBudgets();
  const paginated = paginate(filtered, currentPage, rowsPerPage);

  if (paginated.length === 0) {
    tbody.innerHTML = '<tr><td colspan="6" class="text-center">No data found.</td></tr>';
  } else {
    paginated.forEach(budget => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${budget.date}</td>
        <td>${budget.id}</td>
        <td>${budget.department}</td>
        <td>₱${budget.amount.toLocaleString()}</td>
        <td><span class="badge bg-${getStatusColor(budget.status)}">${capitalize(budget.status)}</span></td>
        <td>
          <button class="btn btn-sm btn-danger" onclick="deleteBudgetModal('${budget.id}')">Delete</button>
        </td>
      `;
      tbody.appendChild(row);
    });
  }

  renderPagination(filtered.length);
}

// Get Filtered Budgets
function getFilteredBudgets() {
  const search = document.getElementById('searchBudget').value.toLowerCase();
  const filterStatus = document.getElementById('filterBudgetStatus').value;

  return budgets.filter(b => {
    const matchesSearch = b.id.toLowerCase().includes(search) || b.department.toLowerCase().includes(search);
    const matchesStatus = !filterStatus || b.status === filterStatus;
    return matchesSearch && matchesStatus;
  });
}

// Pagination Logic
function paginate(items, page, perPage) {
  const start = (page - 1) * perPage;
  return items.slice(start, start + perPage);
}

// Render Pagination Buttons
function renderPagination(totalItems) {
  const pagination = document.getElementById('budgetPaginationControls');
  pagination.innerHTML = '';
  const totalPages = Math.ceil(totalItems / rowsPerPage);

  for (let i = 1; i <= totalPages; i++) {
    const li = document.createElement('li');
    li.className = `page-item ${currentPage === i ? 'active' : ''}`;
    li.innerHTML = `<button class="page-link" onclick="goToPage(${i})">${i}</button>`;
    pagination.appendChild(li);
  }
}

function goToPage(page) {
  currentPage = page;
  updateBudgetTable();
}

// Filter Budgets (Search or Status)
function filterBudget() {
  currentPage = 1;
  updateBudgetTable();
}

// Export to Excel
function exportToExcel() {
  let csvContent = "data:text/csv;charset=utf-8,Date,Budget ID,Department,Amount,Status\n";
  budgets.forEach(b => {
    csvContent += `${b.date},${b.id},${b.department},${b.amount},${b.status}\n`;
  });

  const encodedUri = encodeURI(csvContent);
  const link = document.createElement('a');
  link.setAttribute('href', encodedUri);
  link.setAttribute('download', 'budget_data.csv');
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  showToast('Exported to Excel.', 'success');
}

// Export to PDF (Simple Print)
function exportToPDF() {
  window.print();
  showToast('Triggered browser print (PDF Export).', 'info');
}

// Update Overview Cards
function updateBudgetOverview() {
  const total = budgets.reduce((sum, b) => sum + b.amount, 0);
  const allocated = budgets.filter(b => b.status === 'allocated').reduce((sum, b) => sum + b.amount, 0);
  const remaining = budgets.filter(b => b.status === 'remaining').reduce((sum, b) => sum + b.amount, 0);

  document.getElementById('totalBudget').innerText = `₱${total.toLocaleString()}`;
  document.getElementById('allocatedBudget').innerText = `₱${allocated.toLocaleString()}`;
  document.getElementById('remainingBudget').innerText = `₱${remaining.toLocaleString()}`;
}

// Helpers
function getStatusColor(status) {
  switch (status) {
    case 'allocated': return 'primary';
    case 'spent': return 'danger';
    case 'remaining': return 'warning';
    default: return 'secondary';
  }
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

// Toast Notification with Icons
function showToast(message, type = 'success') {
  const toast = document.createElement('div');
  toast.className = `toast align-items-center text-bg-${type} border-0 show shadow-sm rounded-3 p-3`;
  toast.style.position = 'fixed';
  toast.style.top = '20px';  // Position sa top
  toast.style.right = '20px'; // Position sa right
  toast.style.zIndex = 9999;
  toast.style.minWidth = '300px';
  toast.style.maxWidth = '350px';
  toast.style.marginTop = '10px'; // Space between toasts
  
  let icon;
  if (type === 'success') {
    icon = '<i class="fas fa-check-circle"></i>'; // Success icon
  } else if (type === 'error') {
    icon = '<i class="fas fa-times-circle"></i>'; // Error icon
  } else if (type === 'info') {
    icon = '<i class="fas fa-info-circle"></i>'; // Info icon
  } else if (type === 'warning') {
    icon = '<i class="fas fa-exclamation-circle"></i>'; // Warning icon
  }

  toast.innerHTML = `
    <div class="d-flex align-items-center">
      <div class="toast-body fs-6">
        ${icon} <span class="ms-2">${message}</span>
      </div>
      <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast" onclick="this.parentElement.parentElement.remove();"></button>
    </div>
  `;
  
  document.body.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 3000);
}

// Show Loading Spinner
function showLoading() {
  // Hide the Add Budget Modal if it's open
  const addBudgetModal = bootstrap.Modal.getInstance(document.getElementById('addBudgetModal'));
  if (addBudgetModal) {
    addBudgetModal.hide();
  }

  // Show the Money Spinner and hide the default spinner
  document.getElementById('moneySpinner').classList.remove('d-none');
  document.getElementById('loadingSpinner').classList.remove('d-none');
}

// Hide Loading Spinner
function hideLoading() {
  // Hide the Money Spinner and show the default spinner again
  document.getElementById('moneySpinner').classList.add('d-none');
  document.getElementById('loadingSpinner').classList.add('d-none');
}

// Add Budget (With Loading State)
function saveNewBudget() {
  const date = document.getElementById('budgetDate').value;
  const id = document.getElementById('budgetID').value.trim();
  const department = document.getElementById('budgetDepartment').value.trim();
  const amount = parseFloat(document.getElementById('budgetAmount').value);
  const status = document.getElementById('budgetStatus').value;

  // Validate form fields
  if (!date || !id || !department || isNaN(amount) || !status) {
    showToast('Please fill out all fields correctly.', 'danger');
    return; // Prevent modal from closing if validation fails
  }

  // Show loading spinner
  showLoading();

  // Push the new budget data to the budgets array
  budgets.push({ date, id, department, amount, status });

  // Simulate saving (replace with actual save logic)
  setTimeout(() => {
    // Hide loading spinner after the "add" operation
    hideLoading();

    // Update table and overview
    updateBudgetTable();
    updateBudgetOverview();

    // Close the modal
    bootstrap.Modal.getInstance(document.getElementById('addBudgetModal')).hide();

    // Show success toast
    showToast('Budget successfully added!', 'success');
  }, 2000); // Simulate 2 seconds delay
}


// Open the delete confirmation modal
function deleteBudgetModal(budgetId) {
  // Set the ID to the confirmation button for the delete action
  const deleteButton = document.getElementById('confirmDeleteButton');
  
  // Set the function to call when delete is confirmed
  deleteButton.onclick = function () {
    deleteBudget(budgetId); // Proceed with deletion after confirmation
  };

  // Show the modal using Bootstrap Modal instance
  const deleteModal = new bootstrap.Modal(document.getElementById('deleteBudgetModal'));
  deleteModal.show();
}

// Delete Budget (With Loading State)
function deleteBudget(budgetId) {
  // Show loading spinner
  showLoading();

  // Simulate deleting budget (replace with actual delete logic)
  setTimeout(() => {
    // Hide loading spinner after the "delete" operation
    hideLoading();

    // Filter out the budget with the given ID from the budgets array
    budgets = budgets.filter(b => b.id !== budgetId);

    // Show success toast
    showToast('Budget successfully deleted!', 'danger');

    // Close the delete modal after successful deletion
    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteBudgetModal'));
    deleteModal.hide();

    // Refresh the table to reflect the changes
    updateBudgetTable();
  }, 2000); // Simulate 2 seconds delay
}

