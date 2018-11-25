<template>
    <div class="sidebar-mg">
        <el-menu default-active="1-4-1" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose"
                 :collapse="isCollapse"
                 background-color="#545c64"
                 text-color="#fff"
                 active-text-color="#409EFF">
            <router-link :to="{name: 'profile.Home'}" exact>
                <el-menu-item index="1">
                    <template slot="title">
                        <span slot="title">概况</span>
                    </template>
                    <i class="el-icon-menu"></i>
                </el-menu-item>
            </router-link>
            <router-link :to="{name: 'profile.News'}" exact>
                <el-menu-item index="2">
                    <template slot="title">
                        <span slot="title">货代费用</span>
                    </template>
                    <i class="el-icon-news"></i>
                </el-menu-item>
            </router-link>
            <router-link :to="{name: 'profile.News'}" exact>
                <el-menu-item index="3">
                    <i class="el-icon-download"></i>
                    <span slot="title">入库</span>
                </el-menu-item>
            </router-link>
            <router-link :to="{name: 'profile.News'}" exact>
                <el-menu-item index="4">
                    <i class="el-icon-refresh"></i>
                    <span slot="title">库存管理</span>
                </el-menu-item>
            </router-link>
            <router-link :to="{name: 'profile.News'}" exact>
                <el-menu-item index="5">
                    <i class="el-icon-upload2"></i>
                    <span slot="title">出库</span>
                </el-menu-item>
            </router-link>
            <el-submenu index="6">
                <template slot="title">
                    <i class="el-icon-setting"></i>
                </template>
                <el-menu-item-group>
                    <el-menu-item index="6-1">
                        <router-link :to="{name: 'profile.Fee'}" class="nav-link" activeClass="active" exact>
                            费用类别设置
                        </router-link>
                    </el-menu-item>
                    <el-menu-item index="6-2">
                        <router-link :to="{name: 'profile.User'}" class="nav-link" activeClass="active" exact>
                            用户设置
                        </router-link>
                    </el-menu-item>
                </el-menu-item-group>
            </el-submenu>
        </el-menu>
    </div>
</template>
<style>
    /*.el-menu-vertical-demo:not(.el-menu--collapse) {*/
        /*width: 200px;*/
        /*min-height: 400px;*/
    /*}*/

    .el-submenu__title i , .el-menu-item i{
        color: #fff;
    }
    .is-active a i {
        color: #409EFF !important;
    }
</style>
<script>
    export default {
        data() {
            return {
                isCollapse: true
            };
        },
        methods: {
            handleOpen(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClose(key, keyPath) {
                console.log(key, keyPath);
            }
        }
    }
</script>
