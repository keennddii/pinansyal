<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logistic 1 Budget</title>
</head>
<body>
  <h2 id="dept-title">Loading...</h2>
  <div id="budget-container">Fetching data...</div>

  <script>
    fetch('http://localhost/pinansyal/api/logistic1_budget.php')
      .then(response => response.json())
      .then(data => {
        const container = document.getElementById('budget-container');
        const title = document.getElementById('dept-title');

        if (data.length === 0) {
          title.textContent = 'No budget data found.';
          return;
        }

        title.textContent = `${data[0].department_name} - Budget Allocation`;

        let html = '<table border="1" cellpadding="5"><tr><th>Year</th><th>Allocated</th><th>Used</th></tr>';
        data.forEach(item => {
          html += `<tr>
            <td>${item.year}</td>
            <td>${item.allocated_amount}</td>
            <td>${item.used_amount}</td>
          </tr>`;
        });
        html += '</table>';

        container.innerHTML = html;
      })
      .catch(error => {
        document.getElementById('budget-container').innerHTML = 'Error fetching data.';
        console.error(error);
      });
  </script>
</body>
</html>
