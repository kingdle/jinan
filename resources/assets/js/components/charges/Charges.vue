<template>
    <div class="mg-news">
        <el-dialog title="新建计划" :visible.sync="dialogFormVisible">
            <el-form :inline="true" ref="addForm" :model="addForm" label-width="150px" size="medium">
                <div>
                    <el-form-item label="客户名称">
                        <el-input class="textarea-width" type="input" v-model="addForm.customer"
                                  clearable
                                  placeholder="青岛乾通源物流有限公司"></el-input>
                    </el-form-item>
                </div>
                <el-form-item label="品名">
                    <el-input v-model="addForm.goods_name"
                              clearable
                              placeholder="STR20-泰国混合橡胶">
                    </el-input>
                </el-form-item>
                <el-form-item label="包装">
                    <el-input v-model="addForm.packing"
                              clearable
                              placeholder="托盘10*20"></el-input>
                </el-form-item>
                <el-form-item label="清单号">
                    <el-input v-model="addForm.number_id"
                              clearable
                              placeholder="421020181000019180">
                    </el-input>
                </el-form-item>
                <el-form-item label="提单号">
                    <el-input v-model="addForm.extract_id"
                              clearable
                              placeholder="COAU7120923550"></el-input>
                </el-form-item>

                <el-form-item label="箱量净重(千克)">
                    <el-input-number v-model="addForm.weight_box"
                                     @input="weightBoxChange($event)"
                                     clearable
                                     placeholder="201600"
                                     size="mini"
                                     :precision="2">
                        <template slot="append">kg</template>
                    </el-input-number>
                </el-form-item>
                <el-form-item label="数量(吨)">
                    <el-input-number v-model="addForm.quantity"
                                     @input="quantityChange($event)"
                                     clearable
                                     placeholder="201.60"
                                     size="mini"
                                     :precision="2">
                        <template slot="append">t</template>
                    </el-input-number>
                </el-form-item>
                <el-form-item label="协议包干单价(元)">
                    <el-input-number v-model="addForm.price_income_package"
                                     @input="incomePackageChange($event)"
                                     clearable
                                     placeholder="110.00"
                                     size="mini"
                                     :precision="2">
                        <template slot="prepend">￥</template>
                    </el-input-number>
                </el-form-item>
                <el-form-item label="实际包干单价(元)">
                    <el-input-number v-model="addForm.price_cost_package"
                                     @input="costPackageChange($event)"
                                     clearable
                                     placeholder="12.08"
                                     size="mini"
                                     :precision="2">
                        <template slot="prepend">￥</template>
                    </el-input-number>
                </el-form-item>

                <div class="group-input">
                    <el-form-item label="包干费收入-小计(元)">
                        <el-input-number v-model="addForm.fee_bale_receivable"
                                         @input="baleReceivableChange($event)"
                                         placeholder="0.00"
                                         :precision="2"
                                         clearable
                                         :disabled="true">
                            <template slot="prepend">￥</template>
                        </el-input-number>
                    </el-form-item>
                    <el-form-item label="备注">
                        <el-input v-model="addForm.remarks"
                                  class="textarea-width"
                                  type="textarea"
                                  :rows="3"
                                  placeholder="特殊情况说明"></el-input>
                    </el-form-item>
                </div>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="addBroad">确 定</el-button>
            </div>
        </el-dialog>
        <el-dialog title="新增费用" :visible.sync="addFeeFormVisible">

            <el-row>
                <el-row>
                    <el-col :span="8"><div class="grid-content bg-purple">
                        应收：{{receivablesForm.fee_receivable}}
                    </div></el-col>
                    <el-col :span="8"><div class="grid-content bg-purple-light">
                        应付：{{receivablesForm.fee_payable}}
                    </div></el-col>
                    <el-col :span="8"><div class="grid-content bg-purple">
                        实际收入：{{receivablesForm.fee_payable}}
                    </div></el-col>
                </el-row>
            </el-row>
            <el-form class="fee-add" :inline="true" ref="addFeeForm" :model="addFeeForm" label-width="120px" size="medium">
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
                                出/入库收费
                            </span>
                    </el-col>
                    <el-col :span="10">
                        <div class="block">
                            <el-autocomplete
                                    v-model="stateName"
                                    :fetch-suggestions="querySearchAsync"
                                    placeholder="提单号"
                                    @select="handleSelect"
                                    prefix-icon="el-icon-search"
                            ></el-autocomplete>
                            <el-autocomplete
                                    v-model="stateName"
                                    :fetch-suggestions="querySearchAsync"
                                    placeholder="客户名"
                                    @select="handleSelect"
                                    prefix-icon="el-icon-search"
                            ></el-autocomplete>
                        </div>
                    </el-col>
                    <el-col :span="8">
                        <span class="fees">合计：<span class="fees-price">￥20000.00</span>元</span>
                        <el-button style="margin-right:10px;" type="primary"
                                   icon="el-icon-circle-plus"
                                   @click="dialogFormVisible = true">合并收费
                        </el-button>
                        <!--<el-button type="success" icon="el-icon-refresh"-->
                                   <!--@click="Refresh">刷新-->
                        <!--</el-button>-->
                    </el-col>
                </el-row>
            </el-header>
            <el-table
                    :row-class-name="tableRowClassName"
                    :data="payments"
                    align="left"
                    style="width: 100%"
                    stripe
            >
                <el-table-column
                        type="selection"
                        width="55">
                </el-table-column>
                <el-table-column
                        prop="extract_id"
                        label="提单号"
                        sortable
                        width="180"
                >
                </el-table-column>
                <el-table-column
                        prop="customer"
                        label="客户名称"
                        sortable
                        width="180"
                >
                </el-table-column>
                <el-table-column
                        prop="goods_name"
                        label="品名"
                        sortable
                        width="100"
                >
                </el-table-column>
                <el-table-column
                        prop="quantity"
                        label="数量(吨)"
                        sortable
                        width="120"
                >
                </el-table-column>
                <el-table-column
                        prop="price_income_package"
                        label="协议包干单价"
                        width="130"
                >
                </el-table-column>
                <el-table-column
                        prop="price_cost_package"
                        label="实际包干单价"
                        width="130"
                >
                </el-table-column>
                <el-table-column
                        prop="price_income_package"
                        label="应收(元)"
                        width="120"
                >
                </el-table-column>
                <el-table-column
                        prop="price_cost_package"
                        label="应付(元)"
                        width="120"
                >
                </el-table-column>
                <el-table-column
                        fixed="right"
                        label="操作"
                        width="160"
                >
                    <template slot-scope="scope">
                        <el-tooltip class="item" effect="dark"
                                    content="查看详细费用"
                                    placement="left">
                            <el-button
                                    @click="addFeeFormVisible = true"
                                    @click.native.prevent="addFeeEdit(scope.$index, scope.row)"
                                    icon="el-icon-view"
                                    size="mini" circle>
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="item" effect="dark"
                                    content="新增费用"
                                    placement="top">
                            <el-button
                                    @click="addFeeFormVisible = true"
                                    @click.native.prevent="addFeeEdit(scope.$index, scope.row)"
                                    type="success" icon="el-icon-plus"
                                    size="mini" circle>
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="item" effect="dark"
                                    content="确认收费"
                                    placement="top">
                            <el-button
                                    @click="editAbroadModalCenter = true"
                                    @click.native.prevent="handleEdit(scope.$index, scope.row)"
                                    type="primary" icon="el-icon-check"
                                    size="mini" circle>
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="item" effect="dark"
                                    content="打印入库单"
                                    placement="top">
                            <el-button
                                    @click.native.prevent="handleDelete(scope.$index, scope.row)"
                                    icon="el-icon-printer"
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
                receivables:[],
                receivablesForm:{},
                stateName:'',
                fees: [],
                copyForm: {},
                dialogTableVisible: false,
                dialogFormVisible: false,
                addFeeFormVisible: false,
            }
        },
        mounted() {
            axios.get('/api/v1/payments').then(response => {
                this.payments = response.data.data
                this.pagination = response.data.meta
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
            handleSuccess(response){
                this.filesUrl = response.photo
                this.imageUrl.push(this.filesUrl)
            },
            editSuccess(response){
                if (this.editImageUrl == null) {
                    this.editImageUrl = []
                }
                this.filesUrl = response.photo
                this.editImageUrl.push(this.filesUrl)
            },
            handleBefore(){
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
            addReceivable(){
                const formData = {
                    payment_id:this.receivablesForm.id,
                    fee_id:this.addFeeForm.fee_id,
                    fee_sum:this.addFeeForm.fee_sum,
                }
                axios.post('/api/v1/receivables', formData).then(response => {
                    const formData = {
                        payment_id : response.data.receivable.payment_id
                    }
                    axios.post('/api/v1/receivable/byPaymentId',formData).then(response => {
                        this.receivables = response.data.data
                    })
                })
            },
            addFeeEdit(index, row) {
                this.receivablesForm.id =row.id
                this.receivablesForm.fee_receivable =row.fee_receivable
                this.receivablesForm.fee_payable =row.fee_payable
                const formData = {
                    payment_id : this.receivablesForm.id

                }
                axios.post('/api/v1/receivable/byPaymentId',formData).then(response => {
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
            updateAbroad(){
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
</style>
