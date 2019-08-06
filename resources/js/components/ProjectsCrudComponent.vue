<template>
    <div class="portlet light ">
        <div class="portlet-title">
            <div id="prefix_1438324840626" class="custom-alerts alert alert-success">Here you can do CRUD actions on projects.</div>
        </div>
        <div class="portlet-body">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1_1" data-toggle="tab"> List </a>
                </li>
                <li>
                    <a href="#tab_1_2" data-toggle="tab"> Create </a>
                </li>
                <li>
                    <a href="#tab_1_3" data-toggle="tab"> Edit </a>
                </li>
                <li>
                    <a href="#tab_1_4" data-toggle="tab"> Delete </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab_1_1">
                    <!-- BEGIN BORDERED TABLE PORTLET-->
                        <div class="portlet light portlet-fit ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-list font-dark"></i>
                                    <span class="caption-subject font-dark bold uppercase">Projects</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th> Project Name </th>
                                                <th> Description </th>
                                                <th> Start Date </th>
                                                <th> Project Manager </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="project in projects" v-bind:key="project.project_id">
                                                <td> {{project.name}} </td>
                                                <td> {{project.description}} </td>
                                                <td> {{project.start_date}} </td>
                                                <td> makr124 </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END BORDERED TABLE PORTLET-->
                </div>
                <div class="tab-pane fade" id="tab_1_2">
                   CREATE
                </div>
                <div class="tab-pane fade" id="tab_1_3">
                    EDIT
                </div>
                <div class="tab-pane fade" id="tab_1_4">
                    DELETE
                </div>
            </div>
            <div class="clearfix margin-bottom-20"> </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
            return{
                projects: []
            }
        },
        created(){
            this.fetchData();
        },
        methods:{
            fetchData(){
                axios.get('http://jira-app.com/api/project')
                    .then(response => this.projects = response.data['data']);
            }
        }
}
</script>

