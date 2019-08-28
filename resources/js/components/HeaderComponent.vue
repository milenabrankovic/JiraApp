<template>
    <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top" v-if="$auth.check()">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <div class="page-logo">
                    <a href="/" style="color:#fff; text-decoration:none"><h3>{{company_name}}</h3></a>
                </div>
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
    data(){
        return {
            authUser: null,
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
        },
        logout(){
            this.$auth.logout({
                redirect: '/login'
            })
        }
    }
}
</script>