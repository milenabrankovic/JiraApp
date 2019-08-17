<template>
    <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <div class="page-logo">
                    <a href="index.html">
                        <img src="" alt="logo" class="logo-default" /> </a>
                </div>
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <a href="http://jira-app.com/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        <input type="hidden" name="_token" :value="csrf">
                    </form>
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
</template>

<script>
export default {
    data(){
         return{
             
             csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    }
}
</script>
