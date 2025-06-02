<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fund Request Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Submit Fund Request</h4>
      </div>
      <div class="card-body">
        <form id="fundRequestForm">
          <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="department" required>
          </div>
          <div class="mb-3">
            <label for="payee" class="form-label">Payee</label>
            <input type="text" class="form-control" id="payee" required>
          </div>
          <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" required>
          </div>
          <div class="mb-3">
            <label for="purpose" class="form-label">Purpose</label>
            <textarea class="form-control" id="purpose" rows="2" required></textarea>
          </div>
          <div class="mb-3">
            <label for="request_type" class="form-label">Request Type</label>
            <select class="form-select" id="request_type" required>
              <option value="">Select Type</option>
              <option value="Vehicle">Vehicle</option>
              <option value="Hotel">Hotel</option>
              <option value="Tour">Tour</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="reference_id" class="form-label">Reference ID (optional)</label>
            <input type="text" class="form-control" id="reference_id">
          </div>
          <div class="mb-3">
            <label for="requested_by" class="form-label">Requested By</label>
            <input type="text" class="form-control" id="requested_by" required>
          </div>
          <div class="mb-3">
            <label for="request_date" class="form-label">Request Date</label>
            <input type="date" class="form-control" id="request_date" required>
          </div>
          <button type="submit" class="btn btn-success">Submit Request</button>
        </form>
      </div>
    </div>

    <div id="responseMessage" class="mt-3"></div>
  </div>

  <script>
    document.getElementById("fundRequestForm").addEventListener("submit", function(e) {
      e.preventDefault();

      const formData = {
        department: document.getElementById("department").value,
        payee: document.getElementById("payee").value,
        amount: document.getElementById("amount").value,
        purpose: document.getElementById("purpose").value,
        request_type: document.getElementById("request_type").value,
        reference_id: document.getElementById("reference_id").value || null,
        requested_by: document.getElementById("requested_by").value,
        request_date: document.getElementById("request_date").value
      };

      fetch("http://localhost/pinansyal/api/request-fund.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(formData)
      })
      .then(response => response.json())
      .then(data => {
        const responseBox = document.getElementById("responseMessage");
        if (data.status === "success") {
          responseBox.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
          document.getElementById("fundRequestForm").reset();
        } else {
          responseBox.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
      })
      .catch(error => {
        console.error("Error:", error);
        document.getElementById("responseMessage").innerHTML = `<div class="alert alert-danger">Something went wrong.</div>`;
      });
    });
  </script>

</body>
</html>
