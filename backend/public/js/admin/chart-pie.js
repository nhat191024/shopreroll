// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");

// Calculate total
var total = accountBillWeek + percentRerollWeek + percentRechargeWeek;

// If total is 0, set data to show an empty circle
var data = total === 0 ? [1, 1, 1] : [accountBillWeek, percentRerollWeek, percentRechargeWeek];

var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Mua tài Khoản", "Mua acc reroll", "Nạp trong game"],
    datasets: [{
      data: data, 
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 2,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, data) {
          var label = data.labels[tooltipItem.index]; 
          var currentValue = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]; 
          return label + ': ' + currentValue + '%'; 
        }
      }
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
