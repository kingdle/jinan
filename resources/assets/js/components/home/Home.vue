<template>
    <div class="home">
        <div style="padding: 14px 0;">
            <div class="title">
                <img src="/images/city.png" class="icon">
                <vgl-rollup text="全市双招双创项目情况"></vgl-rollup>
            </div>
            <el-row :gutter="10">
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="hover">
                        <el-row :gutter="0">
                            <el-col :span="16"><p class="fee-num">项目个数</p>
                                <span class="items-num">580</span>个
                            </el-col>
                            <el-col :span="8">
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="hover">
                        <el-row :gutter="0">
                            <el-col :span="16"><p class="fee-num">十强产业到位资金</p>
                                <span class="item-fee">100</span>亿元
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="70" color="#f85e13" :width="70"></el-progress>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="hover">
                        <el-row :gutter="0">
                            <el-col :span="16"><p class="fee-num">开工项目数</p>
                                <span class="item-fee">45</span>个
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="70" color="#16A1C0" :width="70"></el-progress>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="hover">
                        <el-row :gutter="10">
                            <el-col :span="16"><p class="fee-num">竣工项目数</p>
                                <span class="item-fee">15</span>个
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="25" color="#28a42f" :width="70"></el-progress>
                            </el-col>
                        </el-row>
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
            <el-row :gutter="10">
                <el-col :xs="24" :sm="24" :md="12" :lg="4" :xl="3" v-for="(area,index) in areas" :key="index">
                    <el-card :body-style="{ padding: '0px'}" shadow="hover">
                        <el-row :gutter="0">
                            <el-col :xs="24" :sm="12" :md="12" :lg="24" :xl="24">
                                <div class="items" style="padding: 8px;">
                                <img :src="area.pic +'!mp.v200'" class="image-district">
                                <div class="district">
                                    <p class="district-name">{{area.district}}</p>
                                    <p>￥<span class="items-district-num">{{area.fee}}</span>亿元</p>
                                </div>
                            </div>
                            </el-col>
                            <el-col :xs="24" :sm="12" :md="12" :lg="24" :xl="24">
                                <div style="padding:8px 14px;font-size:12px; color:#6f7180;">
                                    <p>项目: {{ area.items_num }}个,开工 {{area.start_num}}个，竣工 {{area.end_num}}个</p>
                                </div>
                            </el-col>
                        </el-row>


                    </el-card>
                </el-col>
            </el-row>
        </div>

        <div class="title">
            <img src="/images/charts.png" class="icon">
            <vgl-rollup text="双招双创图表对比"></vgl-rollup>
            <div style="float: right;">
                <el-button type="info" size="mini" icon="el-icon-menu" round @click="rankingFee">十强产业到位资金排名</el-button>
                <el-button type="primary" size="mini" round @click="ranking">项目数排名</el-button>
                <el-button type="warning" size="mini" round @click="rankingStart">开工数排名</el-button>
                <el-button type="danger" size="mini" round @click="rankingEnd">竣工数排名</el-button>
            </div>
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
                chartX: [],
                feeY: [],
                itemsNum: [],
                startNum: [],
                endNum: []
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
                this.chartX = chartX
                this.feeY = feeY
                this.itemsNum = itemsNum
                this.startNum = startNum
                this.endNum = endNum
                this.indexChart(this.chartX, this.feeY, this.itemsNum, this.startNum, this.endNum)
            })


        },
        methods: {
            rankingFee: function () {
                axios.get('/api/v1/area/ranking/' + 'fee').then(response => {
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
                    this.chartX = chartX
                    this.feeY = feeY
                    this.itemsNum = itemsNum
                    this.startNum = startNum
                    this.endNum = endNum
                    this.indexChart(this.chartX, this.feeY, this.itemsNum, this.startNum, this.endNum)
                })
            },
            ranking: function () {
                axios.get('/api/v1/area/ranking/' + 'items_num').then(response => {
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
                    this.chartX = chartX
                    this.feeY = feeY
                    this.itemsNum = itemsNum
                    this.startNum = startNum
                    this.endNum = endNum
                    this.indexChart(this.chartX, this.feeY, this.itemsNum, this.startNum, this.endNum)
                })
            },
            rankingStart: function () {
                axios.get('/api/v1/area/ranking/' + 'start_num').then(response => {
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
                    this.chartX = chartX
                    this.feeY = feeY
                    this.itemsNum = itemsNum
                    this.startNum = startNum
                    this.endNum = endNum
                    this.indexChart(this.chartX, this.feeY, this.itemsNum, this.startNum, this.endNum)
                })
            },
            rankingEnd: function () {
                axios.get('/api/v1/area/ranking/' + 'end_num').then(response => {
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
                    this.chartX = chartX
                    this.feeY = feeY
                    this.itemsNum = itemsNum
                    this.startNum = startNum
                    this.endNum = endNum
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
    .home .el-card{
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
        font-size: 28px;
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
    .fee-add{
        background-color: #f5f8fa;
        border-radius: 10px;
        border:1px solid #f5f8fa;
    }
    .fee-add .el-form-item {
        margin: 10px 0;
    }
    .fee-add .fee-button {
        margin: 13px 0;
    }
    .fee-add label{
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
        line-height:36px;
        text-align: center;
    }
    .row-bg {
        padding: 10px 0;
        background-color: #f9fafc;
    }
    .fees{
        font-size: 16px;
        color: #505050;
        padding-right: 10px;
    }
    .fees-price{
        font-size: 28px;
        font-weight: 700;
        color: #f85e13;
    }

</style>s
