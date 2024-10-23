document.addEventListener("DOMContentLoaded", function () {
    const sendBtn = document.getElementById("sendBtn");
    const payrollTable = document.getElementById("payrollTable").getElementsByTagName("tbody")[0];

    // Send data when the "Send" button is clicked
    sendBtn.addEventListener("click", function () {
        // Gather table data
        const tableData = [];
        const rows = payrollTable.rows;
        for (let i = 0; i < rows.length; i++) {
            const row = {
                id: rows[i].cells[0].innerText,
                name: rows[i].cells[1].innerText,
                grosspay: rows[i].cells[2].innerText,
                sss: rows[i].cells[3].innerText,
                philHealth: rows[i].cells[4].innerText,
                pagIbig: rows[i].cells[5].innerText,
                sssLoan: rows[i].cells[6].innerText,
                pagIbigLoan: rows[i].cells[7].innerText,
                totalDeduction: rows[i].cells[8].innerText,
                netPay: rows[i].cells[9].innerText,
                total: rows[i].cells[10].innerText
            };
            tableData.push(row);
        }

        // Send the data via a POST request (simulating sending to a server)
        fetch('https://example.com/api/sendPayrollData', { // Change the URL to your API endpoint
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(tableData),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            alert('Data sent successfully!');
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Failed to send data.');
        });
    });
});
