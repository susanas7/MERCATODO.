
<script>
import Chart from 'chart.js';

export default {
    mounted() {
    let ctx = document.getElementById('grafico');
    new Chart(myChart ,{
    type:"pie",
    data:{
        labels: [],
        datasets:[
            {
                label: "bebid",
                data: d
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