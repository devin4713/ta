<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($sensorData->count() > 0)
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-xl font-semibold mb-2 text-center">Data dengan Kalman FIlter</h3>
                            <div>
                                <canvas id="afterChart" width="800" height="380"></canvas>
                            </div>
                        </div>

                        <div class="mt-4 text-center text-gray-800 dark:text-gray-100">
                            <p>Grafik ini menampilkan data ketinggian air yang telah diproses menggunakan Kalman Filter. Dengan metode ini, fluktuasi pengukuran yang disebabkan oleh gangguan seperti riak air atau noise sensor, dapat dikurangi. Hasilnya, data yang ditampilkan dapat menjadi lebih stabil dan akurat dibandingkan dengan data tanpa filter.</p>
                        </div>
                    @else
                        <p>Tidak ada data sensor dengan Kalman Filter.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold text-center text-gray-900 dark:text-gray-100 mb-4">Tentang Web</h3>
                    <p class="text-gray-900 dark:text-gray-100 text-center">
                        Aplikasi web ini dibangun untuk menampilkan data ketinggian air dari sensor, baik sebelum maupun sesudah penerapan metode Kalman Filter. Data divisualisasikan dalam bentuk grafik waktu nyata untuk mempermudah perbandingan data antara tanpa dan dengan Kalman Filter.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var sensorData = @json($sensorData);

        function extractData(data) {
            var labels = [];
            var afters = [];

            data.forEach(function(item) {
                var minutes = new Date(item.created_at).getMinutes().toString().padStart(2, '0');
                var seconds = new Date(item.created_at).getSeconds().toString().padStart(2, '0');
                labels.unshift(minutes + ':' + seconds);
                afters.unshift(item.after_kf);
            });

            return {labels: labels, afters: afters};
        }

        var extractedData = extractData(sensorData);

        // CHART
        var afCtx = document.getElementById('afterChart').getContext('2d');
        var afChart = new Chart(afCtx, {
            type: 'line',
            data: {
                labels: extractedData.labels,
                datasets: [{
                    label: 'Water Level (cm)',
                    data: extractedData.afters,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false,
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        min: 4,
                        max: 8,
                        ticks: {
                            stepSize: 0.5,
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });

        // UPDATE
        function updateCharts() {
            $.ajax({
                url: '{{ url('/latest') }}',
                method: 'GET',
                success: function(data) {
                    var newData = extractData(data);

                    afChart.data.labels = newData.labels;
                    afChart.data.datasets[0].data = newData.afters;
                    afChart.update();
                }
            });
        }

        setInterval(updateCharts, 500);
    </script>
</x-app-layout>
