<script>

import Chart from 'chart.js';

let myChart = document.getElementById('myChart').getContext('2d');
var chart = new Chart(myChart ,{
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
</script>