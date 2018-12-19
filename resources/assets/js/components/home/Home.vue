<template>
    <div class="home page-index">
        <el-row>
            <el-col :span="24">
                <div style="padding: 14px 0;">
                    <div class="title">
                        <img src="/images/city.png" class="icon">
                        {{totalTitle}}
                        <span class="remark">总投资规模：{{homeTotal.fee}}亿元，总项目数：{{homeTotal.item_sum_all}}个</span>
                        <div style="float: right;">
                            <el-button type="success" size="mini" round @click="queryYearLast">2017年</el-button>
                            <el-button type="success" size="mini" round @click="queryYearNow">2018年</el-button>
                        </div>
                    </div>
                    <el-row :gutter="10">
                        <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                            <el-card shadow="always">
                                <el-row :gutter="0">
                                    <el-col :span="16">
                                        <p class="fee-num">
                                            <vgl-slidein text="到位资金项目个数"></vgl-slidein>
                                        </p>
                                        <span class="items-num">{{homeTotal.item_sum}}</span>个
                                    </el-col>
                                    <el-col :span="8">
                                        <el-progress type="circle" :percentage="homeTotal.item_sum_ratio" color="#f85e13"
                                                     :width="70"></el-progress>
                                    </el-col>
                                </el-row>
                            </el-card>
                        </el-col>
                        <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                            <el-card shadow="always">
                                <el-row :gutter="0">
                                    <el-col :span="16">
                                        <p class="fee-num">
                                            <vgl-slidein text="十强产业到位资金"></vgl-slidein>
                                        </p>
                                        <span class="item-fee">{{homeTotal.ten_fee}}</span>亿元
                                    </el-col>
                                    <el-col :span="8">
                                        <el-progress type="circle" :percentage="homeTotal.ten_fee_radio" color="#f85e13"
                                                     :width="70"></el-progress>
                                    </el-col>
                                </el-row>
                            </el-card>
                        </el-col>
                        <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                            <el-card shadow="always">
                                <el-row :gutter="0">
                                    <el-col :span="16">
                                        <p class="fee-num">
                                            <vgl-slidein text="开工项目数"></vgl-slidein>
                                        </p>
                                        <span class="item-fee">{{homeTotal.item_start}}</span>个
                                    </el-col>
                                    <el-col :span="8">
                                        <el-progress type="circle" :percentage="homeTotal.item_start_ratio" color="#16A1C0"
                                                     :width="70"></el-progress>
                                    </el-col>
                                </el-row>
                            </el-card>
                        </el-col>
                        <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                            <el-card shadow="always">
                                <el-row :gutter="10">
                                    <el-col :span="16">
                                        <p class="fee-num">
                                            <vgl-slidein text="竣工项目数"></vgl-slidein>
                                        </p>
                                        <span class="item-fee">{{homeTotal.item_finish}}</span>个
                                    </el-col>
                                    <el-col :span="8">
                                        <el-progress type="circle" :percentage="homeTotal.item_finish_ratio" color="#28a42f"
                                                     :width="70"></el-progress>
                                    </el-col>
                                </el-row>
                            </el-card>
                        </el-col>
                    </el-row>
                </div>
            </el-col>

            <el-col :span="24">
                <div class="title">
                    <img src="/images/district.png" class="icon">
                    {{areaTitle}}
                    <span class="remark"><vgl-wave text="默认为十强产业到位资金排名"></vgl-wave></span>
                    <div style="float: right;">
                        <el-button type="primary" size="mini" icon="el-icon-menu" round @click="ranking">项目数排名</el-button>
                        <el-button type="warning" size="mini" round @click="rankingStart">开工数排名</el-button>
                        <el-button type="danger" size="mini" round @click="rankingEnd">竣工数排名</el-button>
                    </div>
                </div>
                <div class="ranking">
                    <el-row :gutter="10">
                        <el-col :xs="24" :sm="24" :md="12" :lg="4" :xl="3" v-for="(area,index) in areas" :key="index">
                            <router-link :to="{name: 'profile.Area-projects',params: { id: area.id,areas:area}}" exact>
                                <el-card :body-style="{ padding: '0px'}" shadow="always">
                                    <el-row :gutter="0">
                                        <el-col :xs="24" :sm="12" :md="12" :lg="24" :xl="24">
                                            <div class="items" style="padding: 8px;">
                                                <img :src="area.pic" class="image-district">
                                                <div class="district">
                                                    <p class="district-name">{{area.district}}</p>
                                                    <p>￥<span class="items-district-num">{{area.ten_fee}}</span>亿元</p>
                                                </div>
                                            </div>
                                        </el-col>
                                        <el-col :xs="24" :sm="12" :md="12" :lg="24" :xl="24">
                                            <div style="padding:8px 14px;font-size:12px; color:#6f7180;">
                                                <p>总项目：{{ area.item_sum_all }}个
                                                    (开工{{area.item_start}}/竣工{{area.item_finish}})</p>
                                            </div>
                                        </el-col>
                                    </el-row>
                                </el-card>
                            </router-link>
                        </el-col>
                    </el-row>
                </div>
            </el-col>
            <el-col :span="24">
                <div class="title">
                    <img src="/images/charts.png" class="icon">
                    {{chartTitle}}
                    <div style="float: right;">
                        <el-button type="primary" size="mini" round @click="ranking">项目数排名</el-button>
                        <el-button type="warning" size="mini" round @click="rankingStart">开工数排名</el-button>
                        <el-button type="danger" size="mini" round @click="rankingEnd">竣工数排名</el-button>
                    </div>
                </div>
                <div class="chart">
                    <canvas id="myChart" height="60"></canvas>
                </div>
            </el-col>
            <el-col :span="24">
                <el-row>
                    <el-col :span="14">
                        <div class="title">
                            <img src="/images/charts.png" class="icon">
                            {{year_at}}年十强产业占比
                        </div>
                        <div class="chart">
                            <div id="industryChart"></div>
                        </div>
                    </el-col>
                    <el-col :span="10">
                        <div class="title">
                            <img src="/images/charts.png" class="icon">
                            {{year_at}}年内资项目来源分布
                        </div>
                        <div class="chart">
                            <div id="cityChart" height="120"></div>
                        </div>
                    </el-col>
                </el-row>
            </el-col>
        </el-row>

    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import Chart from 'chart.js';
    import * as am4core from "@amcharts/amcharts4/core";
    import * as am4charts from "@amcharts/amcharts4/charts";
    import am4themes_animated from "@amcharts/amcharts4/themes/animated";

    export default {
        created() {
            // this.$store.dispatch('setAuthUser')
        },
        computed: {
            // ...mapState({
            //     user: state => state.AuthUser,
            // })
        },

        data() {
            return {
                currentDate: new Date(),
                areas: [],
                chartX: [],
                feeY: [],
                itemsNum: [],
                startNum: [],
                endNum: [],
                percentageNum: '0',
                homeTotal: {
                    ten_fee: '198.32',
                    fee: '1800.38',
                    ten_fee_radio: '11',
                    item_sum: '203',
                    item_sum_foreign: '',
                    item_sum_all: '377',
                    item_sum_ratio: '54',
                    item_start: '127',
                    item_start_ratio: '34',
                    item_finish: '44',
                    item_finish_ratio: '12'
                },
                year_at: '2018',
                totalTitle: '2018年全市双招双引项目情况',
                areaTitle: '2018年各区双招双引项目情况',
                chartTitle: '2018年各区双招双引图表对比',
                item_sum_ratio: '',
                industryArray:[],
                cityArray:[]
            }

        },
        mounted() {
            let date = new Date;
            let year = date.getFullYear();
            axios.post('/api/v1/home/total/' + year).then(response => {
                window.localStorage.setItem('homeTotal',JSON.stringify(response.data));
            })
            this.homeTotal = JSON.parse(localStorage.getItem('homeTotal'));
            axios.post('/api/v1/home/industryChart/' + year).then(response => {
                window.localStorage.setItem('industryArray',JSON.stringify(response.data));
                console.log(response.data)
            })
            this.industryArray = JSON.parse(localStorage.getItem('industryArray'));
            axios.post('/api/v1/home/cityChart/' + year).then(response => {
                window.localStorage.setItem('cityArray',JSON.stringify(response.data));
            })
            this.cityArray = JSON.parse(localStorage.getItem('cityArray'));
            const formData = {
                id: this.areaId,
                year_at: this.year_at,
            }
            axios.post('/api/v1/area/areaStatistics', formData).then(response => {
                window.localStorage.setItem('areas',JSON.stringify(response.data));
                this.indexChart()
                this.industryChart()
                this.cityChart()
            })
            this.areas = JSON.parse(localStorage.getItem('areas'));

        },
        methods: {
            queryYearNow: function () {
                this.year_at = '2018'
                axios.post('/api/v1/home/total/' + this.year_at).then(response => {
                    this.homeTotal = response.data
                    this.totalTitle = '2018年全市双招双引项目情况'
                    this.areaTitle = '2018年各区双招双引项目情况'
                    this.chartTitle = '2018年各区双招双引图表对比'
                })
                axios.post('/api/v1/home/industryChart/' + this.year_at).then(response => {
                    window.localStorage.setItem('industryArrayNow',JSON.stringify(response.data));
                })
                axios.post('/api/v1/home/cityChart/' + this.year_at).then(response => {
                    window.localStorage.setItem('cityArrayNow',JSON.stringify(response.data));
                })
                const formData = {
                    year_at: this.year_at,
                }
                axios.post('/api/v1/area/areaStatistics', formData).then(response => {
                    this.areas = response.data
                    this.indexChart()
                    this.industryChart()
                    this.cityChart()
                })
                this.industryArray = JSON.parse(localStorage.getItem('industryArrayNow'));
                this.cityArray = JSON.parse(localStorage.getItem('cityArrayNow'));
            },
            queryYearLast: function () {
                this.year_at = '2017'
                axios.post('/api/v1/home/total/' + this.year_at).then(response => {
                    this.homeTotal = response.data
                    this.totalTitle = '2017年全市双招双引项目情况'
                    this.areaTitle = '2017年各区双招双引项目情况'
                    this.chartTitle = '2017年各区双招双引图表对比'
                })
                axios.post('/api/v1/home/industryChart/' + this.year_at).then(response => {
                    window.localStorage.setItem('industryArrayLast',JSON.stringify(response.data));
                })
                axios.post('/api/v1/home/cityChart/' + this.year_at).then(response => {
                    window.localStorage.setItem('cityArrayLast',JSON.stringify(response.data));
                })
                const formData = {
                    year_at: this.year_at,
                }
                axios.post('/api/v1/area/areaStatistics', formData).then(response => {
                    this.areas = response.data
                    this.indexChart()
                    this.industryChart()
                    this.cityChart()
                })
                this.industryArray = JSON.parse(localStorage.getItem('industryArrayLast'));
                this.cityArray = JSON.parse(localStorage.getItem('cityArrayLast'));
            },
            areaStatistics: function () {
                const formData = {
                    id: this.areaId,
                    year_at: this.year_at,
                }
                axios.post('/api/v1/area/areaStatistics', formData).then(response => {
                })
            },
            ranking: function () {
                const formData = {
                    querySort: 'item_sum_all',
                    year_at: this.year_at,
                }
                axios.post('/api/v1/area/areaStatistics', formData).then(response => {
                    this.areas = response.data
                    this.indexChart()
                    this.industryChart()
                    this.cityChart()
                })
            },

            rankingStart: function () {
                const formData = {
                    querySort: 'item_start',
                    year_at: this.year_at,
                }
                axios.post('/api/v1/area/areaStatistics', formData).then(response => {
                    this.areas = response.data
                    this.indexChart()
                    this.industryChart()
                    this.cityChart()
                })
            },
            rankingEnd: function () {
                const formData = {
                    querySort: 'item_finish',
                    year_at: this.year_at,
                }
                axios.post('/api/v1/area/areaStatistics', formData).then(response => {
                    this.areas = response.data
                    this.indexChart()
                    this.industryChart()
                    this.cityChart()
                })
            },
            indexChart: function () {
                let chartX = []
                let feeY = []
                let itemsNum = []
                let startNum = []
                let endNum = []
                for (let i = 0; i < this.areas.length; i++) {
                    chartX[i] = this.areas[i].district
                    feeY[i] = this.areas[i].ten_fee
                    itemsNum[i] = this.areas[i].item_sum_all
                    startNum[i] = this.areas[i].item_start
                    endNum[i] = this.areas[i].item_finish
                }
                let ctx = document.getElementById("myChart");
                let myChart = new Chart(ctx, {
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
            },
            industryChart: function () {
                am4core.useTheme(am4themes_animated);
                let chart = am4core.create("industryChart", am4charts.PieChart3D);
                chart.hiddenState.properties.opacity = 0;

                chart.data = this.industryArray;
                chart.radius = am4core.percent(70);
                chart.innerRadius = am4core.percent(40);
                chart.depth = 120;

                chart.legend = new am4charts.Legend();
                chart.legend.position = "bottom";

                let series = chart.series.push(new am4charts.PieSeries3D());
                series.dataFields.value = "industryNum";
                series.dataFields.depthValue = "industryNum";
                series.dataFields.category = "industryName";
                series.slices.template.cornerRadius = 5;
                series.colors.step = 3;
            },
            cityChart: function () {
                am4core.useTheme(am4themes_animated);
                let chart = am4core.create("cityChart", am4charts.XYChart);
                chart.data = this.cityArray;
                // let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                // categoryAxis.dataFields.category = "cityName";
                //
                // let  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                //
                // let series = chart.series.push(new am4charts.ColumnSeries());
                // series.dataFields.valueY = "cityNum";
                // series.dataFields.categoryX = "cityName";
                // series.name = "个";
                // series.tooltipText = "[bold]{valueY}[/] {name}";
                // series.columns.template.fill = am4core.color("#34BEF8");
                // chart.cursor = new am4charts.XYCursor();
                let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.dataFields.category = "cityName";
                categoryAxis.renderer.minGridDistance = 20;

                let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                let series = chart.series.push(new am4charts.CurvedColumnSeries());
                series.dataFields.categoryX = "cityName";
                series.dataFields.valueY = "cityNum";
                series.tooltipText = "{valueY.value}"
                series.columns.template.strokeWidth = 0;
                series.columns.template.tension = 0;

                chart.cursor = new am4charts.XYCursor();

                series.columns.template.adapter.add("fill", (fill, target) => {
                    return chart.colors.getIndex(target.dataItem.index);
                });
            }
        }
    }
</script>

<style>
    .page-index{
        margin: 20px;
    }
    .home .title {
        font-size: 20px;
        font-weight: 400;
        padding: 5px 0 20px 0;
    }

    .home .ranking {
        margin-bottom: 20px;
    }

    .home .chart {
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

    .home .el-card {
        border-left: 3px solid #6eb98e;
        margin-bottom: 10px;
        min-width: 200px;
    }

    .home .ranking .el-card {
        border-left: 1px solid #ebeef5;
        margin-bottom: 10px;
        min-width: 200px;
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
        font-size: 30px;
        font-weight: 700;
        color: #f85e13;
    }

    .item-fee {
        font-size: 30px;
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
        font-size: 30px;
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

    .blue {
        color: #368ec9;
    }

    .red {
        color: #f06307;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
    }

    .blue-input {
        color: #40aec9;
        border-bottom: 1px solid #40aec9;
        border-radius: 5px;
    }

    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #f06307;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .page-link:hover {
        color: #f06307;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .el-table .warning-row {
        background: oldlace;
    }

    .el-table .success-row {
        background: #f0f9eb;
    }

    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 80px;
        margin: 0 1px 1px 0;
    }

    .mg-news .card-img {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }

    .bd-example-border-utils [class^=border] {
        display: inline-block;
        width: 18%;
        height: 5rem;
        margin: .25rem;
        background-color: #f5f5f5;
    }

    .el-button + .el-button {
        margin-left: 0px;
        /*margin-top: 3px;*/
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }

    .mg-upload-image .el-upload--picture-card {
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
        border-radius: 6px;
        box-sizing: border-box;
        width: 82px;
        height: 82px;
        line-height: 82px;
        vertical-align: top;
    }

    .mg-upload-image .el-upload-list--picture-card .el-upload-list__item {
        width: 82px;
        height: 82px;
    }

    .tags .el-select {
        display: block;
    }

    .el-date-table td.current:not(.disabled) span {
        color: #fff;
        background-color: #f06307;
    }

    .el-date-table td.today span {
        color: #f06307;
        font-weight: 700;
    }

    .el-radio__input.is-checked .el-radio__inner {
        border-color: #f06307;
        background: #f06307;
    }

    .el-radio__input.is-checked + .el-radio__label {
        color: #f06307;
    }

    .el-button--primary {
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
    }

    .tags .el-select {
        display: block;
    }

    .el-slider__bar {
        background-color: #f06307;
    }

    .el-slider__button {
        border: 2px solid #f06307;
        background-color: #fff;
    }

    .el-switch.is-checked .el-switch__core {
        border-color: #f06307;
        background-color: #f06307;
    }

    .el-range-editor.is-active, .el-range-editor.is-active:hover {
        border-color: #f06307;
    }

    .el-select .el-input.is-focus .el-input__inner {
        border-color: #f06307;
    }

    .el-input__inner:focus {
        border-color: #f06307;
        outline: 0;
    }

    .el-select-dropdown.is-multiple .el-select-dropdown__item.selected {
        color: #f06307;
        background-color: #fff;
    }

    .el-select-dropdown__item.selected {
        color: #f06307;
        font-weight: 700;
    }

    .el-date-table td.end-date span, .el-date-table td.start-date span {
        background-color: #f06307;
    }

    .is-payment .el-switch__label.is-active {
        color: #f06307;
    }

    .is-state .el-switch__label.is-active {
        color: rgb(135, 204, 130);
    }

    .el-button:focus, .el-button:hover {
        background: #28a745 !important;
        border-color: #28a745 !important;
        color: #fff;
    }

    .checkLocation-button {
        padding: 2px !important;
    }

    .selectClassify .el-select .el-input {
        width: 130px;
    }

    .input-with-select .el-input-group__prepend {
        background-color: #fff;
    }

    .el-pager li.active {
        color: #f06307;
        cursor: default;
    }

    .el-pager li:hover {
        color: #f06307;
        cursor: default;
    }

    .el-pagination button:hover {
        color: #f06307;
    }

    .broad-title {
        font-size: 20px;
    }

    .el-radio-group {
        vertical-align: unset;
    }

    .news-img {
        margin-left: 80px;
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }

    .mg-upload-image .el-upload--picture-card {
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
        border-radius: 6px;
        box-sizing: border-box;
        width: 82px;
        height: 82px;
        line-height: 82px;
        vertical-align: top;
    }

    .mg-upload-image .el-upload-list--picture-card .el-upload-list__item {
        width: 82px;
        height: 82px;
    }

    .el-upload-list--picture-card .el-upload-list__item {
        overflow: hidden;
        background-color: #fff;
        border: 1px solid #c0ccda;
        border-radius: 6px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        width: 82px;
        height: 82px;
        margin: 0 8px 8px 0;
        display: inline-block;
    }

    .tags .el-select {
        display: block;
    }

    .batch_number {
        display: table-cell;
        vertical-align: middle;
    }

    .batch-number {
        float: left;
        text-align: center;
        width: 34px;
        height: 34px;
        line-height: 12px;
        border: 1px solid #f4f4f4;
        border-radius: 5px;
        background-color: #fff;
        margin: 0 2px 2px 0;
    }

    .batch-number-name {
        position: absolute;
        top: 50%;
        height: 240px;
        margin-top: -120px;
    }

    .pics {
        border-radius: 5px;
        float: left;
        padding: 0 2px 2px 0;
    }

    .edit-pic {
        border-radius: 5px;
        float: left;
        padding: 0 2px 2px 0;
    }

    .textarea-width {
        width: 550px !important;
    }

    .el-table .warning-row {
        background: oldlace;
    }

    .el-table .success-row {
        background: #f0f9eb;
    }

    .el-dialog__header {
        border-bottom: 1px solid #f5f5f5;
    }

    .group-input {
        border-top: 1px dashed #D6DEE2;
        padding-top: 20px;
    }

    .el-row {
        display: block;
    }

    .el-row .el-col {
        text-align: left;
    }

    .el-pagination {
        margin: 20px 0;
    }

    .fee-add {
        background-color: #f5f8fa;
        border-radius: 10px;
        border: 1px solid #f5f8fa;
    }

    .fee-add .el-form-item {
        margin: 10px 0;
    }

    .fee-add .fee-button {
        margin: 13px 0;
    }

    .fee-add label {
        margin-bottom: 0;
    }

    .el-row {
        margin-bottom: 5px;
    }

    .el-col {
        border-radius: 4px;
    }

    .bg-purple-dark {
        background: #99a9bf;
    }

    .bg-purple {
        background: #f9f2f0;
    }

    .bg-purple-light {
        background: #f4f5f9;
    }

    .grid-content {
        border-radius: 20px;
        min-height: 36px;
        line-height: 36px;
        text-align: center;
    }

    .row-bg {
        padding: 10px 0;
        background-color: #f9fafc;
    }

    .fees {
        font-size: 16px;
        color: #505050;
        padding-right: 10px;
    }

    .fees-price {
        font-size: 28px;
        font-weight: 700;
        color: #f85e13;
    }
    #industryChart {
        width: 100%;
        min-height: 500px;
    }
    #cityChart {
        width: 100%;
        min-height: 500px;
    }

</style>
