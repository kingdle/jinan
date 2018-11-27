<template>
    <div class="sidebar-mg">
        <el-menu default-active="1-4-1" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose"
                 :collapse="isCollapse"
                 background-color="#25323f"
                 text-color="#fff"
                 active-text-color="#409EFF">
            <el-switch
                    v-model="isCollapse"
                    active-color="#909399"
                    inactive-color="#28a42f"
                    :width="30">
            </el-switch>
            <router-link :to="{name: 'profile.Home'}" exact>
            <el-menu-item index="1">
                <i class="el-icon-menu"></i>
                <span slot="title">概览</span>
            </el-menu-item>
            </router-link>
            <!--<el-submenu index="1">-->
                <!--<template slot="title">-->
                    <!--<i class="el-icon-menu"></i>-->
                    <!--<span slot="title">概览</span>-->
                <!--</template>-->
                <!--<el-submenu index="1-1">-->
                    <!--<span slot="title"><i class="el-icon-circle-plus-outline"></i>入库</span>-->
                    <!--<router-link :to="{name: 'profile.Inletplan'}" exact>-->
                        <!--<el-menu-item index="1-1-1">入库计划</el-menu-item>-->
                    <!--</router-link>-->
                    <!--<router-link :to="{name: 'profile.Inlet'}" exact>-->
                        <!--<el-menu-item index="1-1-2">月台收货</el-menu-item>-->
                    <!--</router-link>-->
                    <!--&lt;!&ndash;<el-menu-item index="1-1-3">入库单打印</el-menu-item>&ndash;&gt;-->
                <!--</el-submenu>-->
                <!--<el-submenu index="1-2">-->
                    <!--<span slot="title"><i class="el-icon-remove-outline"></i>出库</span>-->
                    <!--<router-link :to="{name: 'profile.Outletplan'}" exact>-->
                        <!--<el-menu-item index="1-2-1">出库计划</el-menu-item>-->
                    <!--</router-link>-->
                    <!--<router-link :to="{name: 'profile.Outlet'}" exact>-->
                        <!--<el-menu-item index="1-2-2">月台出货</el-menu-item>-->
                    <!--</router-link>-->
                    <!--&lt;!&ndash;<el-menu-item index="1-2-3">出库单打印</el-menu-item>&ndash;&gt;-->
                <!--</el-submenu>-->
                <!--<router-link :to="{name: 'profile.Transfers'}" exact>-->
                    <!--<el-menu-item index="1-3">-->
                        <!--<span slot="title"><i class="el-icon-sort"></i>拆票(货转)</span>-->
                    <!--</el-menu-item>-->
                <!--</router-link>-->
                <!--<router-link :to="{name: 'profile.Positions'}" exact>-->
                    <!--<el-menu-item index="1-4">-->
                        <!--<span slot="title"><i class="el-icon-location"></i>库位图</span>-->
                    <!--</el-menu-item>-->
                <!--</router-link>-->
                <!--<router-link :to="{name: 'profile.Changes'}" exact>-->
                    <!--<el-menu-item index="1-5">-->
                        <!--<span slot="title"><i class="el-icon-refresh"></i>货物变更</span>-->
                    <!--</el-menu-item>-->
                <!--</router-link>-->
            <!--</el-submenu>-->
            <router-link :to="{name: 'profile.Statistics'}" exact>
                <el-menu-item index="3">
                    <i class="el-icon-document"></i>
                    <span slot="title">项目列表</span>
                </el-menu-item>
            </router-link>
            <el-submenu index="4">
                <template slot="title">
                    <i class="el-icon-setting"></i>
                    <span slot="title">设置</span>
                </template>
                <router-link :to="{name: 'profile.Users'}" exact>
                    <el-menu-item index="4-6">
                        <span slot="title">用户管理</span>
                    </el-menu-item>
                </router-link>
                <el-menu-item index="4-7">
                    <span slot="title">权限分配</span>
                </el-menu-item>
                <el-menu-item index="4-8">
                    <span slot="title">角色管理</span>
                </el-menu-item>
            </el-submenu>
        </el-menu>
    </div>
</template>
<style>
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
    }

    .sidebar-mg:not(.el-menu--collapse) {
        min-height: 400px;
    }

    .sidebar-mg {
        background-color: #25323f;
        color: #fff;
        text-align: left;
    }

    .sidebar-mg, .el-main {
        /*overflow: auto;*/
        -webkit-box-sizing: border-box;
    }

    .el-switch {
        margin: 20px 20px 10px 20px;
    }

    .el-menu {
        border-right: 0px;
    }
</style>

<script>
    export default {
        data() {
            return {
                isCollapse: true,
            };
        },
        methods: {
            handleOpen(key, keyPath) {

            },
            handleClose(key, keyPath) {

            }
        }
    }
</script>
