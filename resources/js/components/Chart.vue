<template>
    <div>
        <h1>{{datos}}</h1>
        <canvas id="grafico"></canvas>
    </div>
    
</template>
<script>
import Chart from 'chart.js';

export default{
    name: 'Metric',
    data(){
      return {
        datos:[]
      }
    },
    created() {
        this.getMetrics();
    },
    methods: {
        getMetrics() {
            axios.get('/metrics/data')
            .then(({data}) => this.datos = data.data)
            .catch(error => {
                console.log(error);
                this.loading = false;
            })
        }
    },
    mounted() {
    let ctx = document.getElementById('grafico').getContext('2d');
    new Chart(ctx ,{
    type:"pie",
    data:{
        labels: [],
        datasets:[
            {
                label: "bebid",
                data: this.datos,
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
}
</script>
