<template>
    <div class="mg-news">
        <el-dialog title="新建协议" :visible.sync="dialogFormVisible">
            <el-form ref="addForm" :model="addForm" label-width="80px" size="medium">
                <div>
                    <el-form-item label="客户名称">
                        <el-input type="input" v-model="addForm.customer"
                                  clearable
                                  placeholder="青岛乾通源物流有限公司"></el-input>
                    </el-form-item>
                </div>
                <el-form-item label="协议编号">
                    <el-input v-model="addForm.goods_name"
                              clearable
                              placeholder="20180001">
                    </el-input>
                </el-form-item>
                <el-form-item label="协议年度">
                    <el-input v-model="addForm.packing"
                              clearable
                              placeholder="201801"></el-input>
                </el-form-item>
                <el-form-item label="附件">
                    <el-upload
                            class="upload-demo"
                            action="https://jsonplaceholder.typicode.com/posts/"
                            :on-change="handleChange"
                            :file-list="fileList3">
                        <el-button size="small" type="primary">点击上传</el-button>
                    </el-upload>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input v-model="addForm.remarks"
                              class="textarea-width"
                              type="textarea"
                              :rows="3"
                              placeholder="特殊情况说明"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="addBroad">确 定</el-button>
            </div>
        </el-dialog>
        <el-dialog title="新增协议收费项" :visible.sync="addFeeFormVisible">
            <!--<el-row>-->
            <!--<el-row>-->
            <!--<el-col :span="8">-->
            <!--<div class="grid-content bg-purple">-->
            <!--应收：{{receivablesForm.fee_receivable}}-->
            <!--</div>-->
            <!--</el-col>-->
            <!--<el-col :span="8">-->
            <!--<div class="grid-content bg-purple-light">-->
            <!--应付：{{receivablesForm.fee_payable}}-->
            <!--</div>-->
            <!--</el-col>-->
            <!--<el-col :span="8">-->
            <!--<div class="grid-content bg-purple">-->
            <!--实际收入：{{receivablesForm.fee_payable}}-->
            <!--</div>-->
            <!--</el-col>-->
            <!--</el-row>-->
            <!--</el-row>-->
            <el-form class="fee-add" :inline="true" ref="addFeeForm" :model="addFeeForm" label-width="120px"
                     size="medium">
                <el-form-item label="费用类别">
                    <el-select v-model="addFeeForm.fee_id" filterable placeholder="请选择">
                        <el-option
                                v-for="item in fees"
                                :key="item.id"
                                :label="item.fee_name_scale"
                                :value="item.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="收费金额">
                    <el-input v-model="addFeeForm.fee_sum"
                              clearable
                              placeholder="10.00">
                    </el-input>
                </el-form-item>
                <el-button class="fee-button" type="primary" @click="addReceivable" size="mini">添加</el-button>
            </el-form>
            <el-table
                    :data="receivables"
                    style="width: 100%; margin-bottom: 20px;">
                <el-table-column
                        prop="fee_name"
                        label="费用名称"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="fee_sum"
                        label="金额"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="fee_scale"
                        label="收费标准">
                </el-table-column>
                <el-table-column
                        prop="fee_state"
                        label="是否支出项"
                        width="130"
                        :filters="[{ text: '未支出', value: '0' }, { text: '已支出', value: '1' }]"
                        :filter-method="filterTag"
                        filter-placement="bottom-end">
                    <template slot-scope="scope">
                        <el-tooltip content="标记是否支出项" placement="left">
                            <el-switch
                                    v-model="scope.row.fee_state"
                                    active-color="#B1AFAD"
                                    inactive-color="#87CC82"
                                    active-value="1"
                                    inactive-value="0"
                                    @click.native.prevent="updateState(scope.$index, scope.row)"
                            >
                            </el-switch>
                        </el-tooltip>
                    </template>
                </el-table-column>
            </el-table>
            <div slot="footer" class="dialog-footer">
                <el-button @click="addFeeFormVisible = false">关闭窗口</el-button>
            </div>
        </el-dialog>
        <el-container>
            <el-header
                    style="text-align: right; font-size: 12px; background-color: #ffffff;border-bottom: 1px solid #f5f5f5;">
                <el-row>
                    <el-col :span="6">
                            <span class="broad-title">
                                <span class="text-success text-bold m-r-5">|</span>
                                库位管理
                            </span>
                    </el-col>
                    <el-col :span="12">
                        <div class="block">
                            <el-autocomplete
                                    v-model="stateName"
                                    :fetch-suggestions="querySearchAsync"
                                    placeholder="查询"
                                    @select="handleSelect"
                                    prefix-icon="el-icon-search"
                            ></el-autocomplete>
                        </div>
                    </el-col>
                    <el-col :span="6">
                        <el-button style="margin-right:10px;" type="primary"
                                   icon="el-icon-rank"
                                   @click="dialogFormVisible = true">货物位置变更
                        </el-button>
                        <el-button type="success" icon="el-icon-refresh"
                                   @click="Refresh">刷新重置
                        </el-button>
                    </el-col>
                </el-row>
            </el-header>
            <el-row type="flex">
                <el-col :span="12">
                    <div class="source">
                        <el-row type="flex" class="row-bg row-title">
                            仓库1
                        </el-row>
                        <el-row type="flex" class="row-bg">
                            <el-col :span="3">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="5">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="2">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="3">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="center">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg row-title">
                            仓库2
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="end">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="space-between">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg row-title">
                            仓库3
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="space-around">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="space-around">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                        </el-row>
                    </div>
                </el-col>
                <el-col :span="12">
                    <div class="source">
                        <el-row type="flex" class="row-bg row-title">
                            仓库4
                        </el-row>
                        <el-row type="flex" class="row-bg">
                            <el-col :span="3">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="5">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="2">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="3">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="center">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg row-title">
                            仓库5
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="end">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="space-between">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg row-title">
                            仓库6
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="space-around">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row type="flex" class="row-bg" justify="space-around">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                        </el-row>
                    </div>
                </el-col>
            </el-row>


        </el-container>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        data() {
            return {
                payments: [],
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
                addForm: {
                    weight_box: '0.00',
                    quantity: '0.00',
                    price_income_package: '0.00',
                    price_cost_package: '0.00',
                    fee_bale_receivable: '0.00',
                },
                editForm: {},
                addFeeForm: {},
                receivables: [],
                receivablesForm: {},
                stateName: '',
                fees: [],
                copyForm: {},
                dialogTableVisible: false,
                dialogFormVisible: false,
                addFeeFormVisible: false,
                fileList3: [{
                    name: '青岛乾通源物流有限公司2018年度仓储协议.docx',
                    url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
                }, {
                    name: '青岛乾通源物流有限公司2018年度仓储协议2.docx',
                    url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
                }]
            }
        },
        mounted() {
            axios.get('/api/v1/payments').then(response => {
                // this.payments = response.data.data
                // this.pagination = response.data.meta
            })

            this.loadFeeList()
//            this.queryDepartment = this.loadDepartments()
        },
        methods: {
            filterTag(value, row) {
                return row.state === value;
            },
            weightBoxChange(e) {
                this.addForm.quantity = e * 0.001
                if (this.addForm.price_income_package !== undefined) {
                    this.addForm.fee_bale_receivable = this.addForm.quantity * this.addForm.price_income_package
                }
            },
            quantityChange(e) {
                this.addForm.weight_box = e * 1000
                if (this.addForm.price_income_package !== undefined) {
                    this.addForm.fee_bale_receivable = this.addForm.quantity * this.addForm.price_income_package
                }
            },
            incomePackageChange(e) {
                if (this.addForm.weight_box !== undefined) {
                    this.addForm.fee_bale_receivable = this.addForm.quantity * this.addForm.price_income_package
                }
            },
            tableRowClassName({row, rowIndex}) {
                if (row.batch_number === '' || row.batch_number === null) {
                    return 'warning-row';
                }
                return '';
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/payments?page=' + page).then(response => {
                    this.payments = response.data.data
                })
            },
            handleSizeChange(pageSize) {
                this.pagination.per_page = pageSize
                const formData = {
                    pagination: pageSize,
                }
                axios.post('/api/v1/payment/listSize', formData).then(response => {
                    this.payments = response.data.data
                })
            },
            handleCurrentChange(page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/payments?page=' + page).then(response => {
                    this.payments = response.data.data
                })
            },
            Refresh(page) {
                axios.get('/api/v1/payments').then(response => {
                    this.payments = response.data.data
                    this.pagination = response.data.meta
                    this.stateName = ''
                    this.stateDepartment = ''
                })
            },
            placeToDays: function (row, column) {
                if (row.days == null || row.days == '') {
                    var todays = ''
                } else {
                    todays = '(' + row.days + '天' + ')'
                }
                return row.place_to + todays;
            },
            timesToEnd: function (row, column) {
                return row.times_at_md + '至' + row.times_end_md;
            },
            batchNumber: function (row, column) {
                return row.batch_number
            },
            handleSuccess(response) {
                this.filesUrl = response.photo
                this.imageUrl.push(this.filesUrl)
            },
            editSuccess(response) {
                if (this.editImageUrl == null) {
                    this.editImageUrl = []
                }
                this.filesUrl = response.photo
                this.editImageUrl.push(this.filesUrl)
            },
            handleBefore() {
                return this.files.length === 9 ? false : true // 只让它上传一张
            },
            handleRemove(file, fileList) {
                console.log(fileList);
            },
            picRemove(image) {
                const formData = {
                    id: this.abroadEditForm.id,
                    pic: image,
                }
                axios.post('/api/v1/payment/destroyImage', formData).then(response => {
                    console.log(response.data)
                    this.editImageUrl = response.data
                })
            },
            handlePreview(image) {
                this.handlePreviewModal = true;
                this.dialogImageUrl = image;
            },
            handleExceed(files, fileList) {
                this.$message.warning(`当前限制选择 9 个文件，本次选择了 ${files.length} 个文件，共选择了 ${files.length + fileList.length} 个文件`);
            },
            addBroad() {
                const formData = {
                    customer: this.addForm.customer,
                    goods_name: this.addForm.goods_name,
                    packing: this.addForm.packing,
                    number_id: this.addForm.number_id,
                    extract_id: this.addForm.extract_id,
                    weight_box: this.addForm.weight_box,
                    quantity: this.addForm.quantity,
                    price_income_package: this.addForm.price_income_package,
                    price_cost_package: this.addForm.price_cost_package,
                    fee_receivable: this.addForm.fee_receivable,
                    fee_bale_receivable: this.addForm.fee_bale_receivable,
                    fee_before_receivable: this.addForm.fee_before_receivable,
                    fee_emergency_receivable: this.addForm.fee_emergency_receivable,
                    fee_storage_receivable: this.addForm.fee_storage_receivable,
                    fee_cleaning_box_receivable: this.addForm.fee_cleaning_box_receivable,
                    fee_adjusting_box_receivable: this.addForm.fee_adjusting_box_receivable,
                    fee_repair_box_receivable: this.addForm.fee_repair_box_receivable,
                    fee_payable: this.addForm.fee_payable,
                    fee_bale_payable: this.addForm.fee_bale_payable,
                    fee_before_payable: this.addForm.fee_before_payable,
                    fee_exchange_payable: this.addForm.fee_exchange_payable,
                    fee_harbor_payable: this.addForm.fee_harbor_payable,
                    fee_customs_payable: this.addForm.fee_customs_payable,
                    fee_inspection_agent_payable: this.addForm.fee_inspection_agent_payable,
                    fee_inspection_goods_payable: this.addForm.fee_inspection_goods_payable,
                    fee_inspection_payable: this.addForm.fee_inspection_payable,
                    fee_inspection_quarantine_payable: this.addForm.fee_inspection_quarantine_payable,
                    fee_dig_box_payable: this.addForm.fee_dig_box_payable,
                    fee_transport_short_payable: this.addForm.fee_transport_short_payable,
                    fee_emergency_payable: this.addForm.fee_emergency_payable,
                    fee_storage_payable: this.addForm.fee_storage_payable,
                    fee_cleaning_box_payable: this.addForm.fee_cleaning_box_payable,
                    fee_adjusting_box_payable: this.addForm.fee_adjusting_box_payable,
                    fee_repair_box_payable: this.addForm.fee_repair_box_payable,
                    remark: this.addForm.remark,
                }
                axios.post('/api/v1/payments', formData).then(response => {
                    this.payments = response.data.payments
                    this.dialogFormVisible = false
                })
            },
            addReceivable() {
                const formData = {
                    payment_id: this.receivablesForm.id,
                    fee_id: this.addFeeForm.fee_id,
                    fee_sum: this.addFeeForm.fee_sum,
                }
                axios.post('/api/v1/receivables', formData).then(response => {
                    const formData = {
                        payment_id: response.data.receivable.payment_id
                    }
                    axios.post('/api/v1/receivable/byPaymentId', formData).then(response => {
                        this.receivables = response.data.data
                    })
                })
            },
            addFeeEdit(index, row) {
                this.receivablesForm.id = row.id
                this.receivablesForm.fee_receivable = row.fee_receivable
                this.receivablesForm.fee_payable = row.fee_payable
                const formData = {
                    payment_id: this.receivablesForm.id

                }
                axios.post('/api/v1/receivable/byPaymentId', formData).then(response => {
                    this.receivables = response.data.data
                })
            },
            addCopyBroad() {
                const formData = {
                    names: this.abroadCopyForm.names,
                    number_id: this.abroadCopyForm.number_id,
                    department: this.abroadCopyForm.department,
                    gender: this.abroadCopyForm.gender,
                    age: this.abroadCopyForm.age,
                    duties: this.abroadCopyForm.duties,
                    level: this.abroadCopyForm.level,
                    system_part: this.abroadCopyForm.system_part,
                    place_to: this.abroadCopyForm.place_to,
                    batch_number: this.abroadCopyForm.batch_number,
                    funds: this.abroadCopyForm.funds,
                    remarks: this.abroadCopyForm.remarks,
                    sendDate: this.abroadCopyForm.sendDate,
                    by_group: this.abroadCopyForm.by_group,
                    visits_category: this.abroadCopyForm.visits_category,
                    reasons_visit: this.abroadCopyForm.reasons_visit,
                    pic: this.editImageUrl
                }
                axios.post('/api/v1/payments', formData).then(response => {
                    this.payments = response.data.payments
                    this.copyAbroadModalCenter = false
                    this.imageUrl = []
                    this.fileList = []
                    this.$refs.upload.clearFiles()
                })
            },
            handleEdit(index, row) {
                this.abroadEditForm.id = row.id
                this.abroadEditForm.number_id = row.number_id
                this.abroadEditForm.names = row.name
                this.abroadEditForm.department = row.department
                this.abroadEditForm.gender = row.gender
                this.abroadEditForm.age = row.age
                this.abroadEditForm.duties = row.duties
                this.abroadEditForm.level = row.level
                this.abroadEditForm.system_part = row.system_part
                this.abroadEditForm.place_to = row.place_to
                this.abroadEditForm.batch_number = row.batch_number
                this.abroadEditForm.funds = row.funds
                this.abroadEditForm.remarks = row.remarks
                this.abroadEditForm.sendDate = [row.times_at, row.times_end]
                this.abroadEditForm.by_group = row.by_group
                this.abroadEditForm.visits_category = row.visits_category
                this.abroadEditForm.reasons_visit = row.reasons_visit
                this.editImageUrl = row.pic
                this.abroadCopyForm.id = row.id
                this.abroadCopyForm.number_id = row.number_id
                this.abroadCopyForm.names = row.name
                this.abroadCopyForm.department = row.department
                this.abroadCopyForm.gender = row.gender
                this.abroadCopyForm.age = row.age
                this.abroadCopyForm.duties = row.duties
                this.abroadCopyForm.level = row.level
                this.abroadCopyForm.system_part = row.system_part
                this.abroadCopyForm.place_to = row.place_to
                this.abroadCopyForm.batch_number = row.batch_number
                this.abroadCopyForm.funds = row.funds
                this.abroadCopyForm.remarks = row.remarks
                this.abroadCopyForm.sendDate = [row.times_at, row.times_end]
                this.abroadCopyForm.by_group = row.by_group
                this.abroadCopyForm.visits_category = row.visits_category
                this.abroadCopyForm.reasons_visit = row.reasons_visit
            },
            updateAbroad() {
                const formData = {
                    id: this.abroadEditForm.id,
                    number_id: this.abroadEditForm.number_id,
                    names: this.abroadEditForm.names,
                    department: this.abroadEditForm.department,
                    gender: this.abroadEditForm.gender,
                    age: this.abroadEditForm.age,
                    duties: this.abroadEditForm.duties,
                    level: this.abroadEditForm.level,
                    system_part: this.abroadEditForm.system_part,
                    place_to: this.abroadEditForm.place_to,
                    batch_number: this.abroadEditForm.batch_number,
                    funds: this.abroadEditForm.funds,
                    remarks: this.abroadEditForm.remarks,
                    sendDate: this.abroadEditForm.sendDate,
                    by_group: this.abroadEditForm.by_group,
                    visits_category: this.abroadEditForm.visits_category,
                    reasons_visit: this.abroadEditForm.reasons_visit,
                    pic: this.editImageUrl
                }
                axios.post('/api/v1/payment/update', formData).then(response => {
                    axios.get('/api/v1/payments?page=' + this.pagination.current_page).then(response => {
                        this.payments = response.data.data
                    })
                    this.editAbroadModalCenter = false
                    this.imageEditUrl = []
                    this.fileList = []
                    this.$refs.upload.clearFiles()
                })
            },
            handleDelete(index, row) {
                axios.delete('/api/v1/payments/' + row.id).then(response => {
                    axios.get('/api/v1/payments?page=' + this.pagination.current_page).then(response => {
                        this.payments = response.data.data
                    })
                })
            },
            loadFeeList() {
                axios.get('/api/v1/feeList').then(response => {
                    this.fees = response.data.data
                })
            },
            loadDepartments() {
                return [
                    axios.get('/api/v1/payment/queryDepartmentList').then(response => {
                        this.queryDepartment = response.data
                    })
                ]
            },
            querySearchAsync(queryString, cb) {
                var queryName = this.queryName;
                var results = queryString ? queryName.filter(this.createStateFilter(queryString)) : queryName;

                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    cb(results);
                }, 1000 * Math.random());
            },
            querySearchDepartment(queryString, cb) {
                var queryDepartment = this.queryDepartment;
                var results = queryString ? queryDepartment.filter(this.createStateFilter(queryString)) : queryDepartment;

                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    cb(results);
                }, 1000 * Math.random());
            },
            createStateFilter(queryString) {
                return (state) => {
                    return (state.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                };
            },
            handleSelect(item) {
                const formData = {
                    name: item.value,
                }
                axios.post('/api/v1/payment/queryResult', formData).then(response => {
                    console.log(response.data)
                    this.payments = response.data.data
                    this.pagination = response.data.meta
                })
            },
            DepartmentSelect(item) {
                const formData = {
                    department: item.value,
                }
                axios.post('/api/v1/payment/queryResult', formData).then(response => {
                    console.log(response.data)
                    this.payments = response.data.data
                    this.pagination = response.data.meta
                })
            },
            handleChange(file, fileList) {
                this.fileList3 = fileList.slice(-3);
            }
        },

        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
        },
    }

</script>
<style>
    .broad-title {
        font-size: 28px;
    }

    .source {
        padding: 24px;
    }

    .source .row-bg {
        padding: 10px 0;
        background-color: #f9fafc;
    }

    .source .el-row {
        margin-bottom: 20px;
    }

    .source .el-row:last-child {
        margin-bottom: 0;
    }

    .source .el-col {
        border-radius: 4px;
        margin: 0 5px;
    }

    .source .bg-purple-dark {
        background: #99a9bf;
    }

    .source .bg-purple {
        background: #d3dce6;
    }

    .source .bg-purple-light {
        background: #e5e9f2;
    }

    .source .grid-content {
        border-radius: 4px;
        min-height: 36px;
    }

    .source .row-bg {
        padding: 10px 0;
        background-color: #f9fafc;
    }
    .source .row-title {
        text-align: center;
        color: #505050;
        font-weight: 700;
        background-color: #f9f9f9;
    }
</style>
