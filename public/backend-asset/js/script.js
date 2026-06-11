  const ctx = document.getElementById('revenueChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
      datasets: [
        {
          label: 'Bookings',
          data: [65,72,80,95,110,130,145,120,105,115,130,160],
          backgroundColor: 'rgba(108,92,231,0.85)',
          borderRadius: 6,
          borderSkipped: false,
          order: 2
        },
        {
          label: 'Revenue',
          data: [40,55,60,75,88,102,120,95,82,90,108,140],
          type: 'line',
          borderColor: '#00b894',
          backgroundColor: 'rgba(0,184,148,0.08)',
          tension: 0.4,
          pointBackgroundColor: '#00b894',
          pointRadius: 4,
          borderWidth: 2,
          fill: true,
          order: 1
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false }
      },
      scales: {
        x: {
          grid: { display: false },
          ticks: { font: { size: 11, family: 'Inter' }, color: '#8a8fa8' }
        },
        y: {
          grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
          ticks: { font: { size: 11, family: 'Inter' }, color: '#8a8fa8', padding: 8 },
          border: { display: false }
        }
      }
    }
  });
 
  document.querySelectorAll('.tab').forEach(t => {
    t.addEventListener('click', () => {
      document.querySelectorAll('.tab').forEach(x => x.classList.remove('active'));
      t.classList.add('active');
    });
  });
 
  document.querySelectorAll('.transport-btn:not(.add)').forEach(t => {
    t.addEventListener('click', () => {
      document.querySelectorAll('.transport-btn').forEach(x => x.classList.remove('active'));
      t.classList.add('active');
    });
  });

  document.querySelectorAll('.nav-item').forEach(link => {
    if (link.href === window.location.href) {
        link.classList.add('active');
    }
});