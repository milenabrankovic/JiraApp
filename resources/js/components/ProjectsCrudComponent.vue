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
                                                <tr  v-for="project in projects" v-bind:key="project.project_id">
                                                    <td> {{project.name}} </td>
                                                    <td> {{project.description}} </td>
                                                    <td> {{project.start_date}} </td>
                                                    <td> ks </td>
                                                    <td> Assign </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
                                   <form role="form" method="post" @submit="createProject">
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
export default {
data(){
        return{
            projects: [],
            project: {
                project_name: '',
                project_description: '',
                start_date: ''
            },
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        fetchData(){
            axios.get('http://jira-app.com/api/project')
                 .then(response => this.projects = response.data['data']);
        },
        createProject(){
            axios.post('http://jira-app.com/api/project')
            .then(function (response) {
                //swal("Saved","", "success");
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        }  
    }
}
</script>


