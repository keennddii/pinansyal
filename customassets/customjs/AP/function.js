    // Delete function: sets the id in the hidden delete form and submits it
    function deleteBill(id) {
      if (confirm("Are you sure you want to delete this bill?")) {
        document.getElementById("deleteId").value = id;
        document.getElementById("deleteForm").submit();
      }
    }
    
    // For simplicity, the Edit modal will be loaded by redirecting to a separate page.
    // However, you can implement a JavaScript solution to load the current record's values into the edit modal.
    function openEditBillModal(id) {
      // For this example, we simulate a simple edit:
      // You could load data via AJAX or by embedding data attributes.
      // Here, we assume the user will fill in the edit form manually.
      // Optionally, you can prefill the form if you add data attributes to the table rows.
      document.getElementById("editBillId").value = id;
      var editModal = new bootstrap.Modal(document.getElementById("editBillModal"));
      editModal.show();
    }
    
    // Dummy functions for filtering and export (implement as needed)
    function filterBills() { /* Client-side filtering code here if desired */ }
    function exportToExcel() { alert("Export to Excel not implemented."); }
    function exportToPDF() { alert("Export to PDF not implemented."); }
