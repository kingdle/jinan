<template>
    <div class="mg-news">
        <el-dialog title="新建收费类别" :visible.sync="dialogFormVisible">
            <el-form :inline="true" ref="addForm" :model="addForm" label-width="130px" size="medium">
                <div>
                    <el-form-item label="费用名称">
                        <el-input class="textarea-width" type="input" v-model="addForm.fee_name"
                                  clearable
                                  placeholder="掏箱费"></el-input>
                    </el-form-item>
                </div>
                <el-form-item label="收费标准">
                    <el-input v-model="addForm.fee_scale"
                              clearable
                              placeholder="10.00">
                    </el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input v-model="addForm.fee_remark"
                              clearable
                              placeholder="填写备注信息"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="addBroad">确 定</el-button>
            </div>
        </el-dialog>
        <el-dialog title="编辑收费类别" :visible.sync="dialogEditFormVisible">
            <el-form :inline="true" ref="addForm" :model="addForm" label-width="130px" size="medium">
                <div>
                    <el-form-item label="费用名称">
                        <el-input class="textarea-width" type="input" v-model="editForm.fee_name"
                                  clearable
                                  placeholder="掏箱费"></el-input>
                    </el-form-item>
                </div>
                <el-form-item label="收费标准">
                    <el-input v-model="editForm.fee_scale"
                              clearable
                              placeholder="10.00">
                    </el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input v-model="editForm.fee_remark"
                              clearable
                              placeholder="填写备注信息"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogEditFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="updateFee">保 存</el-button>
            </div>
        </el-dialog>
        <el-container>
            <el-header
                    style="text-align: right; font-size: 12px; background-color: #ffffff;border-bottom: 1px solid #f5f5f5;">
                <el-row>
                    <el-col :span="6">
                            <span class="broad-title">
                                <span class="text-success text-bold m-r-5">|</span>
                                基础费用管理
                            </span>
                    </el-col>
                    <el-col :span="12">

                    </el-col>
                    <el-col :span="6">
                        <el-button style="margin-right:10px;" type="primary"
                                   icon="el-icon-circle-plus"
                                   @click="dialogFormVisible = true">新增类别
                        </el-button>
                    </el-col>
                </el-row>
            </el-header>
            <el-table
                    :row-class-name="tableRowClassName"
                    @cell-dblclick="dialogFormVisible = true"
                    :data="fees"
                    align="left"
                    style="width: 100%"
            >
                <el-table-column
                        prop="id"
                        label="序号"
                        sortable
                        width="80"
                >
                </el-table-column>
                <el-table-column
                        prop="fee_name"
                        label="费用名"
                        sortable
                        width="200"
                >
                </el-table-column>
                <el-table-column
                        prop="fee_scale"
                        label="收费标准"
                        sortable
                        width="300"
                >
                </el-table-column>
                <el-table-column
                        prop="fee_remark"
                        label="备注"
                        sortable
                >
                </el-table-column>
                <el-table-column
                        fixed="right"
                        label="操作"
                        width="180"
                >
                    <template slot-scope="scope">
                        <el-tooltip class="item" effect="dark"
                                    content="编辑"
                                    placement="top">
                            <el-button
                                    @click="dialogEditFormVisible = true"
                                    @click.native.prevent="handleEdit(scope.$index, scope.row)"
                                    type="primary" icon="el-icon-edit"
                                    size="mini" circle>
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="item" effect="dark"
                                    content="删除"
                                    placement="top">
                            <el-button
                                    @click.native.prevent="handleDelete(scope.$index, scope.row)"
                                    type="info" icon="el-icon-delete"
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
                fees: [],
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
                addForm: {},
                editForm: {},
                copyForm: {},
                dialogFormVisible: false,
                dialogEditFormVisible: false,
                dialogCopyFormVisible: false,
                handlePreviewModal: false,
                pickerOptions2: {
                    shortcuts: [{
                        text: '三周后',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            end.setTime(start.getTime() + 3600 * 1000 * 24 * 21);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '一个月后',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            end.setTime(start.getTime() + 3600 * 1000 * 24 * 30);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '两个月后',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            end.setTime(start.getTime() + 3600 * 1000 * 24 * 60);
                            picker.$emit('pick', [start, end]);
                        }
                    }]
                },
                pic: '',
                pics: [],
                fileList: [],
                dialogImageUrl: '',
                dialogVisible: false,
                uploadAction: '/api/v1/payment/upFile',
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('jwt_token')
                },
                imageUrl: [],
                editImageUrl: [],
                queryName: [],
                stateName: '',
                queryDepartment: [],
                stateDepartment: '',
            }
        },
        mounted() {
            axios.get('/api/v1/fees').then(response => {
                this.fees = response.data.data
                this.pagination = response.data.meta
            })
//            this.queryName = this.loadNames()
//            this.queryDepartment = this.loadDepartments()
        },
        methods: {
            tableRowClassName({row, rowIndex}) {
                if (row.batch_number === '' || row.batch_number === null) {
                    return 'warning-row';
                }
                return '';
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/fees?page=' + page).then(response => {
                    this.fees = response.data.data
                })
            },
            handleSizeChange(pageSize) {
                this.pagination.per_page = pageSize
                const formData = {
                    pagination: pageSize,
                }
                axios.post('/api/v1/payment/listSize', formData).then(response => {
                    this.fees = response.data.data
                })
            },
            handleCurrentChange(page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/fees?page=' + page).then(response => {
                    this.fees = response.data.data
                })
            },
            Refresh(page) {
                axios.get('/api/v1/fees').then(response => {
                    this.fees = response.data.data
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
                    fee_name: this.addForm.fee_name,
                    fee_scale: this.addForm.fee_scale,
                    fee_remark: this.addForm.fee_remark,
                }
                axios.post('/api/v1/fees', formData).then(response => {
                    this.fees = response.data.fees
                    this.dialogFormVisible = false
                })
            },
            addCopyBroad() {
                const formData = {
                    fee_name: this.copyForm.fee_name,
                    fee_scale: this.copyForm.fee_scale,
                    fee_remark: this.copyForm.fee_remark,
                }
                axios.post('/api/v1/fees', formData).then(response => {
                    this.fees = response.data.fees
                    this.copyAbroadModalCenter = false
                    this.imageUrl = []
                    this.fileList = []
                    this.$refs.upload.clearFiles()
                })
            },
            handleEdit(index, row) {
                this.editForm.id= row.id
                this.editForm.fee_name = row.fee_name
                this.editForm.fee_scale = row.fee_scale
                this.editForm.fee_remark = row.fee_remark
                this.copyForm.fee_name = row.fee_name
                this.copyForm.fee_scale = row.fee_scale
                this.copyForm.fee_remark = row.fee_remark
            },
            updateFee(){
                const formData = {
                    id: this.editForm.id,
                    fee_name: this.editForm.fee_name,
                    fee_scale: this.editForm.fee_scale,
                    fee_remark: this.editForm.fee_remark,
                }
                axios.post('/api/v1/fee/update', formData).then(response => {
                    axios.get('/api/v1/fees?page=' + this.pagination.current_page).then(response => {
                        this.fees = response.data.data
                    })
                    this.dialogEditFormVisible = false

                })
            },
            handleDelete(index, row) {
                axios.delete('/api/v1/fees/' + row.id).then(response => {
                    axios.get('/api/v1/fees?page=' + this.pagination.current_page).then(response => {
                        this.fees = response.data.data
                    })
                })
            },
            loadNames() {
                return [
                    axios.get('/api/v1/payment/queryNameList').then(response => {
                        this.queryName = response.data
                    })
                ]
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
                    this.fees = response.data.data
                    this.pagination = response.data.meta
                })
            },
            DepartmentSelect(item) {
                const formData = {
                    department: item.value,
                }
                axios.post('/api/v1/payment/queryResult', formData).then(response => {
                    console.log(response.data)
                    this.fees = response.data.data
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
        width: 508px !important;
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
    .el-row{
        display: block;
    }
    .el-row .el-col{
        text-align: left;
    }
    .el-pagination{
        margin:20px 0;
    }
</style>
