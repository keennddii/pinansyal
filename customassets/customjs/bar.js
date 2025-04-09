let pieChart = new Chart(document.getElementById('pieChart'), {
  type: 'pie',
  data: {
      labels: ['Food', 'Transportation', 'Utilities'],
      datasets: [{
          data: [12000, 5000, 3000],
          backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
      }]
  }
});

let barChart = new Chart(document.getElementById('barChart'), {
  type: 'bar',
  data: {
      labels: ['Food', 'Transportation', 'Utilities'],
      datasets: [
          {
              label: 'Budgeted',
              data: [10000, 6000, 4000],
              backgroundColor: '#36A2EB'
          },
          {
              label: 'Actual',
              data: [12000, 5000, 3000],
              backgroundColor: '#FF6384'
          }
      ]
  },
  options: {
      scales: {
          y: {
              beginAtZero: true
          }
      }
  }
});

let lineChart = new Chart(document.getElementById('lineChart'), {
  type: 'line',
  data: {
      labels: ['January', 'February', 'March', 'April'],
      datasets: [{
          label: 'Monthly Budget Performance',
          data: [30000, 28000, 32000, 31000],
          borderColor: '#36A2EB',
          fill: false
      }]
  },
  options: {
      scales: {
          y: {
              beginAtZero: true
          }
      }
  }
});

function changeChart() {
  var selectedChart = document.getElementById('chartType').value;

  document.getElementById('pieChart').style.display = 'none';
  document.getElementById('barChart').style.display = 'none';
  document.getElementById('lineChart').style.display = 'none';

  if (selectedChart === 'pie') {
      document.getElementById('pieChart').style.display = 'block';
  } else if (selectedChart === 'bar') {
      document.getElementById('barChart').style.display = 'block';
  } else if (selectedChart === 'line') {
      document.getElementById('lineChart').style.display = 'block';
  }
}