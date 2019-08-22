<template>
    <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <div class="page-top">
                    <ul>
                        <li v-if="$auth.check()" class="pull-right">
                            <a href="" @click="logout()">Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
</template>
<script>
export default {
    methods:{
        logout(){
            this.$auth.logout({
                redirect: '/login'
            })
        }
    }
}
</script>