import * as types from './../mutation-type'
export default{
    state: {
        authenticated: false,
        id: null,
        name: null,
        username: null,
        nickname: null,
        phone: null,
        avatar: null,
        email: null,
        avatar_url: null,
        is_admin: null,
        is_active: null,
    },
    mutations: {
        [types.UPDATE_PROFILE_ID](state, payload) {
            state.id = payload.value
        },
        [types.UPDATE_PROFILE_NAME](state, payload) {
            state.name = payload.value
        },
        [types.UPDATE_PROFILE_USERNAME](state, payload) {
            state.username = payload.value
        },
        [types.UPDATE_PROFILE_NICKNAME](state, payload) {
            state.nickname = payload.value
        },
        [types.UPDATE_PROFILE_PHONE](state, payload) {
            state.phone = payload.value
        },
        [types.UPDATE_PROFILE_AVATAR](state, payload) {
            state.avatar = payload.value
        },
        [types.UPDATE_PROFILE_EMAIL](state, payload) {
            state.email = payload.value
        },
        [types.UPDATE_PROFILE_AVATAR_URL](state, payload) {
            state.avatar_url = payload.value
        },
        [types.SET_AUTH_USER](state, payload) {
            state.authenticated = true
            state.id = payload.user.id
            state.name = payload.user.name
            state.username = payload.user.username
            state.nickname = payload.user.nickname
            state.phone = payload.user.phone
            state.avatar = payload.user.avatar
            state.email = payload.user.email
            state.avatar_url = payload.user.avatar_url
            state.is_admin = payload.user.is_admin
            state.is_active = payload.user.is_active
        },
        [types.UNSET_AUTH_USER](state) {
            state.authenticated = false
            state.id = null
            state.name = null
            state.phone = null
            state.avatar = null
            state.email = null
            state.avatar_url = null
            state.is_admin = null
            state.is_active = null
        }
    },
    actions: {
        setAuthUser({commit, dispatch}) {
            return axios.get('/api/user').then(response => {
                commit({
                    type: types.SET_AUTH_USER,
                    user: response.data.data
                })
            }).catch(error => {
                dispatch('refreshToken')
            })
        },
        unsetAuthUser({commit}) {
            commit({
                type: types.UNSET_AUTH_USER
            })
        },
        refreshToken({commit, dispatch}) {
            return axios.post('/api/token/refresh').then(response => {
                dispatch('loginSuccess', response.data)
            }).catch(error => {
                dispatch('logoutRequest')
            })
        },
    }
}
