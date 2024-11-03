document.getElementById('newInvoiceForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('customassets/cnn/invoicing.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Handle success
        location.reload(); // Refresh the table
    })
    .catch(error => console.error('Error:', error));
});
