<template>
    <div class="home">
        <div style="padding: 14px 0;">
            <div class="title">
                <img src="/images/city.png" class="icon">
                <vgl-rollup text="全市双招双创项目情况"></vgl-rollup>
            </div>
            <el-row :gutter="12">
                <el-col :span="6">
                    <el-card shadow="hover">
                        项目个数 <span class="items-num">580</span>个
                    </el-card>
                </el-col>
                <el-col :span="6">
                    <el-card shadow="hover">
                        十强产业到位资金 <span class="item-fee">100</span>亿元
                        <el-progress type="circle" :percentage="70" color="#f85e13" :width="70"></el-progress>
                    </el-card>
                </el-col>
                <el-col :span="6">
                    <el-card shadow="hover">
                        开工项目数 <span class="start-num">45</span>个
                        <el-progress type="circle" :percentage="70" color="#16A1C0" :width="70"></el-progress>

                    </el-card>
                </el-col>
                <el-col :span="6">
                    <el-card shadow="hover">
                        竣工项目数 <span class="end-num">15</span>个
                        <el-progress type="circle" :percentage="25" color="#28a42f" :width="70"></el-progress>
                    </el-card>
                </el-col>
            </el-row>
        </div>
        <div class="title">
            <img src="/images/district.png" class="icon">
            <vgl-rollup text="各区双招双创项目情况"></vgl-rollup>
            <span class="remark">(默认资金到位排名)</span>
            <div style="float: right;">
                <el-button type="primary" size="mini" icon="el-icon-menu" round @click="ranking">项目数排名</el-button>
                <el-button type="warning" size="mini" round @click="rankingStart">开工数排名</el-button>
                <el-button type="danger" size="mini" round @click="rankingEnd">竣工数排名</el-button>
            </div>
        </div>
        <div class="ranking">
            <el-row :gutter="12">
                <el-col :span="3" v-for="(area,index) in areas" :key="index">
                    <el-card :body-style="{ padding: '0px'}" shadow="hover">
                        <div class="items" style="padding: 14px;">
                            <img :src="area.pic +'!mp.v200'" class="image-district">
                            <div class="district">
                                <p class="district-name">{{area.district}}</p>
                                <p>￥<span class="items-district-num">{{area.fee}}</span>亿元</p>
                            </div>
                        </div>
                        <div style="padding: 0 14px 14px 14px;font-size:12px; color:#6f7180;">
                            <p>项目: {{ area.items_num }}个</p>
                            <p>开工 {{area.start_num}}个，竣工 {{area.end_num}}个</p>
                        </div>
                    </el-card>
                </el-col>
            </el-row>
        </div>

        <div class="title">
            <img src="/images/charts.png" class="icon">
            <vgl-rollup text="双招双创图表对比"></vgl-rollup>
        </div>
        <div class="chart">
            <canvas id="myChart"></canvas>
        </div>
        <div class="footer">
            <text>山东数研科技提供技术支持</text>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import Chart from 'chart.js';

    export default {
        created() {
            this.$store.dispatch('setAuthUser')
        },
        computed: {
            ...mapState({
                user: state => state.AuthUser,
            })
        },

        data() {
            return {
                currentDate: new Date(),
                areas: [],
                chartX:[],
                feeY:[],
                itemsNum:[],
                startNum:[],
                endNum:[]
            }

        },
        mounted() {
            axios.get('/api/v1/areas').then(response => {
                this.areas = response.data
                let chartX = []
                let feeY = []
                let itemsNum = []
                let startNum = []
                let endNum = []
                for (var i = 0; i < response.data.length; i++) {
                    chartX[i] = response.data[i].district
                    feeY[i] = response.data[i].fee
                    itemsNum[i] = response.data[i].items_num
                    startNum[i] = response.data[i].start_num
                    endNum[i] = response.data[i].end_num
                }
                this.chartX=chartX
                this.feeY=feeY
                this.itemsNum=itemsNum
                this.startNum=startNum
                this.endNum=endNum
                this.indexChart(this.chartX, this.feeY, this.itemsNum, this.startNum, this.endNum)
            })


        },
        methods: {
            ranking:function(){
                axios.get('/api/v1/area/ranking/'+'items_num').then(response => {
                    this.areas = response.data
                    let chartX = []
                    let feeY = []
                    let itemsNum = []
                    let startNum = []
                    let endNum = []
                    for (var i = 0; i < response.data.length; i++) {
                        chartX[i] = response.data[i].district
                        feeY[i] = response.data[i].fee
                        itemsNum[i] = response.data[i].items_num
                        startNum[i] = response.data[i].start_num
                        endNum[i] = response.data[i].end_num
                    }
                    this.chartX=chartX
                    this.feeY=feeY
                    this.itemsNum=itemsNum
                    this.startNum=startNum
                    this.endNum=endNum
                    this.indexChart(this.chartX, this.feeY, this.itemsNum, this.startNum, this.endNum)
                })
            },
            rankingStart:function(){
                axios.get('/api/v1/area/ranking/'+'start_num').then(response => {
                    this.areas = response.data
                    let chartX = []
                    let feeY = []
                    let itemsNum = []
                    let startNum = []
                    let endNum = []
                    for (var i = 0; i < response.data.length; i++) {
                        chartX[i] = response.data[i].district
                        feeY[i] = response.data[i].fee
                        itemsNum[i] = response.data[i].items_num
                        startNum[i] = response.data[i].start_num
                        endNum[i] = response.data[i].end_num
                    }
                    this.chartX=chartX
                    this.feeY=feeY
                    this.itemsNum=itemsNum
                    this.startNum=startNum
                    this.endNum=endNum
                    this.indexChart(this.chartX, this.feeY, this.itemsNum, this.startNum, this.endNum)
                })
            },
            rankingEnd:function(){
                axios.get('/api/v1/area/ranking/'+'end_num').then(response => {
                    this.areas = response.data
                    let chartX = []
                    let feeY = []
                    let itemsNum = []
                    let startNum = []
                    let endNum = []
                    for (var i = 0; i < response.data.length; i++) {
                        chartX[i] = response.data[i].district
                        feeY[i] = response.data[i].fee
                        itemsNum[i] = response.data[i].items_num
                        startNum[i] = response.data[i].start_num
                        endNum[i] = response.data[i].end_num
                    }
                    this.chartX=chartX
                    this.feeY=feeY
                    this.itemsNum=itemsNum
                    this.startNum=startNum
                    this.endNum=endNum
                    this.indexChart(this.chartX, this.feeY, this.itemsNum, this.startNum, this.endNum)
                })
            },
            indexChart: function (chartX, feeY, itemsNum, startNum, endNum) {
                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartX,
                        datasets: [{
                            label: '十强产业到位资金',
                            data: feeY,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            borderWidth: 1
                        }, {
                            label: '项目数',
                            type: 'line',
                            data: itemsNum,
                            backgroundColor: [
                                'rgba(9, 191, 243, 0.2)'
                            ],
                            borderColor: [
                                'rgba(9, 191, 243,1)'
                            ],
                            borderWidth: 3
                        }, {
                            label: '开工项目数',
                            type: 'line',
                            data: startNum,
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192,1)'
                            ],
                            borderWidth: 3
                        }, {
                            label: '竣工项目数',
                            type: 'line',
                            data: endNum,
                            backgroundColor: [
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(153, 102, 255,1)'
                            ],
                            borderWidth: 3
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }

        }
    }
</script>

<style>
    .home .title {
        font-size: 18px;
        font-weight: 700;
        padding: 5px 0 20px 0;
    }
.home .ranking{
    margin-bottom: 20px;
}
.home .chart{
    margin-bottom: 40px;
}
    .home .title .icon {
        width: 20px;
        height: 20px;
    }

    .home .time {
        font-size: 13px;
        color: #999;
    }

    .home .bottom {
        margin-top: 13px;
        line-height: 12px;
    }

    .home .button {
        padding: 0;
        float: right;
    }

    .home .image {
        width: 100%;
        height: 60px;
        display: block;
    }

    .home .el-progress {
        float: right;
    }

    .home .clearfix:before,
    .home .clearfix:after {
        display: table;
        content: "";
    }

    .home .clearfix:after {
        clear: both
    }

    .home .el-col {
        margin-bottom: 10px;
    }

    .home .items .image-district {
        float: left;
        width: 60px;
        height: 60px;
        border: 1px solid #fff;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }

    .el-progress__text {
        font-size: 16px !important;
    }

    .el-card__body {
        font-size: 16px;
    }

    .items-num {
        font-size: 40px;
        font-weight: 700;
        color: #f85e13;
    }

    .item-fee {
        font-size: 40px;
        font-weight: 700;
        color: #f85e13;
    }

    .items-district-num {
        font-size: 20px;
        font-weight: 700;
        color: #f85e13;
    }

    .district-name {
        font-size: 16px;
        font-weight: 700;
    }

    .start-num, .end-num {
        font-size: 40px;
        font-weight: 700;
        color: #f85e13;
    }

    .district {

        padding-left: 70px;

    }

    .home p {
        margin-bottom: 0px !important;
    }

    .remark {
        font-size: 14px;
        color: #505050;
    }
</style>s
