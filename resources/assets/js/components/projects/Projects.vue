<template>
    <div class="home">
        <el-dialog title="项目详情" :visible.sync="showProject" width="80%" top="5vh">
            <el-form :inline="true" ref="showProjectForm" :model="showProjectForm" label-width="150px" size="medium">
                <div>
                    <el-form-item label="单位名">
                        <el-input class="textarea-width" type="input" v-model="showProjectForm.name"
                                  clearable
                                  :disabled="true"
                                  placeholder="济宁**有限公司"></el-input>
                    </el-form-item>
                </div>
                <el-form-item label="营业执照号">
                    <el-input class="text-code" v-model="showProjectForm.id_license"
                              clearable
                              :disabled="true"
                              placeholder=""></el-input>
                </el-form-item>
                <el-form-item label="注册日期">
                    <el-input v-model="showProjectForm.register_at"
                              clearable
                              :disabled="true"
                              placeholder="">
                    </el-input>
                </el-form-item>
                <div>
                    <el-form-item label="项目名称">
                        <el-input class="textarea-width" v-model="showProjectForm.item_name"
                                  clearable
                                  :disabled="true"
                                  placeholder=""></el-input>
                    </el-form-item>
                    <el-form-item label="建设地址">
                        <el-input v-model="showProjectForm.address"
                                  clearable
                                  :disabled="true"
                                  placeholder="">
                        </el-input>
                    </el-form-item>
                </div>
                <el-form-item label="区划代码">
                    <el-input v-model="showProjectForm.district_code"
                              clearable
                              :disabled="true"
                              placeholder="">
                    </el-input>
                </el-form-item>
                <el-form-item label="所属十强产业类别">
                    <el-input v-model="showProjectForm.industry_type"
                              clearable
                              :disabled="true"
                              placeholder="">
                    </el-input>
                </el-form-item>
                <el-form-item label="产品及服务说明">
                    <el-input v-model="showProjectForm.industry_description"
                              class="textarea-width"
                              clearable
                              type="textarea"
                              placeholder=""></el-input>
                </el-form-item>
                <el-form-item label="投资方">
                    <el-input v-model="showProjectForm.investor_name"
                              class="textarea-width"
                              clearable
                              type="textarea"
                              placeholder="">
                    </el-input>
                </el-form-item>
                <el-form-item label="是否纳统">
                    <el-input v-model="showProjectForm.is_statistics=='F'?'否':'是'"
                              clearable
                              :disabled="true"
                              placeholder="">
                    </el-input>
                </el-form-item>

                <el-form-item label="是否增资">
                    <el-input v-model="showProjectForm.is_additional=='F'?'否':'是'"
                              clearable
                              :disabled="true"
                              placeholder="">
                    </el-input>
                </el-form-item>

                <el-form-item label="计划总投资(万元)">
                    <el-input v-model="showProjectForm.fee"
                              clearable
                              :disabled="true"
                              placeholder="">
                    </el-input>
                </el-form-item>
                <el-form-item label="计划省外国资">
                    <el-input v-model="showProjectForm.fee_public_plan"
                              clearable
                              :disabled="true"
                              placeholder="30">
                    </el-input>
                </el-form-item>
                <el-form-item label="计划省外民资">
                    <el-input v-model="showProjectForm.fee_private_plan"
                              clearable
                              :disabled="true"
                              placeholder="20">
                    </el-input>
                </el-form-item>
                <el-form-item label="实际到账省外国资">
                    <el-input v-model="showProjectForm.fee_public_actual"
                              clearable
                              :disabled="true"
                              placeholder="">
                    </el-input>
                </el-form-item>
                <el-form-item label="实际到账省外民资">
                    <el-input v-model="showProjectForm.fee_private_actual"
                              clearable
                              :disabled="true"
                              placeholder="">
                    </el-input>
                </el-form-item>
                <div>
                    <el-form-item label="到账日期">
                        <el-input
                                class="textarea-width"
                                v-model="showProjectForm.bank_at"
                                type="textarea"
                                placeholder="">
                        </el-input>
                    </el-form-item>
                    <el-form-item label="银行进账单号">
                        <el-input
                                class="textarea-width"
                                v-model="showProjectForm.bank_bill"
                                type="textarea"
                                placeholder="">
                        </el-input>
                    </el-form-item>
                    <el-form-item label="银行名称">
                        <el-input
                                class="textarea-width"
                                v-model="showProjectForm.bank_name"
                                type="textarea"
                                placeholder="">
                        </el-input>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="联系人">
                        <el-input
                                v-model="showProjectForm.linkman"
                                placeholder="">
                        </el-input>
                    </el-form-item>
                    <el-form-item label="联系电话">
                        <el-input
                                v-model="showProjectForm.phone"
                                placeholder="">
                        </el-input>
                    </el-form-item>
                </div>
            </el-form>
            <div class="form-group news-img">
                <label class="col-form-label">项目附件:</label>
                <p>
                    <b v-for="(item,index) in showProjectForm.filesArray" @click="">
                        <a class="file-url" v-for="(url,key) in item" :href="url" target="_blank">
                            <i class="el-icon-document"></i>
                            {{key}}
                        </a>
                    </b>
                </p>
            </div>
            <div slot="footer" class="dialog-footer">
                <el-button @click="showProject = false">关 闭</el-button>
            </div>
        </el-dialog>
        <div style="padding: 14px 0;">
            <div class="title">
                <img src="/images/city.png" class="icon">
                {{year_at}}年<span class="district-title">{{areaTotal.district}}</span>双招双创项目情况
                <span class="remark">总投资规模：{{areaTotal.fee}}亿元，总项目数：{{areaTotal.item_sum_all}}个</span>
                <div style="float: right;">
                    <el-button type="success" size="mini" round @click="queryYearLast">2017年</el-button>
                    <el-button type="success" size="mini" round @click="queryYearNow">2018年</el-button>
                </div>
            </div>
            <el-row :gutter="10">
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="always">
                        <el-row :gutter="0">
                            <el-col :span="16"><p class="fee-num">到位资金项目个数</p>
                                <span class="items-num">{{areaTotal.item_sum}}</span>个
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="areaTotal.item_sum_ratio" color="#f85e13"
                                             :width="70"></el-progress>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="always">
                        <el-row :gutter="0">
                            <el-col :span="16"><p class="fee-num">十强产业到位资金</p>
                                <span class="item-fee">{{areaTotal.ten_fee}}</span>亿元
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="areaTotal.ten_fee_radio"
                                             color="#f85e13" :width="70"></el-progress>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="always">
                        <el-row :gutter="0">
                            <el-col :span="16"><p class="fee-num">开工项目数</p>
                                <span class="item-fee">{{areaTotal.item_start}}</span>个
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="areaTotal.item_start_ratio"
                                             color="#16A1C0" :width="70"></el-progress>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
                    <el-card shadow="always">
                        <el-row :gutter="10">
                            <el-col :span="16"><p class="fee-num">竣工项目数</p>
                                <span class="item-fee">{{areaTotal.item_finish}}</span>个
                            </el-col>
                            <el-col :span="8">
                                <el-progress type="circle" :percentage="areaTotal.item_finish_ratio"
                                             color="#28a42f" :width="70"></el-progress>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
            </el-row>
        </div>

        <el-row :gutter="0">
            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                <div class="tables">
                    <el-header
                            style="text-align: right; font-size: 12px; background-color: #ffffff;border-bottom: 1px solid #f5f5f5;">
                        <el-row>
                            <el-col :span="24">
                            <span class="broad-title">
                                <img src="/images/items-big.png" class="icon">
                                {{year_at}}年"十强"产业 <span class="items-num">{{pagination.total}}</span>家
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
                        >
                        </el-table-column>
                        <el-table-column
                                label="纳统"
                                width="60"
                        >
                            <template slot-scope="scope">
                                {{scope.row.is_statistics=='F'?'否':'是'}}
                            </template>
                        </el-table-column>
                        <el-table-column
                                prop="fee"
                                label="投资(万元)"
                                sortable
                                width="120"
                        >
                        </el-table-column>
                        <el-table-column
                                prop="industry_type"
                                label="所属产业"
                                width="120"
                        >
                        </el-table-column>
                        <el-table-column
                                prop="linkman"
                                label="联系人"
                                width="90"
                        >
                        </el-table-column>
                        <el-table-column
                                prop="phone"
                                label="联系电话"
                                width="120"
                        >
                        </el-table-column>
                        <el-table-column
                                prop="start_at"
                                label="开工时间"
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
                                            @click="showProject = true"
                                            @click.native.prevent="handleShowProject(scope.$index, scope.row)"
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
                            :page-sizes="[9, 20, 100, 300]"
                            :page-size="9"
                            :pager-count="pagerCount"
                            layout="total, prev, pager, next"
                            :total="pagination.total">
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
                areaTotal: {
                    ten_fee: 44.94,
                    fee: 178.76,
                    ten_fee_radio: 25,
                    item_sum: 26,
                    item_sum_all: 45,
                    item_sum_ratio: 58,
                    item_start: 11,
                    item_start_ratio: 24,
                    item_finish: 8,
                    item_finish_ratio: 18,
                    district: "",
                    pic: "https://images.qdbfg.com/jining/weishan.png",
                    id: "9"
                },
                year_at:'2018',
                areaId: '',
                area: {
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

                tProjects: [],
                tPagination: {
                    total: 0,
                    per_page: 0,
                    from: 0,
                    to: 0,
                    current_page: 1
                },
                tCurrentPage: '1',
                tOffset: 9,
                tPagerCount: 5,

                filesArray: [],
                items_num: "0",
                fee: "0",
                start_num: "0",
                end_num: "0",
                total: '',
                showProject: false,
                showProjectForm: {},
                showProjectFilesUrl: []
            }

        },
        mounted() {
            this.areaId = this.$route.params.id
            const formData = {
                area_id: this.areaId,
                year_at: this.year_at,
            }
            axios.post('/api/v1/project/queryArea', formData).then(response => {
                this.areaTotal = response.data
            })
            this.tenProjects()
        },
        methods: {
            queryYearNow: function () {
                this.year_at = '2018'
                let formDataNow = {
                    area_id: this.areaId,
                    year_at: '2018',
                }
                axios.post('/api/v1/project/queryArea', formDataNow).then(response => {
                    this.areaTotal = response.data
                })
                this.tenProjects()
            },
            queryYearLast: function () {
                this.year_at = '2017'
                let formDataLast = {
                    area_id: this.areaId,
                    year_at: '2017',
                }
                axios.post('/api/v1/project/queryArea', formDataLast).then(response => {
                    this.areaTotal = response.data
                })
                this.tenProjects()
            },
            tenProjects: function () {
                let that = this
                const formData = {
                    id: that.areaId,
                    year_at: that.year_at
                }
                axios.post('/api/v1/project/projectClassify', formData).then(response => {
                    that.projects = response.data.data
                    that.pagination = response.data.meta
                })
            },

            changePage: function (page) {
                let that = this
                const formData = {
                    id: that.areaId,
                    year_at: that.year_at
                }
                that.pagination.current_page = page;
                axios.post(that.pagination.path+'?page=' + page, formData).then(response => {
                    that.projects = response.data.data
                    that.pagination = response.data.meta
                })
            },
            handleSizeChange(pageSize) {
                let that = this
                that.pagination.per_page = pageSize
                const formData = {
                    id: that.areaId,
                    year_at: that.year_at
                }
                that.pagination.current_page = page;
                axios.post(that.pagination.path+'?page=' + pageSize, formData).then(response => {
                    that.projects = response.data.data
                    that.pagination = response.data.meta
                })
            },
            handleCurrentChange(page) {
                let that = this
                const formData = {
                    id: that.areaId,
                    year_at: that.year_at
                }
                that.pagination.current_page = page;
                axios.post(that.pagination.path+'?page=' + page, formData).then(response => {
                    that.projects = response.data.data
                    that.pagination = response.data.meta
                })
            },

            handleShowProject(index, row) {
                let self = this
                self.showProjectForm = row

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

    .text-code {
        width: 220px !important;
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
        min-width: 780px !important;
    }

    .middle-line {
        color: #fff;
    }

    .el-input.is-disabled .el-input__inner {
        background-color: #f5f7fa;
        border-color: #e4e7ed;
        color: #404482;
        cursor: not-allowed;
    }
</style>s
