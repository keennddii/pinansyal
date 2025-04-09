   // Dummy data for accounts
   let accounts = [
    { code: "101", name: "Cash", type: "Asset", parent: "Current Assets", balance: "Debit" },
    { code: "201", name: "Accounts Payable", type: "Liability", parent: "Current Liabilities", balance: "Credit" },
    { code: "301", name: "Owner's Capital", type: "Equity", parent: "Equity", balance: "Credit"},
    { code: "401", name: "Tour Package Sales", type: "Revenue", parent: "Revenue", balance: "Credit" },
    { code: "501", name: "Salaries & Wages", type: "Expense", parent: "Operating Expenses", balance: "Debit" },
    { code: "502", name: "Marketing & Advertising", type: "Expense", parent: "Operating Expenses", balance: "Debit" },
    { code: "503", name: "Office Rent", type: "Expense", parent: "Operating Expenses", balance: "Debit" }
  ];
  
  let currentPage = 1;
  const rowsPerPage = 5;
  
  function displayAccounts() {
    const tableBody = document.getElementById("coaBody");
    tableBody.innerHTML = "";
    
    let filteredAccounts = accounts;
    const searchQuery = document.getElementById("searchAccount").value.toLowerCase();
    const filterType = document.getElementById("filterAccountType").value;
    
    if (searchQuery) {
      filteredAccounts = filteredAccounts.filter(account => 
        account.name.toLowerCase().includes(searchQuery) || 
        account.code.includes(searchQuery)
      );
    }
    
    if (filterType) {
      filteredAccounts = filteredAccounts.filter(account => account.type === filterType);
    }
    
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const paginatedAccounts = filteredAccounts.slice(start, end);
    
    paginatedAccounts.forEach(account => {
      const row = `<tr>
        <td><input type='checkbox' class='selectRow'></td>
        <td>${account.code}</td>
        <td>${account.name}</td>
        <td>${account.type}</td>
        <td>${account.parent}</td>
        <td>${account.balance}</td>
        <td>
          <button class='btn btn-warning btn-sm'>Edit</button>
          <button class='btn btn-danger btn-sm'>Delete</button>
        </td>
      </tr>`;
      tableBody.innerHTML += row;
    });
    
    setupPagination(filteredAccounts.length);
  }
  
  function setupPagination(totalRows) {
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    const paginationControls = document.getElementById("paginationControls");
    paginationControls.innerHTML = "";
    
    for (let i = 1; i <= totalPages; i++) {
      paginationControls.innerHTML += `<li class="page-item ${i === currentPage ? 'active' : ''}">
        <button class="page-link" onclick="changePage(${i})">${i}</button>
      </li>`;
    }
  }
  
  function changePage(page) {
    currentPage = page;
    displayAccounts();
  }
  
  function filterAccounts() {
    currentPage = 1;
    displayAccounts();
  }
  
  // Select All functionality
  document.getElementById("selectAll").addEventListener("change", function() {
    document.querySelectorAll(".selectRow").forEach(checkbox => {
      checkbox.checked = this.checked;
    });
  });
  
  // Delete Selected Rows
  function deleteSelected() {
    document.querySelectorAll(".selectRow:checked").forEach(checkbox => {
      checkbox.closest("tr").remove();
    });
  }
  
  // Dummy Export to Excel - Exports CSV file
  function exportToExcel() {
    let csvContent = "Account Code,Account Name,Account Type,Parent Account,Normal Balance,Status\\n";
    accounts.forEach(acc => {
      csvContent += `${acc.code},${acc.name},${acc.type},${acc.parent},${acc.balance}\\n`;
    });
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement("a");
    link.setAttribute("href", URL.createObjectURL(blob));
    link.setAttribute("download", "chart_of_accounts.csv");
    link.click();
  }
  
  // Dummy Export to PDF - Just an alert (Replace with actual PDF generation if needed)
  function exportToPDF() {
    alert("Exporting to PDF... (functionality to be implemented)");
  }
  
  // Open the Add Account Modal
  function openAddModal() {
    const modal = new bootstrap.Modal(document.getElementById('addAccountModal'));
    modal.show();
  } 
  // Save new account from modal form
  function saveNewAccount() {
    const code = document.getElementById("newAccountCode").value;
    const name = document.getElementById("newAccountName").value;
    const type = document.getElementById("newAccountType").value;
    const parent = document.getElementById("newParentAccount").value || "N/A";
    const balance = document.getElementById("newNormalBalance").value;
    const status = document.getElementById("newStatus").value;
    
    if (!code || !name || !type || !balance || !status) {
      alert("Please fill in all required fields.");
      return;
    }
    
    // Add the new account to the accounts array
    accounts.push({ code, name, type, parent, balance, status });
    
    // Reset the form fields
    document.getElementById("addAccountForm").reset();
    
    // Hide the modal
    const modalEl = document.getElementById('addAccountModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    modal.hide();
    
    // Refresh the table
    displayAccounts();
  }
  
  window.onload = displayAccounts;

  
  // Open the Add Journal Entry Modal
function openJournalModal() {
  const modal = new bootstrap.Modal(document.getElementById('addJournalModal'));
  modal.show();
}

// Save the new Journal Entry
function saveJournalEntry() {
  const date = document.getElementById('journalDate').value;
  const account = document.getElementById('journalAccount').value;
  const description = document.getElementById('journalDescription').value;
  const debit = document.getElementById('journalDebit').value;
  const credit = document.getElementById('journalCredit').value;
  if (!date || !account || !description || !debit || !credit) {
    alert("Please fill in all required fields.");
    return;
  }
  journalEntries.push({ date, account, description, debit, credit });
  document.getElementById('addJournalForm').reset();
  const modalEl = document.getElementById('addJournalModal');
  const modal = bootstrap.Modal.getInstance(modalEl);
  modal.hide();
  displayJournalEntries();
}



  