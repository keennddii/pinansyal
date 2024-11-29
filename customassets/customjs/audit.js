// Function to update the content dynamically
function updateContent(option) {
    // Get the data attributes from the clicked element
    const item = document.querySelector(`[onclick="updateContent('${option}')"]`);
    const totalAudits = item.getAttribute('data-total-audits');
    const pendingCompliance = item.getAttribute('data-pending-compliance');
    const complianceRate = item.getAttribute('data-compliance-rate');

    // Define the elements to be updated based on the dropdown selection
    let displayElement = document.getElementById('display-compliance-data');

    // Update the display content based on the selected option
    if (option === 'total_audits') {
        displayElement.innerHTML = totalAudits + " Audits Completed";
    } else if (option === 'pending_compliance') {
        displayElement.innerHTML = pendingCompliance + " Pending Compliance";
    } else if (option === 'compliance_rate') {
        displayElement.innerHTML = complianceRate + " Compliance Rate";
    }
}

