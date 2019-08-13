<template>
    <div>
        <div class="portlet light ">
            <div class="page-head">
            <div class="page-title">
                <h1>Projects</h1>
            </div>
            </div>
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
                        
                        <div class="row">
                        <div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-list font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Project List</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th> Project Name</th>
                                                    <th> Project Description </th>
                                                    <th> Start Date </th>
                                                    <th> Project Manager </th>
                                                    <th> Assignment </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-if="!projects.length" class="no-data">
                                                    <td colspan="5" class="text-center">Projects not found</td>
                                                </tr>
                                                <tr  v-for="project in projects" v-bind:key="project.project_id">
                                                    <td> {{project.name}} </td>
                                                    <td> {{project.description}} </td>
                                                    <td> {{project.start_date}} </td>
                                                    <td> ks </td>
                                                    <td>  <a class="btn btn btn-info" @click="modal_assign(project)" data-toggle="modal" href="#assign"> Assign </a> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <div class="modal fade" id="assign" tabindex="-1" role="basic" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Assign project "<span id="projectName"></span>" to Employee</h4>
                                                </div>
                                                 <form role="form" method="post" @submit.prevent="assignEmployee">
                                                    <input type="hidden" name="_token" :value="csrf">
                                                    <div class="modal-body"> 
                                                        <div class="form-group">
                                                            <label for="multiple" class="control-label">Choose Employee</label>
                                                            <!-- <select id="multiple" class="form-control select2-multiple" name="users[]" v-model="selectedUsers" multiple>
                                                                <option v-for="user in users" v-bind:key="user.user_id" :value="user.user_id">{{user.first_name}} {{user.last_name}}</option>
                                                            </select> -->

                                                            <select id="multiple" class="form-control" v-model="selectedUsers" multiple>
                                                                <option v-for="user in users" v-bind:key="user.user_id" :value="user.user_id">{{user.first_name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn green">Save changes</button>
                                                </div>
                                               
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="tab_1_2">
                    <div class="row">
                        <div>
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption font-red-sunglo">
                                        <i class="icon-plus font-red-sunglo"></i>
                                        <span class="caption-subject bold uppercase"> Create Project</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                   <form role="form" method="post" @submit.prevent="createProject">
                                       <input type="hidden" name="_token" :value="csrf">
                                        <div class="form-group">
                                            <label for="labelProjectName">Project Name</label>
                                            <input type="text" class="form-control" id="labelProjectName" name="project_name" placeholder="Enter project name" v-model="project.project_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="labelProjectDesc">Project Description</label>
                                            <textarea class="form-control" id="labelProjectDesc" name="project_description" placeholder="Enter project description" v-model="project.project_description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="labelStartDate">Start Date</label>
                                            <input type="date"  class="form-control" id="labelStartDate" name="start_date" size="16" v-model="project.start_date">
                                        </div>
                                        <div class="form-group">
                                        <label for="multiple" class="control-label">Assign to Employee</label>
                                        <!-- <select id="multiple" class="form-control select2-multiple" name="users[]" v-model="selectedUsers" multiple>
                                            <option v-for="user in users" v-bind:key="user.user_id" :value="user.user_id">{{user.first_name}} {{user.last_name}}</option>
                                        </select> -->

                                        <select id="multiple" class="form-control" v-model="selectedUsers" multiple>
                                            <option v-for="user in users" v-bind:key="user.user_id" :value="user.user_id">{{user.first_name}}</option>
                                        </select>
                                    </div>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </form>
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                        </div>
                    </div>
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
    </div>
</template>

<script>
import { promised } from 'q';
export default {
    head: {
        script: [
            { src: 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js' },
        ]
    },
    data(){
        return{
            projects: [],
            project: {
                project_name: '',
                project_description: '',
                start_date: ''
            },
            users: [],
            selectedUsers: [],
            assign_project_id: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    },
    created(){
        this.fetchProjects();
        this.fetchUsers();
    },
    methods:{
        fetchProjects(){
            axios.get('http://jira-app.com/api/project')
                    .then(response => this.projects = response.data['data']);
        },
        fetchUsers(){
            axios.get('http://jira-app.com/api/user')
                    .then(response => this.users = response.data['data']);
        },
        createProject(){
            axios.post('http://jira-app.com/api/project', {project: this.project, selectedUsers: this.selectedUsers})
            .then(response => {console.log(response); this.fetchProjects();});
        },
        assignEmployee(){
            axios.post('http://jira-app.com/api/assign_employee', {assign_project_id: this.assign_project_id, selectedUsers:this.selectedUsers})
            .then(response => {console.log(response);});
        },
        modal_assign(project){

            $('#assign').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                $('#projectName').text(project.name);
                this.assign_project_id = project.project_id;
                console.log(this.assign_project_id);
            });
        }  
    }
}

</script>


