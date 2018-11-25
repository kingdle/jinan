<template>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid px-0">
            <div class="navbar-header">
                <router-link to="/" class="navbar-brand" exact>
                    <img src="/images/logo-sm.png" alt="仓储物流管理系统" width="260" height="50">
                </router-link>
                <div v-if="user.authenticated" class="d-block d-sm-none d-none d-sm-block d-md-none float-right pt-2">
                    <button class="navbar-toggler btn btn-outline-secondary btn-sm pt-2 px-0" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <svg id="i-menu" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
                            <path d="M4 8 L28 8 M4 16 L28 16 M4 24 L28 24" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <router-link v-if="!user.authenticated" to="/login" tag="li">
                        <button type="button" class="btn btn-success btn-sm user-top-phone" data-placement="bottom" title="控制台">
                            <span>登录</span>
                        </button>
                    </router-link>
                    <router-link v-if="!user.authenticated" to="/register" tag="li">
                        <button type="button" class="btn btn-secondary btn-sm user-top-phone" data-placement="bottom" title="控制台">
                            <span>注册</span>
                        </button>
                    </router-link>
                    <router-link v-if="user.authenticated" :to="{name: 'profile.Home'}" tag="li">
                        <el-badge :value="200" :max="99" class="message">
                            <el-button size="small" circle icon="el-icon-message"></el-button>
                        </el-badge>
                        <el-button type="primary" size="small" round>{{user.nickname}}</el-button>
                        <el-button size="small" type="danger" @click="logout" icon="el-icon-close" circle></el-button>
                        <!--<div class="btn-group">-->
                            <!--&lt;!&ndash;<img class="rounded border-bottom user-top-avatar" :src=user.avatar>&ndash;&gt;-->
                            <!--<button type="button" class="btn btn-success btn-sm user-top-phone" data-placement="bottom" title="控制台">-->
                                <!--<span>{{ user.phone }}</span>-->
                            <!--</button>-->
                            <!--<button @click.prevent="logout" type="button"-->
                                    <!--class="btn btn-info btn-sm" data-placement="bottom" title="退出">-->
                                <!--<svg id="i-signout" viewBox="0 0 32 32" width="16" height="16" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">-->
                                    <!--<path d="M28 16 L8 16 M20 8 L28 16 20 24 M11 28 L3 28 3 4 11 4" />-->
                                <!--</svg>-->
                            <!--</button>-->
                        <!--</div>-->
                    </router-link>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        name: 'top-menu',
        computed: {
            ...mapState({
                    user: state => state.AuthUser
                }
            )
        },
        methods: {

        },
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
            },
            logout()
            {
                this.$store.dispatch('logoutRequest').then(response => {
                    this.$router.push({name: 'home'})
                })
            }
        }
    }
</script>
<style>
    .navbar {
        background-color: #ffffff;
        /*border-bottom: 1px solid #f1f1f1;*/
        /*box-shadow: 0 2px 4px 0 rgba(0,0,0,.05);*/
    }
    .message {
        margin-right: 40px;
    }
</style>
