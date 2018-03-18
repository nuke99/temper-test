<template>
    <div>
        <div class="alert alert-danger" v-if="error">
            <p> {{error}} </p>
        </div>


        <form class="form-signin" autocomplete="off" @submit.prevent="login" method="post">
            <h2 class="form-signin-heading">Admin Login</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" v-model="email" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" v-model="password" required>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>

    </div>
</template>

<script>
    export default {
        name: "admin-login",
        data() {
            return {
                email : '',
                password : '',
                error : ''
            }
        },
        methods : {
            login() {
                this.$auth.login({
                    method : 'POST',
                    params: {email : this.email,password: this.password}, // data: {} in Axios
                    success: function () {},
                    error: function (error,data) {
                        this.error = "Invalid E-mail or Password"
                    },
                    rememberMe: true,
                    redirect: '/',
                    fetchUser: true,
                });
            }
        }
    }
</script>

<style scoped>
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee !important;
    }

    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin-heading {
        text-align: center;
    }
    .form-signin .form-signin-heading ,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin .checkbox {
        font-weight: normal;
    }
    .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
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