<template>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Temper</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <router-link :to="{ name: 'dashboard' }">Home</router-link>
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" @click.prevent="logout()">Log-out</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
</template>

<script>
    export default {
        name: "nav-bar",
        methods:  {
            logout() {
                this.$auth.logout({
                    success : function() {
                        console.log(this.$route)
                        this.$router.push('/login')
                    },
                    redirect: '/'
                })
            }
        }
    }
</script>

<style scoped>

</style>