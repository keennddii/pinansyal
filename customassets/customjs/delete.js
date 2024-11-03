 $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var employeeId = button.data('id'); 
        var modal = $(this);
        var deleteUrl = 'customassets/cnn/fetchdata.php?id=' + employeeId; 

        modal.find('#confirmDelete').attr('href', deleteUrl);
    });

    $('#deleteInvoice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var employeeId = button.data('id'); 
        var modal = $(this);
        var deleteUrl = 'customassets/cnn/invoicing.php?id=' + invoice_number; 

        modal.find('#confirmDelete').attr('href', deleteUrl);
    });
