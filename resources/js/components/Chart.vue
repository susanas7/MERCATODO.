<template>
    <div class="container">
        <div class="container-metric">
            <canvas id="most-selled-products"></canvas>
            <div id="void"></div>
            <canvas id="less-selled-products"></canvas>
        </div>
        <div id="metric-center">
            <canvas id="most-frequent-users"></canvas>
        </div>
    </div>
</template>
<script>
import Chart from 'chart.js';

export default{
    name: 'Metric',
    data(){
      return {
        productData:[],
        productTitle: [],
        datos2: [],
        title2: [],
        userData: [],
        userTitle: []
      }
    },
    created() {
        this.getMetrics();
        this.getMetric();
    },
    methods: {
        getMetrics() {
            axios.get('/admin/metrics/data')
            .then(({data}) => {this.productData = data.productData, this.productTitle = data.productTitle,
            this.userData = data.userData, this.userTitle = data.userTitle})
            .catch(error => {
                console.log(error);
                this.loading = false;
            })
        },
        getMetric() {
            axios.get('/admin/metrics/data2')
            .then(({data}) => {this.datos2 = data.data2, this.title2 = data.total2
            this.mostSelledProductsChart(),
            this.lessSelledProductsChart(),
            this.mostFrequentUsersChart()})
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
                    labels: this.productTitle,
                    datasets:[
                        {
                            label: this.productTitle,
                            data: this.productData,
                            backgroundColor: [
                                'rgb(88, 61, 114)',
                                'rgb(156, 160, 179)',
                                'rgba(207, 209, 218)',
                                'rgba(235, 236, 239)',
                                'rgba(235, 207, 196)'
                            ],
                        }
                    ]
                },
                options:{
                    title: {
                        display: true,
                        text: 'Productos mas vendidos en los ultimos 6 meses',
                        fontSize: 14
                    },
                    responsive: true,
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
                                'rgb(255, 240, 240)',
                                'rgb(235, 212, 212)',
                                'rgb(131, 88, 88)',
                                'rgb(70, 51, 51)',
                                'rgb(108, 79, 87)'
                            ],
                        }
                    ]
                },
                options:{
                    title: {
                        display: true,
                        text: 'Productos menos vendidos en los ultimos 6 meses',
                        fontSize: 14
                    },
                    responsive: true,
                }
            });
        },
        mostFrequentUsersChart(){
            let ctx = document.getElementById('most-frequent-users').getContext('2d');
                new Chart(ctx ,{
                type:"pie",
                data:{
                    labels: this.userTitle,
                    datasets:[
                        {
                            label: this.userTitle,
                            data: this.userData,
                            backgroundColor: [
                                'rgb(20, 40, 80',
                                'rgb(39, 73, 109)',
                                'rgba(0, 144, 158)',
                                'rgba(218, 225, 231)',
                                'rgba(164, 197, 198)'
                            ],
                        }
                    ]
                },
                options:{
                    title: {
                        display: true,
                        text: 'Usuarios mas frecuentes en los ultimos 6 meses',
                        fontSize: 14
                    },
                    responsive: true,
                }
            });
        },
    },
    mounted() {
}
}
</script>

<style>
.container-show-metrics{
    margin: 1% 1% 1% 1%;
    padding: 1% 1% 1% 1%;
    border-radius: 8px;
    background-color: #E0E0E0;height: 100%;
}

#most-selled-products{
    background-color: white;
    border-radius: 5px;
    border: none;
    padding: 1% 1% 1% 1%;
}

#less-selled-products{
    background-color: white;
    border-radius: 5px;
    border: none;
    padding: 1% 1% 1% 1%;
}

#metric-center{
    border: none;
}

#most-frequent-users{
    background-color: white;
    border-radius: 5px;
    border: white;
    padding: 2% 2% 2% 2%;
}

</style>
