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
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-red-sunglo">
                                        <i class="icon-plus font-red-sunglo"></i>
                                        <span class="caption-subject bold uppercase"> Create Project</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Project Name</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-circle-left">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input type="text" class="form-control input-circle-right" placeholder="Project Name">
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label>Project Description</label>
                                             <div class="input-group">
                                                <span class="input-group-addon input-circle-left">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <textarea class="form-control input-circle-right" placeholder="Project Description"></textarea>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label>Start Date</label>
                                             <div class="input-group">
                                                <span class="input-group-addon input-circle-left">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input type="text" class="form-control input-circle-right" placeholder="Project Name">
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn blue">Submit</button>
                                            <button type="button" class="btn default">Cancel</button>
                                        </div>
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


