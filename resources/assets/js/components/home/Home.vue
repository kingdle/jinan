<template>
    <div class="home">
        <div style="padding: 14px 0;">
            <div class="title">
                <img src="/images/city.png" class="icon">
                <vgl-rollup text="全市双招双创项目情况"></vgl-rollup>
            </div>
            <el-row :gutter="12">
                <el-col :span="6">
                    <el-card shadow="hover">
                        项目个数 <span class="items-num">50</span>个
                    </el-card>
                </el-col>
                <el-col :span="6">
                    <el-card shadow="hover">
                        十强产业到位资金 <span class="item-fee">100</span>亿元
                    </el-card>
                </el-col>
                <el-col :span="6">
                    <el-card shadow="hover">
                        开工项目数 <span class="start-num">45</span>个
                        <el-progress type="circle" :percentage="70" color="#f85e13" width="70"></el-progress>

                    </el-card>
                </el-col>
                <el-col :span="6">
                    <el-card shadow="hover">
                        竣工项目数 <span class="end-num">15</span>个
                        <el-progress type="circle" :percentage="25" color="#28a42f" width="70"></el-progress>
                    </el-card>
                </el-col>
            </el-row>
        </div>
        <div class="title">
            <img src="/images/district.png" class="icon">
            <vgl-rollup text="各区双招双创项目情况"></vgl-rollup>
        </div>
        <el-row :gutter="12">
            <el-col :span="3" v-for="(o, index) in 14" :key="o">
                <el-card :body-style="{ padding: '0px'}" shadow="hover">
                    <div class="items" style="padding: 14px;">
                        <img src="https://images.veg.kim/avatars/2160MG5b494bd03a9eb.png!mp.v100" class="image">
                        <span>好吃的汉堡</span>
                    </div>
                    <div style="padding: 14px;">
                        <div class="bottom clearfix">
                            <time class="time">{{ currentDate }}</time>
                            <el-button type="text" class="button">操作按钮</el-button>
                        </div>
                    </div>
                </el-card>
            </el-col>
        </el-row>
        <div class="title">
            <img src="/images/charts.png" class="icon">
            <vgl-rollup text="双招双创图表对比"></vgl-rollup>
        </div>
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
                currentDate: new Date(),
                tags: [
                    {name: '标签一', type: ''},
                    {name: '标签二', type: 'success'},
                    {name: '标签三', type: 'info'},
                    {name: '标签四', type: 'warning'},
                    {name: '标签五', type: 'danger'}
                ]
            }

        },
        mounted() {
//            axios.get('/api/v1/areas').then(response => {
//                this.areas = response.data.data
//            })
        },
        methods: {}
    }
</script>
<style>
    .home .title {
        font-size: 18px;
        font-weight: 700;
        padding: 5px 0 20px 0;
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

    .home .el-col {
        margin-bottom: 10px;
    }

    .home .items .image {
        float: left;
        width: 30px;
        height: 30px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }

    .el-card__body {
        font-size: 16px;
    }

    .items-num {
        font-size: 40px;
        font-weight: 700;
        color: #f85e13;
    }

    .item-fee {
        font-size: 40px;
        font-weight: 700;
        color: #f85e13;
    }

    .start-num, .end-num {
        font-size: 40px;
        font-weight: 700;
        color: #f85e13;
    }

</style>s
