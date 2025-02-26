// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");

// Calculate total
var total = accountBillWeek + percentRerollWeek + percentRechargeWeek;

var data = total === 0 ? [1] : [accountBillWeek, percentRerollWeek, percentRechargeWeek];
var labels = total === 0 ? ["Chưa có số liệu"] : ["Mua tài Khoản", "Mua acc reroll", "Nạp trong game"];
var backgroundColor = total === 0 ? ['#d3d3d3'] : ['#4e73df', '#1cc88a', '#36b9cc'];  
var hoverBackgroundColor = total === 0 ? ['#a9a9a9'] : ['#2e59d9', '#17a673', '#2c9faf'];  

var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: labels,
    datasets: [{
      data: data,
      backgroundColor: backgroundColor,
      hoverBackgroundColor: hoverBackgroundColor,
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
          if (total === 0) {
            return "Chưa có số liệu";
          }
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
