<template>
    <div class="home">
        <div class="row">
            <div class="col-12 w-100per m-b-100 overflow-auto">
                <div class="w-1200 py-5 m-auto">
                    <h2 class="header text-center">
                        <vgl-slidein text="双招双引投资项目监测平台"></vgl-slidein>
                       </h2>
                    <h5 class="header-ad text-center letter-10  m-b-45">
                        监测济宁市各区县项目个数、到位资金、开工项目、竣工项目情况
                    </h5>
                    <div class="my-0">
                        <div class="fl flex-4 text-center">
                            <a class="inline-block m-auto shop" href="#"><img
                                    class="hoverImg" style="width:288px;"
                                    src="/images/storehouse.png">
                            </a>
                            <h6 class="text-secondary pt-2 mb-0">可通过微信、支付宝采集数据</h6>
                            <h6 class="text-secondary pt-2 mb-0">山东数研科技提供技术支持</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="link col-12 text-center">
                <p class="mt-5 mb-3 text-muted">© 1996-2018</p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
//                shops: [],
                active: 0
            }
        },
        mounted() {
//            axios.get('/api/v1/shops').then(response => {
//                this.shops = response.data.data
//            })
        },
        methods: {
            showActive(index) {
                this.active = index;
            }
        }


    }
</script>

<style>
    .header{
        color: #505050;
        font-size:45px;
        margin: 40px 0 20px 0;
    }
    .header-ad{
        color: #6a6866;
        margin-bottom: 40px;
    }
    .link{
        padding: 0 10%;
    }
    .shop-title {
        width: 120px;
        height: 28px;
        line-height: 28px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .code-pics{
        width:96%;
        left:50%
    }
    .code-pics img {
        border-radius: 50%;
        box-shadow: 0 0 20px #e4e8eb !important;
    }

    .code-pics {
        /*float: right;*/
    }

    .code-pics ul {
        margin-left: 1px;
        padding-left: 0px !important;
    }

    .code-pics ul li {
        display: inline-block;
        margin: 20px 10px;
        width: 100px;
        height: 100px;
    }

    .code-pics ul li a {
        position: relative;
        display: inline-block;
        width: 100px;
        height: 100px;
    }

    .hide_tab {
        position: absolute;
        bottom: 0;
        z-index: 999;
        margin-left: -50px;
    }
</style>
