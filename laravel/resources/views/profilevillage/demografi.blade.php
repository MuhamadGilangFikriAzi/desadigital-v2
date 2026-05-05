@extends('layouts.app_front')

@section('title', 'Demografi Desa Digital')

@section('content')
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Demografi Desa Digital</h1>
            <p class="text-blue-200 mt-2">Data kependudukan dan statistik desa</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Grafik -->
        @foreach ($demografi as $index => $chart)
            @if ($index % 3 === 0)
                @if ($index > 0)
    </div>
    @endif
    <div class="chart-container mb-8">
        @endif

        <div class="chart-box bg-white rounded-lg shadow-sm p-4">
            <h4 class="text-blue-700 font-semibold mb-3">{{ $chart['title'] }}</h4>
            <canvas id="{{ str_replace(' ', '_', $chart['title']) }}" class="chart-small"></canvas>
        </div>

        @if (($index + 1) % 3 === 0 || $index + 1 === count($demografi))
    </div>
    @endif
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const villageData = @json($demografi);
            villageData.forEach(item => {
                const id = item.title.replace(/ /g, '_');
                const canvas = document.getElementById(id);
                if (!canvas) return;
                const ctx = canvas.getContext('2d');
                const labels = [];
                const values = [];
                const colors = [];
                item.details.forEach(detail => {
                    labels.push(detail.label);
                    values.push(detail.value);
                    colors.push(detail.color);
                });
                new Chart(ctx, {
                    type: item.type_chart,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: item.title,
                            data: values,
                            backgroundColor: colors,
                            borderColor: colors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'top' },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
