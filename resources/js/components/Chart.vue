<template>
    <div class="container">
        <div class="container-metric">
                <canvas id="most-selled-products"></canvas>
                <div id="void"></div>
                <canvas id="less-selled-products"></canvas>
                
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
        title: [],
        datos2: [],
        title2: []
      }
    },
    created() {
        this.getMetrics();
        this.getMetric();
    },
    methods: {
        getMetrics() {
            axios.get('/admin/metrics/data')
            .then(({data}) => {this.datos = data.data, this.title = data.total})
            .catch(error => {
                console.log(error);
                this.loading = false;
            })
        },
        getMetric() {
            axios.get('/admin/metrics/dato')
            .then(({data}) => {this.datos2 = data.data2, this.title2 = data.total2
            this.mostSelledProductsChart(),
            this.lessSelledProductsChart()})
            .catch(error => {
                console.log(error);
                this.loading = false;
            })
        },
        mostSelledProductsChart(){
            let ctx = document.getElementById('most-selled-products').getContext('2d');
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
                    title: {
                        display: true,
                        text: 'Productos mas vendidos en los ultimos 6 meses'
                    },
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
        },
        lessSelledProductsChart(){
            let ctx = document.getElementById('less-selled-products').getContext('2d');
                new Chart(ctx ,{
                type:"pie",
                data:{
                    labels: this.title2,
                    datasets:[
                        {
                            label: this.title2,
                            data: this.datos2,
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
                    title: {
                        display: true,
                        text: 'Productos menos vendidos en los ultimos 6 meses'
                    },
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
