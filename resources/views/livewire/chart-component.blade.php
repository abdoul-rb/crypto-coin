<div class="text-white">
    <canvas id="chart"></canvas>
    <!-- {{ var_dump($data) }} -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/moment"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-adapter-moment/1.0.0/chartjs-adapter-moment.min.js" integrity="sha512-oh5t+CdSBsaVVAvxcZKy3XJdP7ZbYUBSRCXDTVn0ODewMDDNnELsrG9eDm8rVZAQg7RsDD/8K3MjPAFB13o6eA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    const {data, labels} = @js($data)

    console.log(data);
    const ctx = document.getElementById('chart').getContext("2d");
    const myChart = new Chart(ctx, {
        type: 'line',
        options: {
            responsive: true,
            scales: {
                x: {
                    type: 'time',
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Variation des prix sur ces 7 derniers jours'
                }
            }
        },
        data: {
            labels,
            datasets: [
                {
                    label: 'Dataset',
                    data,
                    backgroundColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                    ],
                    borderColor: [
                        'rgba(255,255,255,1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                    ],
                    borderWidth: 2
                }
            ]
        }
    });
</script>