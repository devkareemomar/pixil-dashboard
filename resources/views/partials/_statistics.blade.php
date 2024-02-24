<div class="row">
    <div class="col-lg-6 mb-25">
        <div class="card banner-feature mb-0 h-100">
            <canvas id="pieChart" style="margin: auto; width: 100%; height: 100%;"></canvas>
        </div>
    </div>
    <div class="col-lg-6 mb-25">
        <div class="card performance-o border-0">
            <canvas id="lineChart" style="margin: auto; width: 100%; height: 100%; padding:10px;"></canvas>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const pie_chart = document.getElementById('pieChart');
    const line_chart = document.getElementById('lineChart');

    finished_projects = parseInt('{{$finished_projects}}');
    active_projects = parseInt('{{$active_projects}}');

    january = parseInt('{{$january}}');
    february = parseInt('{{$february}}');
    march = parseInt('{{$march}}');
    april = parseInt('{{$april}}');
    may = parseInt('{{$may}}');
    june = parseInt('{{$june}}');
    july = parseInt('{{$july}}');
    august = parseInt('{{$august}}');
    september = parseInt('{{$september}}');
    october = parseInt('{{$october}}');
    november = parseInt('{{$november}}');
    december = parseInt('{{$december}}');

    console.log(finished_projects, active_projects)
    new Chart(pie_chart, {
        type: 'pie',
        data: {
            labels: [
                '{{__('Finished')}}',
                '{{__('In Progress')}}',
            ],
            datasets: [{
                label: 'Projects',
                data: [finished_projects, active_projects],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            }]
        }
    });
    new Chart(line_chart, {
        type: 'line',
        data: {
            labels: [
                '{{__('January')}}',
                '{{__('February')}}',
                '{{__('March')}}',
                '{{__('April')}}',
                '{{__('May')}}',
                '{{__('June')}}',
                '{{__('July')}}',
                '{{__('August')}}',
                '{{__('September')}}',
                '{{__('October')}}',
                '{{__('November')}}',
                '{{__('December')}}'
            ],
            datasets: [{
                label: '{{ __('Earnings') }}',
                data: [january, february, march, april, may, june, july, august, september, october, november, december],
                fill: true,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        }
    });

</script>
