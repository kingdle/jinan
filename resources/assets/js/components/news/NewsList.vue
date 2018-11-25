<template>
    <div class="card-columns pt-3">
        <div class="modal fade dynamic-image-lg" tabindex="-1" role="dialog" aria-labelledby="dynamicLargeImageLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="row">
                    <div class="col-md-12 px-0">
                        <div class="card flex-row mb-3 border-0">
                            <div class="card-body mt-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="header-text-container">
                                            <div class="mb-3">
                                                <el-row>
                                                    <el-col :span="2">
                                                        <p class="vertical-middle">
                                                            <span class="text-success text-bold m-r-5">|</span>
                                                            订单列表
                                                            <!--<mark>农户在访问"苗果"小程序时，会看到自己在您的苗场订购的苗子订单数量和品种。</mark>-->
                                                        </p>

                                                    </el-col>

                                                </el-row>
                                            </div>
                                            <div class="body-container">
                                                <div class="my-3 border-top">
                                                    <!--<abroads :abroads="abroads"></abroads>-->
                                                    <el-table
                                                            :data="abroads"
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
                                                                prop="name"
                                                                label="姓名"
                                                                sortable
                                                                width="100"
                                                        >
                                                        </el-table-column>
                                                        <el-table-column
                                                                prop="phone"
                                                                label="电话"
                                                                sortable
                                                                width="110"
                                                        >
                                                        </el-table-column>
                                                        <el-table-column
                                                                prop="tags.name"
                                                                label="苗子品种"
                                                                sortable
                                                                width="110"
                                                        >
                                                        </el-table-column>
                                                        <el-table-column
                                                                prop="counts"
                                                                label="数量(株)"
                                                                sortable
                                                                width="100"
                                                        >
                                                        </el-table-column>
                                                        <el-table-column
                                                                prop="unit_price"
                                                                label="单价(元)"
                                                                width="80"
                                                        >
                                                        </el-table-column>
                                                        <el-table-column
                                                                prop='start_at'
                                                                label="育苗日期"
                                                                sortable
                                                                width="110"
                                                        >
                                                        </el-table-column>
                                                        <el-table-column
                                                                prop="end_at"
                                                                label="送苗日期"
                                                                sortable
                                                                width="110"
                                                        >
                                                        </el-table-column>
                                                        <el-table-column
                                                                label="地址"
                                                                sortable
                                                        >
                                                            <template slot-scope="scope">
                                                                <span style="margin-left: 3px">{{ scope.row.address }}，{{ scope.row.villageInfo }}</span>
                                                                <el-button type="text"
                                                                           class="checkLocation-button"
                                                                           icon="el-icon-location-outline"
                                                                           data-toggle="modal"
                                                                           data-target="#EditLocationModalCenter"
                                                                           @click.native.prevent="checkLocation(scope.$index, scope.row)">
                                                                </el-button>
                                                            </template>
                                                        </el-table-column>

                                                        <el-table-column
                                                                fixed="right"
                                                                label="操作"
                                                                width="120"
                                                        >
                                                            <template slot-scope="scope">
                                                                <el-tooltip class="item" effect="dark" content="编辑"
                                                                            placement="left">
                                                                    <!--<el-button-->
                                                                            <!--data-toggle="modal"-->
                                                                            <!--data-target="#editOrderModalCenter"-->
                                                                            <!--@click.native.prevent="handleEdit(scope.$index, scope.row)"-->
                                                                            <!--type="primary" icon="el-icon-edit"-->
                                                                            <!--size="mini">-->
                                                                    <!--</el-button>-->
                                                                </el-tooltip>
                                                                <el-tooltip class="item" effect="dark" content="删除"
                                                                            placement="top">
                                                                    <el-button
                                                                            @click.native.prevent="handleDelete(scope.$index, scope.row)"
                                                                            type="info" icon="el-icon-delete"
                                                                            size="mini">
                                                                    </el-button>
                                                                </el-tooltip>
                                                            </template>
                                                        </el-table-column>
                                                    </el-table>
                                                </div>
                                                <el-pagination
                                                        @size-change="handleSizeChange"
                                                        @current-change="handleCurrentChange"
                                                        :current-page="current_page"
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
        </div>



    </div>
</template>
<script>
    export default {
        props: ['abroads'],
        data() {
            return {
                dialogImageUrl: '',
            }
        },
        methods: {
            handlePreview(image) {
                this.dialogImageUrl = image;
            }
        }
    }
</script>
<style>
    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 90px;
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
</style>
