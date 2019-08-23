<template>
    <!-- <div>
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
    </div> -->
    <div class="login">
      <div class="content">
              <!-- BEGIN LOGIN FORM -->
              <div class="alert alert-danger" v-if="error">
                <p>There was an error, unable to sign in with those credentials.</p>
              </div>
              <form class="login-form" @submit.prevent="login" method="post">
                      
                  <h3 class="form-title font-green">Log In</h3>
                  
                  <div class="form-group">
                      <label class="control-label visible-ie8 visible-ie9">Username</label>
                      <input class="form-control form-control-solid placeholder-no-fix" type="text" id="username" v-model="username" placeholder="Username" name="username"  required/> </div>
                      <div class="form-group">
                      <label class="control-label visible-ie8 visible-ie9">Password</label>
                      <input class="form-control form-control-solid placeholder-no-fix" type="password" id="password" v-model="password" placeholder="Password" name="password" required/> </div>
                      
                    <div class="form-actions">
                      <button type="submit" class="btn green uppercase ">Login</button>
                      <!-- <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a> -->
                  </div>
              </form>
              <!-- END LOGIN FORM -->
              <!-- BEGIN FORGOT PASSWORD FORM -->
              <!-- <form class="forget-form" action="index.html" method="post">
                  <h3 class="font-green">Forget Password ?</h3>
                  <p> Enter your e-mail address below to reset your password. </p>
                  <div class="form-group">
                      <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                  <div class="form-actions">
                      <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
                      <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                  </div>
              </form> -->
              <!-- END FORGOT PASSWORD FORM -->
              <div class="copyright"> {{ new Date().getFullYear() }} © All rights reserved. </div>
          </div>
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
            success: function () {
              const redirectTo = this.$auth.user().role_id === 1 ? '/projects' : '/users'
              this.$router.push({name: redirectTo})
            },
            error: function (error) { console.log(error); },
            rememberMe: true,
            fetchUser: true,
        });   
      }
    }
  } 
</script>