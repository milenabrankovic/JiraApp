<template>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">{{company_name}}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/projects">Projects</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/configuration">Configuration</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div> 

</nav> -->
<!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar">
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start">
                            <router-link to="/projects" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">Projects</span>
                                <span class="selected"></span>
                            </router-link>
                        </li>
                        <li class="nav-item start">
                             <router-link to="/configuration" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Configuration</span>
                                <span class="selected"></span>
                            </router-link>
                        </li>
                        
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
</template>

<script>
export default {
    data(){
        return {
            company_name: ''
        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        fetchData:function(){
            axios.get('http://jira-app.com/api/company')
                 .then(result => this.company_name = result.data.name);
        }
    }
}
</script>

<style>
    .router-link-active{
        border-left: 3px solid #5C9ACF!important;
        margin-left: -3px;
        padding-left: 15px;
        background: #f2f6f9;
    }
</style>

