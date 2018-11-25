<template>
    <div>
        <el-container>
            <sidebar></sidebar>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </div>
</template>

<script>
    import Sidebar from './../sidebar/Sidebar.vue'

    export default {
        components: {
            Sidebar,
        },
        data() {
            return {
                isCollapse: true
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
<style>
    .el-container{
        min-height: 760px;
        max-height: 960px;
    }
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
    }

    .el-aside {
        background-color: #545c64;
        color: #fff;
        text-align: center;
        line-height: 200px;
    }

    .el-main {
        margin: 20px 20px 0 20px;
        background-color: #ffffff;
    }
</style>
