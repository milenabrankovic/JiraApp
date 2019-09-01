<template>
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
                  </div>
              </form>
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
            success: function (data) {
             //window.location.href = 'http://jira-app.com/';
             //console.log("DATA:"+JSON.stringify(data));
            },
            error: function (error) { console.log(error); },
            rememberMe: true,
            fetchUser: true,
        });   
      }
    }
  } 
</script>