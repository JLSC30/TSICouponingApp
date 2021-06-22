@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <canvas id="usedCoupon" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    foreach($products as $p)
    {
        $labels[] = $p->name;
        $usedCoupon[] = $p->coupon->where('status', 'Used')->count();
        $unusedCoupon[] = $p->coupon->where('status', 'Unused')->count();
    }
?>
<script>
var ctx = document.getElementById('usedCoupon').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($labels ?? ''); ?>,
        datasets: [
        {
            label: 'Used coupon',
            data: <?php echo json_encode($usedCoupon ?? '', JSON_NUMERIC_CHECK); ?>,
            backgroundColor: [
                'rgba(40, 167, 69, 1)'
            ],
            borderColor: [
                'rgba(40, 167, 69, 1)'
            ],
            borderWidth: 5,
            tension: 0.5,
        },
        {
            label: 'Unused coupon',
            data: <?php echo json_encode($unusedCoupon ?? '', JSON_NUMERIC_CHECK); ?>,
            backgroundColor: [
                'rgba(23, 162, 184, 1)'
            ],
            borderColor: [
                'rgba(23, 162, 184, 1)'
            ],
            borderWidth: 5,
            tension: 0.5,
        },
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true,
        plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Total used coupon'
        }
    }
    }
});
</script>
@endpush