<template>
    <div class="home">
        <div style="padding: 14px 0;">
            <div class="title">
                <img src="/images/city.png" class="icon">
                <span class="district-title">{{area.district}}</span>双招双创项目情况
            </div>
            <el-row :gutter="10">
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="always">
                        <el-row :gutter="0">
                            <el-col :span="16"><p class="fee-num">项目个数</p>
                                <span class="items-num">{{items_num}}</span>个
                            </el-col>
                            <el-col :span="8">
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="always">
                        <el-row :gutter="0">
                            <el-col :span="16"><p class="fee-num">十强产业到位资金</p>
                                <span class="item-fee">{{fee}}</span>亿元
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="fee" color="#f85e13" :width="70"></el-progress>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="always">
                        <el-row :gutter="0">
                            <el-col :span="16"><p class="fee-num">开工项目数</p>
                                <span class="item-fee">{{start_num}}</span>个
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="start_num" color="#16A1C0" :width="70"></el-progress>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="always">
                        <el-row :gutter="10">
                            <el-col :span="16"><p class="fee-num">竣工项目数</p>
                                <span class="item-fee">{{end_num}}</span>个
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="end_num+0" color="#28a42f" :width="70"></el-progress>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
            </el-row>
        </div>

            <el-row :gutter="0">
                <el-col :span="11">
                    <div class="tables">
                        <el-header
                                style="text-align: right; font-size: 12px; background-color: #ffffff;border-bottom: 1px solid #f5f5f5;">
                            <el-row>
                                <el-col :span="8">
                            <span class="broad-title">
                                <img src="/images/items-big.png" class="icon">
                                "十强"产业
                            </span>
                                </el-col>
                            </el-row>
                        </el-header>
                        <el-table
                                :row-class-name="tableRowClassName"
                                :data="projects"
                                align="left"
                                style="width: 100%"
                                stripe
                        >
                            <el-table-column
                                    prop="id"
                                    label="ID"
                                    sortable
                                    width="60"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="name"
                                    label="单位名称"
                                    sortable
                                    width="220"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="item_name"
                                    label="项目名称"
                                    sortable
                                    width="160"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="fee"
                                    label="投资(亿)"
                                    width="120"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="fee_count"
                                    label="累计投资(亿)"
                                    width="120"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="phone"
                                    label="联系电话"
                                    width="110"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="start_at"
                                    label="开工时间"
                                    width="100"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="produce_at"
                                    label="投产时间"
                                    width="100"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="end_at"
                                    label="竣工时间"
                                    width="100"
                            >
                            </el-table-column>

                            <el-table-column
                                    fixed="right"
                                    label="操作"
                                    width="60"
                            >
                                <template slot-scope="scope">
                                    <el-tooltip class="item" effect="dark"
                                                content="查看"
                                                placement="left">
                                        <el-button
                                                @click="addFeeFormVisible = true"
                                                @click.native.prevent="addFeeEdit(scope.$index, scope.row)"
                                                icon="el-icon-view"
                                                type="success"
                                                size="mini" circle>
                                        </el-button>
                                    </el-tooltip>
                                </template>
                            </el-table-column>
                        </el-table>
                        <el-pagination
                                @size-change="handleSizeChange"
                                @current-change="handleCurrentChange"
                                :current-page="currentPage"
                                :page-sizes="[9, 20, 100, 300]"
                                :page-size="9"
                                :pager-count="pagerCount"
                                layout="total, sizes, prev, pager, next, jumper"
                                :total="pagination.total">
                        </el-pagination>
                    </div>
                </el-col>
                <el-col :span="2">
                    <div class="middle-line">1</div>
                </el-col>
                <el-col :span="11">
                    <div class="tables">
                        <el-header
                                style="text-align: right; font-size: 12px; background-color: #ffffff;border-bottom: 1px solid #f5f5f5;">
                            <el-row>
                                <el-col :span="8">
                            <span class="broad-title">
                                <img src="/images/road.png" class="icon">
                                交通运输
                            </span>
                                </el-col>
                            </el-row>
                        </el-header>
                        <el-table
                                :row-class-name="tableRowClassName"
                                :data="tProjects"
                                align="left"
                                style="width: 100%"
                                stripe
                        >
                            <el-table-column
                                    prop="id"
                                    label="ID"
                                    sortable
                                    width="60"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="name"
                                    label="单位名称"
                                    sortable
                                    width="220"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="item_name"
                                    label="项目名称"
                                    sortable
                                    width="160"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="fee"
                                    label="投资(亿)"
                                    width="120"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="fee_count"
                                    label="累计投资(亿)"
                                    width="120"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="phone"
                                    label="联系电话"
                                    width="110"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="start_at"
                                    label="开工时间"
                                    width="100"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="produce_at"
                                    label="投产时间"
                                    width="100"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="end_at"
                                    label="竣工时间"
                                    width="100"
                            >
                            </el-table-column>
                            <!--<el-table-column-->
                            <!--label="附件"-->
                            <!--&gt;-->
                            <!--<template slot-scope="scope">-->
                            <!--<b v-for="(item,index) in scope.row.filesArray">-->
                            <!--<a class="file-url" v-for="(url,key) in item" :href="url" target="_blank">-->
                            <!--<i class="el-icon-document"></i>-->
                            <!--{{key}}-->
                            <!--</a></br>-->
                            <!--</b>-->
                            <!--</template>-->
                            <!--</el-table-column>-->
                            <el-table-column
                                    fixed="right"
                                    label="操作"
                                    width="60"
                            >
                                <template slot-scope="scope">
                                    <el-tooltip class="item" effect="dark"
                                                content="查看"
                                                placement="left">
                                        <el-button
                                                @click="addFeeFormVisible = true"
                                                @click.native.prevent="addFeeEdit(scope.$index, scope.row)"
                                                icon="el-icon-view"
                                                size="mini" circle
                                                type="success">
                                        </el-button>
                                    </el-tooltip>
                                </template>
                            </el-table-column>
                        </el-table>
                        <el-pagination
                                @size-change="handleSizeChange"
                                @current-change="tHandleCurrentChange"
                                :current-page="tCurrentPage"
                                :page-sizes="[9, 20, 100, 300]"
                                :page-size="9"
                                :pager-count="tPagerCount"
                                layout="total, sizes, prev, pager, next, jumper"
                                :total="tPagination.total">
                        </el-pagination>
                    </div>
                </el-col>
            </el-row>


    </div>
</template>

<script>
    import {mapState} from 'vuex'

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
                areaId:'',
                area:  {
                    fee: "0",
                    start_num: "0",
                    end_num: "0",
                },
                projects: [],
                pagination: {
                    total: 0,
                    per_page: 0,
                    from: 0,
                    to: 0,
                    current_page: 1
                },
                currentPage: 1,
                offset: 9,
                pagerCount: 5,

                tProjects:[],
                tPagination: {
                    total: 0,
                    per_page: 0,
                    from: 0,
                    to: 0,
                    current_page: 1
                },
                tCurrentPage:'1',
                tOffset: 9,
                tPagerCount: 5,

                filesArray: [],
                items_num:"0",
                fee:"0",
                start_num:"0",
                end_num:"0"
            }

        },
        mounted() {
            let that = this
            let areaId = that.$route.params.id
            that.areaId=areaId
            axios.get('/api/v1/areas/' + areaId).then(response => {
                that.area = response.data
                that.items_num=Number(response.data.items_num)
                that.fee=Number(response.data.fee)
                that.start_num=Number(response.data.start_num)
                that.end_num=Number(response.data.end_num)
            })
            // axios.get('/api/v1/project/areaProject/' + areaId).then(response => {
            //     if (response.data.status_code != 401) {
            //         that.projects = response.data.data
            //         that.pagination = response.data.meta
            //     }
            // })
            that.tenProjects()
            that.transportProjects()
        },
        methods: {
            tenProjects:function(){
                let that=this
                const formData = {
                    id: that.areaId,
                    industry_code: '123',
                }
                axios.post('/api/v1/project/projectClassify', formData).then(response => {
                    that.projects = response.data.data
                    that.pagination = response.data.meta
                    console.log(response.data)
                })
            },
            transportProjects:function(){
                let that=this
                const formData = {
                    id: that.areaId,
                    industry_code: '121211',
                }
                axios.post('/api/v1/project/projectClassify', formData).then(response => {
                    that.tProjects = response.data.data
                    that.tPagination = response.data.meta
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
            changePage: function (page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/projects?page=' + page).then(response => {
                    this.projects = response.data.data
                })
            },
            handleSizeChange(pageSize) {
                this.pagination.per_page = pageSize
                const formData = {
                    pagination: pageSize,
                }
                axios.post('/api/v1/payment/listSize', formData).then(response => {
                    this.projects = response.data.data
                })
            },
            handleCurrentChange(page) {
                // this.pagination.current_page = page;
                // axios.get('/api/v1/projects?page=' + page).then(response => {
                //     this.projects = response.data.data
                // })
                let that = this
                const formData = {
                    id: that.areaId,
                    industry_code: '123',
                }
                that.pagination.current_page = page;
                axios.post('/api/v1/project/projectClassify?page=' + page, formData).then(response => {
                    that.projects = response.data.data
                    that.pagination = response.data.meta
                })
            },
            tHandleCurrentChange(page) {
                // this.pagination.current_page = page;
                // axios.get('/api/v1/projects?page=' + page).then(response => {
                //     this.projects = response.data.data
                // })
                let that=this
                const formData = {
                    id: that.areaId,
                    industry_code: '121211',
                }
                that.tPagination.current_page = page;
                axios.post('/api/v1/project/projectClassify?page='+page, formData).then(response => {
                    that.tProjects = response.data.data
                    that.tPagination = response.data.meta
                })
            },
            tableRowClassName({row, rowIndex}) {
                if (row.batch_number === '' || row.batch_number === null) {
                    return 'warning-row';
                }
                return '';
            },
        }
    }
</script>

<style>
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

    .broad-title .icon {
        height: 20px;
        width: 20px;
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

    .el-header {
        padding: 0 5px !important;
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

    .file-url {
        width: 110px;
        height: 28px;
        line-height: 28px;
        color: #368ec9;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .el-dialog__wrapper {
        min-width: 780px;
    }
.middle-line{
    color: #fff;
}
</style>s
