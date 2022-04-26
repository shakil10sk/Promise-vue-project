<template>
    <apexchart :type="type" :width="width" :options="chartOptions" :series="series"></apexchart>
</template>

<script>
import VueApexCharts from 'vue-apexcharts'
export default {
    name: "Chart",
    data(){
        return{
            series: this.data,
            chartOptions: {
                chart: {
                    width: this.width,
                    type: this.type,
                },
                labels: this.labels,
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            }

        }
    },
    props:{
        type:{
            type:String,
            default: 'pie',
            required:true
        },
        width:{
            type:Number,
            default: 380,
            required:true
        },
        labels:{
            type:Array,
            required:true
        },
        data:{
            type:Array,
            required:true
        },
    }
}
</script>

<style scoped>

</style>
