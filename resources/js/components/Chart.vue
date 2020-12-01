<template>
    <div>
        <div class="container">
            <canvas id="grafico" height="80"></canvas>
        </div>
    </div>
    
</template>
<script>
import Chart from 'chart.js';

export default{
    name: 'Metric',
    data(){
      return {
        datos:[],
        title: []
      }
    },
    created() {
        this.getMetrics();
    },
    methods: {
        getMetrics() {
            axios.get('/admin/metrics/data')
            .then(({data}) => {this.datos = data.data, this.title = data.total
            this.chart()})
            .catch(error => {
                console.log(error);
                this.loading = false;
            })
        },
        chart(){
            let ctx = document.getElementById('grafico').getContext('2d');
                new Chart(ctx ,{
                type:"pie",
                data:{
                    labels: this.title,
                    datasets:[
                        {
                            label: this.title,
                            data: this.datos,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                        }
                    ]
                },
                options:{
                    responsive: true,
                            scales:{
                                yAxes:[{
                                        ticks:{
                                            stacked: false,
                                            beginAtZero:true,
                                            steps: 10,
                                            stepValue: 5,
                                            max: 20
                                        }
                                }]
                            }
                        }
            });
        }
    },
    mounted() {
}
}
</script>
