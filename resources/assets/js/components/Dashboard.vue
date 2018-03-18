<template>
    <div>
        <!--<button :onclick="load">Load</button>-->
        <nav-bar></nav-bar>
        <vue-highcharts :options="options" ref="lineCharts"></vue-highcharts>
    </div>
</template>

<script>
    import VueHighcharts from 'vue2-highcharts'
    import NavBar from './common/NavBar'

    const weeklyData = [];
    export default{
        components: {
            VueHighcharts,
            NavBar
        },
        data(){
            return{
                options: {
                    title: {
                        text: 'Weekly Retention Curve'
                    },
                    xAxis: {
                        title: {
                            text: 'Onboarding Steps'
                        },
                        categories: {
                            0: ' Create account',
                            1 : 'Activate account',
                            2 : 'Provide profile information',
                            3 : 'What jobs are you interested in?',
                            4 : 'Do you have relevant experience in these jobs?',
                            5 : 'Are you freelancer?',
                            6 : 'Waiting for approval',
                            7 : 'Approval'
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'User Precentage (%)'
                        },
                        max : 100
                    },
                    credits: {
                        enabled: false
                    },
                    series: weeklyData
                }
            }
        },
        mounted() {
            var me = this;
            let lineCharts = me.$refs.lineCharts;
            lineCharts.delegateMethod('showLoading', 'Loading...');

            axios.get('/dashboard/weekly-cohorts').then(function(response){
                $.each(response.data.data , function(key, value){
                    lineCharts.addSeries(value)
                });
                lineCharts.hideLoading();
            }).catch(error => {
                alert('unable to fetch weekly cohorts due to internal error. Please try again')
            });
        }
    }
</script>

<style scoped>

</style>