<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="text-center login">
                    <login-form></login-form>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
            </div>
        </div>
    </div>
</template>

<script>
    import LoginForm from './LoginForm'
    import LoginCode from './LoginCode'
    export default{
        components:{
            LoginForm,
            LoginCode
        }
    }
</script>
<style>

    .login{
        margin-top: 40%;
    }


    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        margin: 10px 0;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }


</style>
