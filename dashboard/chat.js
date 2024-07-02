// Fetch investment data from PHP
const investmentData = JSON.parse(document.getElementById('investmentData').textContent);

// Extract data for the chart
const labels = investmentData.map(data => data.investment_date);
const investmentAmounts = investmentData.map(data => data.investment_amount);
const investmentBalances = investmentData.map(data => data.investment_balance);

// Chart.js configuration
const ctx = document.getElementById('investmentChart').getContext('2d');
const investmentChart = new Chart(ctx, {
    type: 'bar', // or 'line', 'pie', etc.
    data: {
        labels: labels,
        datasets: [{
            label: 'Investment Amount',
            data: investmentAmounts,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }, {
            label: 'Investment Balance',
            data: investmentBalances,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
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
