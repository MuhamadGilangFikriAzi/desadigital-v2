<?php $__env->startSection('title', 'Demografi Desa Digital'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Demografi Desa Digital</h1>
            <p class="text-blue-200 mt-2">Data kependudukan dan statistik desa</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Grafik -->
        <?php $__currentLoopData = $demografi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $chart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($index % 3 === 0): ?>
                <?php if($index > 0): ?>
    </div>
    <?php endif; ?>
    <div class="chart-container mb-8">
        <?php endif; ?>

        <div class="chart-box bg-white rounded-lg shadow-sm p-4">
            <h4 class="text-blue-700 font-semibold mb-3"><?php echo e($chart['title']); ?></h4>
            <canvas id="<?php echo e(str_replace(' ', '_', $chart['title'])); ?>" class="chart-small"></canvas>
        </div>

        <?php if(($index + 1) % 3 === 0 || $index + 1 === count($demografi)): ?>
    </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const villageData = <?php echo json_encode($demografi, 15, 512) ?>;
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/profilevillage/demografi.blade.php ENDPATH**/ ?>