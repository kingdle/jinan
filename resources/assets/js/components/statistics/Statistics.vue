<template>
    <div class="mg-news">
        <el-dialog title="查看项目" :visible.sync="showProject" width="80%" top="5vh">
            <el-form :inline="true" ref="showProjectForm" :model="showProjectForm" label-width="150px" size="medium">
                <div>
                    <el-form-item label="单位名">
                        <el-input class="textarea-width" type="input" v-model="showProjectForm.name"
                                  clearable
                                  placeholder="济宁**有限公司"></el-input>
                    </el-form-item>
                </div>
                <el-form-item label="营业执照号">
                    <el-input class="text-code" v-model="showProjectForm.id_license"
                              clearable
                              placeholder="如：91370211MA3M6YNP9G"></el-input>
                </el-form-item>
                <el-form-item label="组织机构代码证">
                    <el-input v-model="showProjectForm.id_code"
                              clearable
                              placeholder="三证合一可不填">
                    </el-input>
                </el-form-item>
                <el-form-item label="注册类型">
                    <el-input v-model="showProjectForm.register_type"
                              clearable
                              placeholder="填写企业性质">
                    </el-input>
                </el-form-item>
                <div>
                    <el-form-item label="项目名称">
                        <el-input class="textarea-width" v-model="showProjectForm.item_name"
                                  clearable
                                  placeholder="填写项目名称"></el-input>
                    </el-form-item>
                    <el-form-item label="项目代码">
                        <el-input v-model="showProjectForm.item_code"
                                  clearable
                                  placeholder="37020181000019180">
                        </el-input>
                    </el-form-item>
                </div>
                <el-form-item label="项目所在区">
                    <el-input v-model="showProjectForm.district"
                              clearable
                              placeholder="">
                    </el-input>
                </el-form-item>
                <el-form-item label="联系电话">
                    <el-input v-model="showProjectForm.phone"
                              clearable
                              placeholder="18600001111">
                    </el-input>
                </el-form-item>
                <el-form-item label="行业编码">
                    <el-input v-model="showProjectForm.industry_code"
                              clearable
                              placeholder="如：121211"></el-input>
                </el-form-item>
                <el-form-item label="控股情况">
                    <el-input v-model="showProjectForm.holding"
                              clearable
                              placeholder="1国有2集体3私人4港澳台商5外商9其他">
                    </el-input>
                </el-form-item>
                <el-form-item label="隶属关系">
                    <el-input v-model="showProjectForm.subjection"
                              clearable
                              placeholder="10中央20省40市80县及以下90其他">
                    </el-input>
                </el-form-item>

                <el-form-item label="建设性质">
                    <el-input v-model="showProjectForm.item_nature"
                              clearable
                              placeholder="1新建2扩建3改建和技术改造4单纯建造生活设施5迁建6恢复7单纯购置">
                    </el-input>
                </el-form-item>
                <el-form-item label="项目类别">
                    <el-input v-model="showProjectForm.item_type"
                              clearable
                              placeholder="1工业企业技术改造2棚户区改造3涉农">
                    </el-input>
                </el-form-item>

                <el-form-item label="建设状态">
                    <el-input v-model="showProjectForm.item_state"
                              clearable
                              placeholder="1在建2全部投产3全部停缓建">
                    </el-input>
                </el-form-item>
                <el-form-item label="总投资(亿)">
                    <el-input v-model="showProjectForm.fee"
                              clearable
                              placeholder="30">
                    </el-input>
                </el-form-item>
                <el-form-item label="累计投资(亿)">
                    <el-input v-model="showProjectForm.fee_count"
                              clearable
                              placeholder="20">
                    </el-input>
                </el-form-item>
                <div>
                    <el-form-item label="开工时间">
                        <el-date-picker
                                v-model="showProjectForm.start_at"
                                type="date"
                                placeholder="选择日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="投产时间">
                        <el-date-picker
                                v-model="showProjectForm.produce_at"
                                type="date"
                                placeholder="选择日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="竣工时间">
                        <el-date-picker
                                v-model="showProjectForm.end_at"
                                type="date"
                                placeholder="选择日期">
                        </el-date-picker>
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
        <el-dialog title="新建项目" fullscreen :visible.sync="projectFormVisible">
            <el-form :inline="true" ref="addProjectForm" :model="addProjectForm" label-width="150px" size="medium">
                <div>
                    <el-form-item label="单位名">
                        <el-input class="textarea-width" type="input" v-model="addProjectForm.name"
                                  clearable
                                  placeholder="济宁**有限公司"></el-input>
                    </el-form-item>
                </div>
                <el-form-item label="营业执照号">
                    <el-input class="text-code" v-model="addProjectForm.id_license"
                              clearable
                              placeholder="如：91370211MA3M6YNP9G"></el-input>
                </el-form-item>
                <el-form-item label="组织机构代码证">
                    <el-input v-model="addProjectForm.id_code"
                              clearable
                              placeholder="三证合一可不填">
                    </el-input>
                </el-form-item>
                <el-form-item label="注册类型">
                    <el-input v-model="addProjectForm.register_type"
                              clearable
                              placeholder="填写企业性质">
                    </el-input>
                </el-form-item>
                <div>
                    <el-form-item label="项目名称">
                        <el-input class="textarea-width" v-model="addProjectForm.item_name"
                                  clearable
                                  placeholder="填写项目名称"></el-input>
                    </el-form-item>
                    <el-form-item label="项目代码">
                        <el-input v-model="addProjectForm.item_code"
                                  clearable
                                  placeholder="37020181000019180">
                        </el-input>
                    </el-form-item>
                </div>
                <el-form-item label="项目所在区">
                    <el-autocomplete
                            v-model="areaName"
                            :fetch-suggestions="querySearchAsync"
                            placeholder="所属区市"
                            @select="districtSelect"
                            prefix-icon="el-icon-search"
                    ></el-autocomplete>
                </el-form-item>
                <el-form-item label="联系电话">
                    <el-input v-model="addProjectForm.phone"
                              clearable
                              placeholder="18600001111">
                    </el-input>
                </el-form-item>
                <el-form-item label="行业编码">
                    <el-input v-model="addProjectForm.industry_code"
                              clearable
                              placeholder="如：121211"></el-input>
                </el-form-item>
                <el-form-item label="控股情况">
                    <el-input v-model="addProjectForm.holding"
                              clearable
                              placeholder="1国有2集体3私人4港澳台商5外商9其他">
                    </el-input>
                </el-form-item>
                <el-form-item label="隶属关系">
                    <el-input v-model="addProjectForm.subjection"
                              clearable
                              placeholder="10中央20省40市80县及以下90其他">
                    </el-input>
                </el-form-item>

                <el-form-item label="建设性质">
                    <el-input v-model="addProjectForm.item_nature"
                              clearable
                              placeholder="1新建2扩建3改建和技术改造4单纯建造生活设施5迁建6恢复7单纯购置">
                    </el-input>
                </el-form-item>
                <el-form-item label="项目类别">
                    <el-input v-model="addProjectForm.item_type"
                              clearable
                              placeholder="1工业企业技术改造2棚户区改造3涉农">
                    </el-input>
                </el-form-item>

                <el-form-item label="建设状态">
                    <el-input v-model="addProjectForm.item_state"
                              clearable
                              placeholder="1在建2全部投产3全部停缓建">
                    </el-input>
                </el-form-item>
                <el-form-item label="总投资(亿)">
                    <el-input v-model="addProjectForm.fee"
                              clearable
                              placeholder="30">
                    </el-input>
                </el-form-item>
                <el-form-item label="累计投资(亿)">
                    <el-input v-model="addProjectForm.fee_count"
                              clearable
                              placeholder="20">
                    </el-input>
                </el-form-item>
                <div>
                    <el-form-item label="开工时间">
                        <el-date-picker
                                v-model="addProjectForm.start_at"
                                type="date"
                                placeholder="选择日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="投产时间">
                        <el-date-picker
                                v-model="addProjectForm.produce_at"
                                type="date"
                                placeholder="选择日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="竣工时间">
                        <el-date-picker
                                v-model="addProjectForm.end_at"
                                type="date"
                                placeholder="选择日期">
                        </el-date-picker>
                    </el-form-item>
                </div>
            </el-form>
            <div class="form-group news-img">
                <label for="fileArray" class="col-form-label">项目附件:（最多同时上传9个）</label>
                <el-upload
                        ref="upload"
                        class="mg-upload-image"
                        :action="uploadAction"
                        list-type="fileList"
                        multiple
                        :limit="9"
                        :on-exceed="handleExceed"
                        :on-success="handleSuccess"
                        :on-remove="handleRemove"
                        :headers="header_project">
                    <el-button size="small" type="primary"><i class="el-icon-plus"></i>点击上传</el-button>
                </el-upload>
            </div>
            <div slot="footer" class="dialog-footer">
                <el-button @click="projectFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="addProject">确 定</el-button>
            </div>
        </el-dialog>
        <el-container>
            <el-header
                    style="text-align: right; font-size: 12px; background-color: #ffffff;border-bottom: 1px solid #f5f5f5;">
                <el-row>
                    <el-col :span="4">
                            <span class="broad-title">
                                <span class="text-success text-bold m-r-5">|</span>
                                项目列表
                            </span>
                    </el-col>
                    <el-col :span="17">
                        <div class="block">
                            <el-autocomplete
                                    v-model="areaName"
                                    :fetch-suggestions="querySearchAsync"
                                    placeholder="区市"
                                    @select="handleSelect"
                                    prefix-icon="el-icon-search"
                            ></el-autocomplete>
                            <el-date-picker
                                    v-model="dates"
                                    type="daterange"
                                    align="right"
                                    unlink-panels
                                    range-separator="-"
                                    start-placeholder="开始日期"
                                    end-placeholder="结束日期">
                            </el-date-picker>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <el-button style="margin-right:10px;" type="primary"
                                   icon="el-icon-plus"
                                   @click="projectFormVisible = true">新建项目
                        </el-button>
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
                        prop="district"
                        label="所在区"
                        sortable
                        width="100"
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
                        label="附件"
                >
                    <template slot-scope="scope">
                        <b v-for="(item,index) in scope.row.filesArray">
                            <a class="file-url" v-for="(url,key) in item" :href="url" target="_blank">
                                <i class="el-icon-document"></i>
                                {{key}}
                            </a></br>
                        </b>
                    </template>
                </el-table-column>
                <el-table-column
                        fixed="right"
                        label="操作"
                        width="120"
                >
                    <template slot-scope="scope">
                        <el-tooltip class="item" effect="dark"
                                    content="查看"
                                    placement="left">
                            <el-button
                                    @click="showProject = true"
                                    @click.native.prevent="handleShowProject(scope.$index, scope.row)"
                                    icon="el-icon-view"
                                    size="mini" circle>
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="item" effect="dark" content="删除"
                                    placement="right">
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

                addProjectForm: {

                },
                district:'',
                area_id:'',
                dialogTableVisible: false,
                projectFormVisible: false,
                addFeeFormVisible: false,
                fileArray:[],
                uploadAction: '/api/v1/project/upFile',
                header_project: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('jwt_token')
                },
                headers:'',
                areaName:'',
                areaList:[],
                timeout:null,
                dates:'',
                showProject: false,
                showProjectForm: {},
            }
        },
        mounted() {
            let that=this
            axios.get('/api/v1/projects').then(response => {
                that.projects = response.data.data
                that.pagination = response.data.meta
            })
            axios.get('/api/v1/area/queryArea').then(response => {
                that.areaList = response.data
            })

        },
        methods: {
            changePage: function (page) {
                this.pagination.current_page = page;
                axios.get(this.pagination.path +'/?page=' + page).then(response => {
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
                this.pagination.current_page = page;
                axios.get(this.pagination.path+'?page=' + page).then(response => {
                    this.projects = response.data.data
                    this.pagination = response.data.meta
                })
            },
            tableRowClassName({row, rowIndex}) {
                if (row.batch_number === '' || row.batch_number === null) {
                    return 'warning-row';
                }
                return '';
            },
            batchNumber: function (row, column) {
                return row.batch_number
            },
            handleSuccess(response){
                this.filesUrl = response.files
                this.fileArray.push(this.filesUrl)
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
                console.log(file.response.photo)
                console.log(this.fileArray)
            },
            picRemove(image) {
                const formData = {
                    id: this.abroadEditForm.id,
                    pic: image,
                }
                axios.post('/api/v1/payment/destroyImage', formData).then(response => {
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
            addProject() {
                let self=this
                const formData = {
                    name: self.addProjectForm.name,
                    id_code: self.addProjectForm.id_code,
                    id_license: self.addProjectForm.id_license,
                    item_code: self.addProjectForm.item_code,
                    item_name: self.addProjectForm.item_name,
                    register_type: self.addProjectForm.register_type,
                    district: self.district,
                    area_id: self.area_id,
                    phone: self.addProjectForm.phone,
                    industry_code: self.addProjectForm.industry_code,
                    holding: self.addProjectForm.holding,
                    subjection: self.addProjectForm.subjection,
                    item_nature: self.addProjectForm.item_nature,
                    item_type: self.addProjectForm.item_type,
                    start_at: self.addProjectForm.start_at,
                    end_at: self.addProjectForm.end_at,
                    produce_at: self.addProjectForm.produce_at,
                    item_state: self.addProjectForm.item_state,
                    fee: self.addProjectForm.fee,
                    fee_count: self.addProjectForm.fee_count,
                    filesArray: self.fileArray,
                    is_hidden: 'F',
                }

                axios.post('/api/v1/project/add', formData).then(response => {
                    self.projects = response.data.projects
                    self.projectFormVisible = false
                    self.addProjectForm={}
                    self.$refs.upload.clearFiles()
                    self.fileArray=[]
                    self.areaName=''
                    self.district=''
                    self.area_id='0'
                })
            },
            handleShowProject(index, row) {
                let self=this
                self.showProjectForm.name = row.name
                self.showProjectForm.id_code = row.id_code
                self.showProjectForm.id_license = row.id_license
                self.showProjectForm.item_code = row.item_code
                self.showProjectForm.item_name = row.item_name
                self.showProjectForm.register_type = row.register_type
                self.showProjectForm.district = row.district
                self.showProjectForm.phone = row.phone
                self.showProjectForm.industry_code = row.industry_code
                self.showProjectForm.holding = row.holding
                self.showProjectForm.subjection = row.subjection
                self.showProjectForm.item_nature = row.item_nature
                self.showProjectForm.item_type = row.item_type
                self.showProjectForm.start_at = row.start_at
                self.showProjectForm.end_at = row.end_at
                self.showProjectForm.produce_at = row.produce_at
                self.showProjectForm.item_state = row.item_state
                self.showProjectForm.fee = row.fee
                self.showProjectForm.fee_count = row.fee_count
                self.showProjectForm.filesArray = row.filesArray
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
                axios.post('/api/v1/projects', formData).then(response => {
                    this.projects = response.data.projects
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
                    axios.get('/api/v1/projects?page=' + this.pagination.current_page).then(response => {
                        this.projects = response.data.data
                    })
                    this.editAbroadModalCenter = false
                    this.imageEditUrl = []
                    this.fileList = []
                    this.$refs.upload.clearFiles()
                })
            },
            handleDelete(index, row) {
                axios.delete('/api/v1/projects/' + row.id).then(response => {
                    axios.get('/api/v1/projects?page=' + this.pagination.current_page).then(response => {
                        this.projects = response.data.data
                    })
                })
            },


            querySearchAsync(queryString, cb) {
                console.log(this.areaList)

                var areaList = this.areaList;
                var results = queryString ? areaList.filter(this.createStateFilter(queryString)) : areaList;

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
                axios.get('/api/v1/project/areaProject/'+item.id).then(response => {
                    this.projects = response.data.data
                    this.pagination = response.data.meta
                    console.log(response.data)
                })
            },
            districtSelect(item) {
                this.district=item.value
                this.area_id=item.id
            },
            DepartmentSelect(item) {
                const formData = {
                    department: item.value,
                }
                axios.post('/api/v1/payment/queryResult', formData).then(response => {
                    this.projects = response.data.data
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
        font-size: 20px;
        font-weight: 400;
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
        width: 300px !important;
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
    .file-url {
        width: 110px;
        height: 28px;
        line-height: 28px;
        color: #368ec9;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .el-dialog__wrapper{
        min-width: 780px;
    }
</style>
