<div>
    <canvas id="statusChart" height="100"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('statusChart').getContext('2d');

const dataSets = @json($chartData);

const datasets = dataSets.map(ds => ({
    label: ds.label,
    data: ds.data,
    fill: false,
    borderWidth:3,

    borderColor:
        ds.label === 'Analisis' ? 'rgba(255, 99, 132, 1)' :
        ds.label === 'Approved' ? 'rgba(54, 162, 235, 1)' :
        ds.label === 'Survey' ? 'rgba(255, 206, 86, 1)' :
        ds.label === 'Realisasi' ? 'rgba(75, 192, 192, 1)' :
        'rgba(153, 102, 255, 1)',

    tension:0.4,
    pointRadius:4,
    pointHoverRadius:6
}));


new Chart(ctx,{
    type:'line',

    data:{
        labels:[
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ],
        datasets:datasets
    },

    options:{
        responsive:true,

        plugins:{
            legend:{
                position:'top'
            },

            title:{
                display:true,
                text:'Statistik Pengajuan Analyst Tahun {{ $year }}',
                font:{
                    size:16
                }
            }
        },

        scales:{
            y:{
                beginAtZero:true,
                ticks:{
                    precision:0
                }
            }
        }
    }

});

</script>