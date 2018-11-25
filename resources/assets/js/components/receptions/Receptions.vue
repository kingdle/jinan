<template>
    <div class="mg-news">
        <el-dialog title="新建接待方案" :visible.sync="newFormDeception" s>
            <el-form :inline="true" ref="addForm" :model="addForm" label-width="80px" size="medium">
                <el-form-item label="国别">
                    <el-input v-model="addForm.nation" size="mini" placeholder="俄罗斯"></el-input>
                </el-form-item>
                <el-form-item label="活动">
                    <el-input v-model="addForm.activity" size="mini" placeholder="参加***部组织的**活动"></el-input>
                </el-form-item>
                <el-form-item label="主办单位">
                    <el-input v-model="addForm.organizer" size="mini" placeholder="区委组织部"></el-input>
                </el-form-item>
                <el-form-item label="代表团名">
                    <el-input v-model="addForm.delegation" size="mini" placeholder="**代表团"></el-input>
                </el-form-item>
                <el-form-item label="来访目的">
                    <el-input v-model="addForm.objective" size="mini" placeholder="完成**协议签订工作"></el-input>
                </el-form-item>
                <el-form-item label="性质">
                    <el-input v-model="addForm.property" size="mini" placeholder="外事"></el-input>
                </el-form-item>
                <el-form-item label="来访时间">
                    <el-date-picker
                            size="mini"
                            v-model="addForm.sendDate"
                            type="daterange"
                            start-placeholder="来访开始时间"
                            end-placeholder="结束时间"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="yyyy-MM-dd"
                            align="left"
                            :picker-options="pickerOptions2">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="外办工作">
                    <el-input v-model="addForm.office_works" size="mini" placeholder="协调**提供**保障"></el-input>
                </el-form-item>

                <el-form-item label="礼品">
                    <el-input v-model="addForm.gift" size="mini" placeholder="麦秸画1个"></el-input>
                </el-form-item>
                <el-form-item label="人数">
                    <el-input v-model="addForm.number_peoples" size="mini" placeholder="6"></el-input>
                </el-form-item>
                <el-form-item label="宴请">
                    <el-input v-model="addForm.banquet" size="mini" placeholder=""></el-input>
                </el-form-item>
                <el-form-item label="来访成果">
                    <el-input v-model="addForm.harvest" size="mini" placeholder="针对***达成了一致意见"></el-input>
                </el-form-item>
                <el-form-item label="交办">
                    <el-input v-model="addForm.assign" size="mini" placeholder="区人社局"></el-input>
                </el-form-item>
                <el-form-item label="接待科室">
                    <el-input v-model="addForm.reception_department" size="mini" placeholder="综合科"></el-input>
                </el-form-item>
                <!--<el-form-item label="接待方案">-->
                <!--<el-input v-model="addForm.reasons_plan" size="mini" placeholder=""></el-input>-->
                <!--</el-form-item>-->
                <!--<el-form-item label="接待内容">-->
                <!--<el-input v-model="addForm.reasons_content" size="mini" placeholder=""></el-input>-->
                <!--</el-form-item>-->
                <!--<el-form-item label="接待重点">-->
                <!--<el-input v-model="addForm.reasons_reasons_keynote" size="mini" placeholder=""></el-input>-->
                <!--</el-form-item>-->

                <div class="form-group">
                    <el-form-item label="接待重点" size="mini">
                        <el-input class="textarea-width" type="textarea" :rows="4" v-model="addForm.reasons_keynote"
                                  placeholder="请填写重点信息"></el-input>
                    </el-form-item>
                </div>
                <div class="form-group">
                    <el-form-item label="简要方案" size="mini">
                        <!--<el-input class="textarea-width reasons-plan" :rows="6" type="textarea"-->
                        <!--v-model="addForm.reasons_content"-->
                        <!--placeholder="请填写简要接待方案信息"></el-input>-->
                        <quill-editor v-model="addForm.reasons_content"
                                      ref="myQuillEditor"
                                      class="textarea-width reasons-plan"
                                      :options="editorOption"
                                      @change="onEditorChange($event)"
                                      @ready="onEditorReady($event)">
                        </quill-editor>
                    </el-form-item>
                </div>
                <div class="form-group news-img">
                    <label for="enclosure" class="col-form-label">接待方案附件:（最多同时上传9个）</label>
                    <el-upload
                            ref="upload"
                            class="mg-upload-image"
                            :action="uploadAction"
                            list-type="fileList"
                            multiple
                            :limit="9"
                            :on-exceed="handleExceed"
                            :on-success="handleSuccess"
                            :headers="headers">
                        <el-button size="small" type="primary"><i class="el-icon-plus"></i>点击上传</el-button>
                    </el-upload>
                </div>
            </el-form>

            <div slot="footer" class="dialog-footer">
                <el-button @click="newFormDeception = false">取 消</el-button>
                <el-button type="primary" @click="addReception">确 定</el-button>
            </div>
        </el-dialog>
        <el-dialog title="编辑接待方案" :visible.sync="editFormDeception">
            <el-form :inline="true" ref="receptionEditForm" :model="receptionEditForm" label-width="80px" size="medium">
                <el-form-item label="国别">
                    <el-input v-model="receptionEditForm.nation" size="mini" placeholder="俄罗斯"></el-input>
                </el-form-item>
                <el-form-item label="活动">
                    <el-input v-model="receptionEditForm.activity" size="mini" placeholder="参加***部组织的**活动"></el-input>
                </el-form-item>
                <el-form-item label="主办单位">
                    <el-input v-model="receptionEditForm.organizer" size="mini" placeholder="区委组织部"></el-input>
                </el-form-item>
                <el-form-item label="代表团名">
                    <el-input v-model="receptionEditForm.delegation" size="mini" placeholder="**代表团"></el-input>
                </el-form-item>
                <el-form-item label="来访目的">
                    <el-input v-model="receptionEditForm.objective" size="mini" placeholder="完成**协议签订工作"></el-input>
                </el-form-item>
                <el-form-item label="性质">
                    <el-input v-model="receptionEditForm.property" size="mini" placeholder="外事"></el-input>
                </el-form-item>
                <el-form-item label="来访时间">
                    <el-date-picker
                            size="mini"
                            v-model="receptionEditForm.sendDate"
                            type="daterange"
                            start-placeholder="出访开始时间"
                            end-placeholder="结束时间"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="yyyy-MM-dd"
                            align="left"
                            :picker-options="pickerOptions2"
                    >
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="外办工作">
                    <el-input v-model="receptionEditForm.office_works" size="mini" placeholder="协调**提供**保障"></el-input>
                </el-form-item>

                <el-form-item label="礼品">
                    <el-input v-model="receptionEditForm.gift" size="mini" placeholder="麦秸画1个"></el-input>
                </el-form-item>
                <el-form-item label="人数">
                    <el-input v-model="receptionEditForm.number_peoples" size="mini" placeholder="6"></el-input>
                </el-form-item>
                <el-form-item label="宴请">
                    <el-input v-model="receptionEditForm.banquet" size="mini" placeholder=""></el-input>
                </el-form-item>
                <el-form-item label="来访成果">
                    <el-input v-model="receptionEditForm.harvest" size="mini" placeholder="针对***达成了一致意见"></el-input>
                </el-form-item>
                <el-form-item label="交办">
                    <el-input v-model="receptionEditForm.assign" size="mini" placeholder="区人社局"></el-input>
                </el-form-item>
                <el-form-item label="接待科室">
                    <el-input v-model="receptionEditForm.reception_department" size="mini" placeholder="综合科"></el-input>
                </el-form-item>
                <div class="form-group">
                    <el-form-item label="接待重点" size="mini">
                        <el-input class="textarea-width" type="textarea" v-model="receptionEditForm.reasons_keynote"
                                  placeholder="请填写重点信息"></el-input>
                    </el-form-item>
                </div>
                <div class="form-group">
                    <el-form-item label="简要方案" size="mini">
                        <quill-editor v-model="receptionEditForm.reasons_content"
                                      ref="myQuillEditor"
                                      class="textarea-width reasons-plan"
                                      :options="editorOption"
                                      @change="onEditorChange($event)"
                                      @ready="onEditorReady($event)">
                        </quill-editor>
                    </el-form-item>
                </div>
                <div class="form-group news-img">
                    <label for="enclosure" class="col-form-label">接待方案附件:（最多同时上传9个）</label>
                    <p>
                        <b v-for="(item,index) in editFilesUrl" @click="">
                            <a class="file-url" v-for="(url,key) in item" :href="url" target="_blank">
                                <i class="el-icon-document"></i>
                                {{key}}
                            </a>
                        </b>
                    </p>
                    <el-upload
                            ref="upload"
                            class="mg-upload-image"
                            :action="uploadAction"
                            list-type="fileList"
                            multiple
                            :limit="9"
                            :on-exceed="handleExceed"
                            :on-success="handleSuccess"
                            :headers="headers">
                        <el-button size="small" type="primary"><i class="el-icon-plus"></i>点击上传</el-button>
                    </el-upload>
                </div>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="editFormDeception = false">取 消</el-button>
                <el-button type="primary" @click="updateReception">保 存</el-button>
            </div>
        </el-dialog>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="header-text-container">
                                    <div class="mb-3">
                                        <el-row>
                                            <el-col :span="8">
                                                <span class="broad-title">
                                                    <span class="text-success text-bold m-r-5">|</span>
                                                    物流部客户收（付）款列表2
                                                </span>
                                            </el-col>
                                            <el-col :span="10">
                                                <div class="block">
                                                    <el-autocomplete
                                                            v-model="stateName"
                                                            :fetch-suggestions="querySearchAsync"
                                                            placeholder="国别查询"
                                                            @select="handleSelect"
                                                            prefix-icon="el-icon-search"
                                                    ></el-autocomplete>
                                                </div>

                                            </el-col>
                                            <el-col :span="6">
                                                <el-button style="float: right;" type="success" icon="el-icon-refresh"
                                                           @click="Refresh">刷新重置
                                                </el-button>
                                                <el-button style="float: right; margin-right:10px;" type="primary"
                                                           icon="el-icon-circle-plus"
                                                           @click="newFormDeception = true">新建方案
                                                </el-button>
                                            </el-col>
                                        </el-row>
                                    </div>
                                    <div class="body-container">
                                        <div class="my-3 border-top">
                                            <el-table
                                                    :row-class-name="tableRowClassName"
                                                    @cell-dblclick="dialogFormVisible = true"
                                                    :data="receptions"
                                                    align="left"
                                                    style="width: 100%">
                                                <el-table-column type="expand">
                                                    <template slot-scope="props">
                                                        <el-form label-position="left" inline class="demo-table-expand">
                                                            <el-form-item label="宴请">
                                                                <span>{{ props.row.banquet }}</span>
                                                            </el-form-item>
                                                            <el-form-item label="交办">
                                                                <span>{{ props.row.assign }}</span>
                                                            </el-form-item>
                                                            <el-form-item label="接待科室">
                                                                <span>{{ props.row.reception_department }}</span>
                                                            </el-form-item>
                                                            <div class="reasons-keynote">
                                                                <el-form-item label="接待重点">
                                                                    {{ props.row.reasons_keynote }}
                                                                </el-form-item>
                                                            </div>
                                                            <div class="reasons-content">
                                                                <el-form-item label="接待内容">
                                                                    <span v-html="props.row.reasons_content">{{ props.row.reasons_content }}</span>
                                                                </el-form-item>
                                                            </div>
                                                        </el-form>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop="id"
                                                        label="序号"
                                                        sortable
                                                        width="75">
                                                </el-table-column>
                                                <el-table-column
                                                        prop="times_at"
                                                        label="日期"
                                                        sortable
                                                        width="100">
                                                </el-table-column>
                                                <el-table-column
                                                        prop="nation"
                                                        label="国别"
                                                        width="80">
                                                    <template slot-scope="scope">
                                                        <span>{{scope.row.nation}}</span>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop="activity"
                                                        label="活动"
                                                        sortable
                                                        width="100">
                                                </el-table-column>
                                                <el-table-column
                                                        prop="organizer"
                                                        label="主办单位"
                                                        sortable
                                                        width="110">
                                                    <template slot-scope="scope">
                                                        <span>{{scope.row.organizer}}</span>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop='delegation'
                                                        label="代表团"
                                                        width="80">
                                                </el-table-column>
                                                <el-table-column
                                                        prop="office_works"
                                                        label="外办工作"
                                                        width="80">
                                                </el-table-column>
                                                <el-table-column
                                                        prop="objective"
                                                        label="来访目的"
                                                        width="100">
                                                </el-table-column>
                                                <el-table-column
                                                        prop="property"
                                                        label="性质"
                                                        width="90">
                                                </el-table-column>
                                                <el-table-column
                                                        prop="gift"
                                                        label="礼品"
                                                        sortable
                                                        width="110">
                                                </el-table-column>
                                                <el-table-column
                                                        prop="number_peoples"
                                                        label="人数"
                                                        sortable
                                                        width="75">
                                                </el-table-column>
                                                <!--<el-table-column-->
                                                <!--prop="banquet"-->
                                                <!--label="宴请"-->
                                                <!--sortable-->
                                                <!--width="110"-->
                                                <!--&gt;-->
                                                <!--</el-table-column>-->
                                                <el-table-column
                                                        prop="harvest"
                                                        label="来访成果"
                                                        sortable
                                                        width="110">
                                                </el-table-column>
                                                <!--<el-table-column-->
                                                <!--prop="assign"-->
                                                <!--label="交办"-->
                                                <!--sortable-->
                                                <!--width="110"-->
                                                <!--&gt;-->
                                                <!--</el-table-column>-->
                                                <!--<el-table-column-->
                                                <!--prop="reception_department"-->
                                                <!--label="接待科室"-->
                                                <!--sortable-->
                                                <!--width="110"-->
                                                <!--&gt;-->
                                                <!--</el-table-column>-->
                                                <el-table-column
                                                        width="120"
                                                        label="附件">
                                                    <template slot-scope="scope">
                                                        <b v-for="(item,index) in scope.row.enclosure">
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
                                                        width="150">
                                                    <template slot-scope="scope">
                                                        <el-tooltip class="item" effect="dark"
                                                                    content="编辑"
                                                                    placement="top">
                                                            <el-button
                                                                    @click="editFormDeception = true"
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
                                        </div>
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import Quill from 'quill'

    export default {

        data() {
            return {
                abroads: [],
                receptions: [],
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
                receptionEditForm: {},
                abroadCopyForm: {},
                newFormDeception: false,
                editFormDeception: false,
                copyFormDeception: false,
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
                uploadAction: '/api/v1/reception/upFile',
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('jwt_token')
                },
                fileArray: [],
                editFilesUrl: [],
                queryName: [],
                stateName: '',
                queryDepartment: [],
                stateDepartment: '',
                editorOption: {
                    placeholder: "写方案，支持html",
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            [{'color': []}, {'background': []}],
                            [{'list': 'ordered'}, {'list': 'bullet'}],
                            [{'size': ['small', false, 'large', 'huge']}],
                            [{'header': [1, 2, 3, 4, 5, 6, false]}],
                            [{'align': []}],
                            ['clean'],
                        ]
                    }
                }
            }
        },
        mounted() {
            axios.get('/api/v1/receptions').then(response => {
                this.receptions = response.data.data
                this.pagination = response.data.meta
            })
           this.queryName = this.loadNames()
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
                axios.get('/api/v1/receptions?page=' + page).then(response => {
                    this.abroads = response.data.data
                })
            },
            handleSizeChange(pageSize) {
                this.pagination.per_page = pageSize
                const formData = {
                    pagination: pageSize,
                }
                axios.post('/api/v1/reception/listSize', formData).then(response => {
                    this.abroads = response.data.data
                })
            },
            handleCurrentChange(page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/receptions?page=' + page).then(response => {
                    this.abroads = response.data.data
                })
            },
            Refresh(page) {
                axios.get('/api/v1/receptions').then(response => {
                    this.receptions = response.data.data
                    this.pagination = response.data.meta
                    this.stateName = ''
                    this.stateDepartment = ''
                })
            },
            onEditorReady(editor) {
            },
            onEditorChange({editor, html, text}) {
                this.content = html
            },
            Enclosure: function (row, column) {
                console.log(row.enclosure[0])
                return row.enclosure;
            },
            timesToEnd: function (row, column) {
                return row.times_at_md + '至' + row.times_end_md;
            },
            batchNumber: function (row, column) {
                return row.batch_number
            },
            handleSuccess(response){
                console.log(response)
                this.filesUrl = response.files
                this.fileArray.push(this.filesUrl)
            },
            editSuccess(response){
                if (this.editFilesUrl == null) {
                    this.editFilesUrl = []
                }
                this.filesUrl = response.photo
                this.editFilesUrl.push(this.filesUrl)
            },
            handleBefore(){
                return this.files.length === 9 ? false : true // 只让它上传一张
            },
            handleRemove(file, fileList) {
                console.log(fileList);
            },
            fileRemove(item) {
                const formData = {
                    id: this.receptionEditForm.id,
                    pic: item,
                }
                axios.post('/api/v1/reception/destroyImage', formData).then(response => {
                    console.log(response.data)
                    this.editFilesUrl = response.data
                })
            },
//            handlePreview(image) {
//                this.handlePreviewModal = true;
//                this.dialogImageUrl = image;
//            },
            handleExceed(files, fileList) {
                this.$message.warning(`当前限制选择 9 个文件，本次选择了 ${files.length} 个文件，共选择了 ${files.length + fileList.length} 个文件`);
            },
            addReception() {
                const formData = {
                    nation: this.addForm.nation,
                    activity: this.addForm.activity,
                    organizer: this.addForm.organizer,
                    delegation: this.addForm.delegation,
                    office_works: this.addForm.office_works,
                    objective: this.addForm.objective,
                    sendDate: this.addForm.sendDate,
                    property: this.addForm.property,
                    gift: this.addForm.gift,
                    number_peoples: this.addForm.number_peoples,
                    banquet: this.addForm.banquet,
                    harvest: this.addForm.harvest,
                    assign: this.addForm.assign,
                    reception_department: this.addForm.reception_department,
                    reasons_keynote: this.addForm.reasons_keynote,
                    reasons_content: this.addForm.reasons_content,
                    enclosure: this.fileArray
                }
                axios.post('/api/v1/receptions', formData).then(response => {
                    this.receptions = response.data.receptions
                    this.newFormDeception = false
                    this.fileArray = []
                    this.fileList = []
                    this.$refs.upload.clearFiles()
                })
            },
            handleEdit(index, row) {
                this.receptionEditForm.id = row.id
                this.receptionEditForm.nation = row.nation
                this.receptionEditForm.activity = row.activity
                this.receptionEditForm.organizer = row.organizer
                this.receptionEditForm.delegation = row.delegation
                this.receptionEditForm.office_works = row.office_works
                this.receptionEditForm.objective = row.objective
                this.receptionEditForm.property = row.property
                this.receptionEditForm.gift = row.gift
                this.receptionEditForm.number_peoples = row.number_peoples
                this.receptionEditForm.banquet = row.banquet
                this.receptionEditForm.harvest = row.harvest
                this.receptionEditForm.assign = row.assign
                this.receptionEditForm.sendDate = [row.times_at, row.times_end]
                this.receptionEditForm.reception_department = row.reception_department
                this.receptionEditForm.reasons_content = row.reasons_content
                this.receptionEditForm.reasons_keynote = row.reasons_keynote
                this.receptionEditForm.enclosure = row.enclosure
                this.editFilesUrl = row.enclosure
                this.fileArray = row.enclosure
            },
            updateReception(){
                const formData = {
                    id: this.receptionEditForm.id,
                    nation: this.receptionEditForm.nation,
                    activity: this.receptionEditForm.activity,
                    organizer: this.receptionEditForm.organizer,
                    delegation: this.receptionEditForm.delegation,
                    office_works: this.receptionEditForm.office_works,
                    objective: this.receptionEditForm.objective,
                    property: this.receptionEditForm.property,
                    gift: this.receptionEditForm.gift,
                    number_peoples: this.receptionEditForm.number_peoples,
                    banquet: this.receptionEditForm.banquet,
                    harvest: this.receptionEditForm.harvest,
                    assign: this.receptionEditForm.assign,
                    sendDate: this.receptionEditForm.sendDate,
                    reception_department: this.receptionEditForm.reception_department,
                    reasons_content: this.receptionEditForm.reasons_content,
                    reasons_keynote: this.receptionEditForm.reasons_keynote,
                    enclosure: this.fileArray
                }
                axios.post('/api/v1/reception/update', formData).then(response => {
                    axios.get('/api/v1/receptions?page=' + this.pagination.current_page).then(response => {
                        this.receptions = response.data.data
                        console.log(response.data)
                    })
                    this.editFormDeception = false
                    this.editFilesUrl = []
                    this.fileList = []
                    this.$refs.upload.clearFiles()
                })
            },
            handleDelete(index, row) {
                axios.delete('/api/v1/receptions/' + row.id).then(response => {
                    axios.get('/api/v1/receptions?page=' + this.pagination.current_page).then(response => {
                        this.receptions = response.data.data
                        this.pagination = response.data.meta
                    })
                })
            },
            loadNames() {
                return [
                    axios.get('/api/v1/reception/queryNationList').then(response => {
                        this.queryName = response.data
                    })
                ]
            },
            loadDepartments() {
                return [
                    axios.get('/api/v1/reception/queryDepartmentList').then(response => {
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
                    nation: item.value,
                }
                axios.post('/api/v1/reception/queryResult', formData).then(response => {
                    this.receptions = response.data.data
                    this.pagination = response.data.meta
                })
            },
            DepartmentSelect(item) {
                const formData = {
                    department: item.value,
                }
                axios.post('/api/v1/reception/queryResult', formData).then(response => {
                    console.log(response.data)
                    this.abroads = response.data.data
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
            editor() {
                return this.$refs.myQuillEditor.quill
            }
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

    label {
        display: inline-block;
        margin-bottom: 0;
    }

    .quill-editor,
    .quill-code {
        height: 20rem;
    }

    .ql-editor {
        display: block;
        resize: vertical;
        line-height: 1.5;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        width: 100%;
        font-size: inherit;
        color: #606266;
        background-color: #fff;
        background-image: none;
        border: 1px solid #dcdfe6;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        -webkit-transition: border-color .2s cubic-bezier(.645, .045, .355, 1);
        transition: border-color .2s cubic-bezier(.645, .045, .355, 1);
    }

    .quill-code {
        border: none;
        height: auto;

    >
    code {
        width: 100%;
        margin: 0;
        padding: 1rem;
        border-radius: 0;
        height: 10rem;
        overflow-y: auto;
    }

    }
    .ql-container.ql-snow {
        border: 0px solid #ccc;
    }

    .ql-toolbar.ql-snow {
        border: 1px solid #dcdfe6;
        box-sizing: border-box;
        font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
        padding: 8px;
    }

    .ql-snow .ql-picker {
        color: #444;
        display: inline-block;
        float: left;
        font-size: 14px;
        font-weight: 500;
        height: 36px;
        position: relative;
        vertical-align: middle;
    }

    .ql-container {
        box-sizing: border-box;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 13px;
        height: 90%;
        margin: 0px;
        position: relative;
    }

    .demo-table-expand {
        font-size: 0;
    }

    .demo-table-expand label {
        width: 90px;
        color: #99a9bf;
    }

    .reasons-keynote {
        color: #f06307;
    }

    .reasons-content {
        color: #222222;
    }

    .el-form-item {
        line-height: 1.5em;
    }

    .demo-table-expand .el-form-item {
        margin-right: 0;
        margin-bottom: 0;
        width: 30%;
    }

    .reasons-keynote .el-form-item {
        margin-right: 0;
        margin-bottom: 0;
        width: 90%;
    }

    .reasons-content .el-form-item {
        margin-right: 0;
        margin-bottom: 0;
        width: 90%;
    }

    .reasons-keynote .el-form-item .el-form-item__content {
        line-height: 1.5em !important;
        text-indent: 2em;
        padding-top: 8px;
    }

    .reasons-content .el-form-item .el-form-item__content {
        line-height: 1.5em !important;
        text-indent: 2em;
        padding-top: 8px;
    }

    .el-table__expanded-cell[class*=cell] {
        padding: 0 0 10px 0;
    }

    .demo-table-expand {
        font-size: 0;
        border: 1px solid #f8f8f8;
        padding: 20px;
        background-color: #f5f5f5;
        border-bottom-radius: 10px;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
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
        width: 660px !important;
    }

    .reasons-plan {

    }

    .el-table .warning-row {
        background: oldlace;
    }

    .el-table .success-row {
        background: #f0f9eb;
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
</style>
