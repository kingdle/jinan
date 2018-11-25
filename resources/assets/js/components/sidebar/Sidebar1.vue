<template>
    <div class="sidebar-mg">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <router-link :to="{name: 'profile.Home'}" class="nav-link" activeClass="active" exact>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        概况
                    </router-link>
                </a>
            </li>
            <li v-if="user.is_active === 1" class="nav-item">
                <a class="nav-link" href="#">
                    <router-link :to="{name: 'profile.News'}" class="nav-link" activeClass="active" exact>
                        <svg id="i-compose" viewBox="0 0 32 32" width="24" height="24"
                             fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             class="feather feather-shopping-cart">
                            <path d="M27 15 L27 30 2 30 2 5 17 5 M30 6 L26 2 9 19 7 25 13 23 Z M22 6 L26 10 Z M9 19 L13 23 Z" />
                        </svg>
                        货代费
                    </router-link>
                </a>
            </li>
            <li v-if="user.is_active === 1" class="nav-item">
                <a class="nav-link" href="#">
                    <router-link :to="{name: 'profile.Buyer'}" class="nav-link" activeClass="active" exact>
                        <svg id="i-compose" viewBox="0 0 32 32" width="24" height="24"
                             fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             class="feather feather-shopping-cart">
                            <path d="M27 15 L27 30 2 30 2 5 17 5 M30 6 L26 2 9 19 7 25 13 23 Z M22 6 L26 10 Z M9 19 L13 23 Z" />
                        </svg>
                        入库
                    </router-link>
                </a>
            </li>
            <li v-if="user.is_active === 1" class="nav-item">
                <a class="nav-link" href="#">
                    <router-link :to="{name: 'profile.Orders'}" class="nav-link" activeClass="active" exact>
                        <svg id="i-compose" viewBox="0 0 32 32" width="24" height="24"
                             fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             class="feather feather-shopping-cart">
                            <path d="M27 15 L27 30 2 30 2 5 17 5 M30 6 L26 2 9 19 7 25 13 23 Z M22 6 L26 10 Z M9 19 L13 23 Z" />
                        </svg>
                        出库
                    </router-link>
                </a>
            </li>
            <li v-if="user.is_admin === 1" class="nav-item">
                <a class="nav-link" href="#">
                    <router-link :to="{name: 'profile.Reception'}" class="nav-link" activeClass="active" exact>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        设置
                    </router-link>
                </a>
            </li>
            <!--<li v-if="user.is_admin === 1" class="nav-item">-->
                <!--<a class="nav-link" href="#">-->
                    <!--<router-link :to="{name: 'profile.Orders'}" class="nav-link" activeClass="active" exact>-->
                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"-->
                             <!--fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"-->
                             <!--stroke-linejoin="round" class="feather feather-shopping-cart">-->
                            <!--<circle cx="9" cy="21" r="1"></circle>-->
                            <!--<circle cx="20" cy="21" r="1"></circle>-->
                            <!--<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>-->
                        <!--</svg>-->
                        <!--礼品-->
                    <!--</router-link>-->
                <!--</a>-->
            <!--</li>-->
            <!--<li v-if="user.is_admin === 1" class="nav-item">-->
                <!--<a class="nav-link" href="#">-->
                    <!--<router-link :to="{name: 'profile'}" class="nav-link" activeClass="active" exact>-->
                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>-->
                        <!--场馆-->
                    <!--</router-link>-->
                <!--</a>-->
            <!--</li>-->
            <!--<li v-if="user.is_admin === 1" class="nav-item">-->
                <!--<a class="nav-link" href="#">-->
                    <!--<router-link :to="{name: 'profile.Seller'}" class="nav-link" activeClass="active" exact>-->
                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>-->
                        <!--酒店-->
                    <!--</router-link>-->
                <!--</a>-->
            <!--</li>-->
            <!--<li v-if="user.is_admin === 1" class="nav-item">-->
                <!--<a class="nav-link" href="#">-->
                    <!--<router-link :to="{name: 'profile.Buyer'}" class="nav-link" activeClass="active" exact>-->
                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>-->
                        <!--设置-->
                    <!--</router-link>-->
                <!--</a>-->
            <!--</li>-->
            <!--<li v-if="user.is_admin === 1" class="nav-item">-->
                <!--<a class="nav-link" href="#">-->
                    <!--<router-link :to="{name: 'profile.Seed'}" class="nav-link" activeClass="active" exact>-->
                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>-->
                        <!--商户管理-->
                    <!--</router-link>-->
                <!--</a>-->
            <!--</li>-->

        </ul>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        computed: {
            ...mapState({
                    user: state => state.AuthUser
                }
            )
        }
    }
</script>
