
  // Example Data for Expenses (use real data from your database)
  let expenses = [];

  // Function to open the Add Expense Modal
  function openAddExpenseModal() {
    const modal = new bootstrap.Modal(document.getElementById('addExpenseModal'));
    modal.show();
  }

  // Function to save the new expense
  function saveNewExpense() {
    const expenseDate = document.getElementById('expenseDate').value;
    const expenseCategory = document.getElementById('expenseCategory').value;
    const expenseAmount = document.getElementById('expenseAmount').value;
    const expenseDescription = document.getElementById('expenseDescription').value || 'No description';

    if (!expenseDate || !expenseCategory || !expenseAmount) {
      alert('Please fill in all required fields');
      return;
    }

    // Create new expense object
    const newExpense = {
      date: expenseDate,
      category: expenseCategory,
      amount: parseFloat(expenseAmount),
      description: expenseDescription
    };

    // Add to the expenses array
    expenses.push(newExpense);
    updateExpenseTable(); // Update the table with new expense

    // Reset the form and close modal
    document.getElementById('addExpenseForm').reset();
    const modal = bootstrap.Modal.getInstance(document.getElementById('addExpenseModal'));
    modal.hide();
  }

  // Function to update the expense table
  function updateExpenseTable() {
    const tableBody = document.getElementById('expenseTableBody');
    tableBody.innerHTML = ''; // Clear existing rows

    // Loop through the expenses and populate the table
    expenses.forEach((expense, index) => {
      const row = document.createElement('tr');

      row.innerHTML = `
        <td>${expense.date}</td>
        <td>${expense.category}</td>
        <td>₱${expense.amount.toFixed(2)}</td>
        <td>${expense.description}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick="editExpense(${index})">Edit</button>
        </td>
      `;

      tableBody.appendChild(row);
    });
  }

  // Function to filter expenses
  function filterExpense() {
    const searchQuery = document.getElementById('searchExpense').value.toLowerCase();
    const filterCategory = document.getElementById('filterExpenseCategory').value;

    const filteredExpenses = expenses.filter(expense => {
      const matchesSearch = expense.category.toLowerCase().includes(searchQuery) || expense.description.toLowerCase().includes(searchQuery);
      const matchesCategory = filterCategory ? expense.category === filterCategory : true;
      return matchesSearch && matchesCategory;
    });

    updateExpenseTable(filteredExpenses);
  }

  // Function to export expenses to Excel (simplified)
  function exportToExcel() {
    let csvContent = "Date,Category,Amount,Description\n";
    expenses.forEach(expense => {
      csvContent += `${expense.date},${expense.category},₱${expense.amount.toFixed(2)},${expense.description}\n`;
    });

    // Create a downloadable CSV file
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'expenses.csv';
    link.click();
  }

  // Function to export expenses to PDF (simplified, uses jsPDF library)
  function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Add title and headers
    doc.setFontSize(16);
    doc.text('Expense Report', 14, 10);
    doc.setFontSize(12);
    doc.text('Date | Category | Amount | Description', 14, 20);

    // Loop through expenses and add them to the PDF
    let yOffset = 30;
    expenses.forEach(expense => {
      doc.text(`${expense.date} | ${expense.category} | ₱${expense.amount.toFixed(2)} | ${expense.description}`, 14, yOffset);
      yOffset += 10;
    });

    doc.save('expenses.pdf');
  }

  // Function to edit an expense (open modal with existing data)
  function editExpense(index) {
    const expense = expenses[index];

    // Fill form with existing expense data
    document.getElementById('expenseDate').value = expense.date;
    document.getElementById('expenseCategory').value = expense.category;
    document.getElementById('expenseAmount').value = expense.amount;
    document.getElementById('expenseDescription').value = expense.description;

    // Change Save button to update
    const saveButton = document.querySelector('.modal-footer .btn-primary');
    saveButton.innerText = 'Update Expense';
    saveButton.setAttribute('onclick', `updateExpense(${index})`);
    
    // Open modal
    openAddExpenseModal();
  }

  // Function to update an existing expense
  function updateExpense(index) {
    const expenseDate = document.getElementById('expenseDate').value;
    const expenseCategory = document.getElementById('expenseCategory').value;
    const expenseAmount = document.getElementById('expenseAmount').value;
    const expenseDescription = document.getElementById('expenseDescription').value || 'No description';

    if (!expenseDate || !expenseCategory || !expenseAmount) {
      alert('Please fill in all required fields');
      return;
    }

    // Update the expense object
    expenses[index] = {
      date: expenseDate,
      category: expenseCategory,
      amount: parseFloat(expenseAmount),
      description: expenseDescription
    };

    updateExpenseTable(); // Update the table with the edited expense

    // Reset the form and close modal
    document.getElementById('addExpenseForm').reset();
    const modal = bootstrap.Modal.getInstance(document.getElementById('addExpenseModal'));
    modal.hide();
  }

  // Initialize the table on page load
  window.onload = function() {
    updateExpenseTable();
  }