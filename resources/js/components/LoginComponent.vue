<template>
    <div>
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form autocomplete="off" @submit.prevent="login" method="post">
            <div class="form-group">
                <label for="username">E-mail</label>
                <input type="text" id="username" class="form-control" v-model="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-default">Sign in</button>
        </form>
    </div>
</template>
<script>
  export default {
    data(){
      return {
        username: null,
        password: null,
        error: false
      }
    },
    methods: {
      login(){
        var app = this
        this.$auth.login({
            params: {
              username: app.username,
              password: app.password
            }, 
            success: function () {},
            error: function (error) { console.log(error); },
            rememberMe: true,
            redirect: '/',
            fetchUser: true,
        });       
      },
    }
  } 
</script>