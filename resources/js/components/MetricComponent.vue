<script>

import Vue from 'vue';
import Chart from 'chart.js';


var data;

let myChart = document.getElementById('myChart').getContext('2d');
var chart = new Chart(myChart ,{
    type:"bar",
    data:{
        labels:["1", "2", "3", "4", "5", "6", "7", "8"],
        datasets:[
            {
                label: "bebid",
                data: [1,1,1,1,1,1,1,1]
            }
        ]
    }
})
</script>