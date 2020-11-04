<script>

import Vue from 'vue';
import Chart from 'chart.js';

/*export default {
  name: 'App'
};*/


let myChart = document.getElementById('myChart').getContext('2d');
var chart = new Chart(myChart ,{
    type:"bar",
    data:{
        labels:["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14" , "15", "16", "17"],
        datasets:[
            {
                label: "bebid",
                data: susana
            }
        ]
    },
    options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
});
console.log(susana);
</script>