<template>
  <div class="portlet light ">
      <div class="page-head">
        <div class="page-title">
            <h1>Tasks</h1>
        </div>
      </div>
      <div class="portlet-title">
                <div id="prefix_1438324840626" class="custom-alerts alert alert-success">Here you can manipulate with tasks and see list of your tasks as same as list of tasks that you assigned to your team sorted by projects.</div>
            </div>
      <div class="portlet-body">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_1_1" data-toggle="tab"> List </a>
            </li>
            <li>
                <a href="#tab_1_2" data-toggle="tab"> Assigned </a>
            </li>
            <li>
                <a href="#tab_1_3" data-toggle="tab"> Create </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab_1_1">
                <br>
                <select class="bs-select form-control input-small" id="projects" v-model="selectedProject" @change.prevent="changeTasks(selectedProject)">
                    <option value="" selected>All tasks</option>
                    <option v-for="project in userProjects" v-bind:key="project.project_id" :value="project.project_id">
                        {{project.name}}
                    </option>
                </select>
                <br/><br/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> Title </th>
                            <th> Description </th>
                            <th> Assigned by </th>
                            <th class="text-center"> Points </th>
                            <th> Status </th>
                            <th> Modify </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="!tasksByProject.length" class="no-data">
                        <td colspan="4" class="text-center">Tasks not found</td>
                        </tr>
                        <tr v-else v-for="task in tasksByProject" v-bind:key="task.task_id">
                        <td>{{task.title}}</td>
                        <td>{{task.description}}</td>
                        <td>{{task.first_name}} {{task.last_name}}</td>
                        <td class="text-center">{{task.points}}</td>
                        <td>{{task.name}}</td>
                        <td>
                            <a data-toggle="modal" @click="editModal(task)" href="#task_modal_user_edit"><i class="icon-pencil font-green" data-toggle="modal" ></i></a> 
                        </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" tabindex="-1" role="dialog"   id="task_modal_user_edit">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            
                            <h5 class="modal-title">Modify project "<span id="task_name"></span>'s" status?</h5>
                        </div>
                        <form role="form" method="post" @submit.prevent="editStatus()">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="put" />
                            <input type="hidden" id="task_id_to_edit" />
                            <div class="modal-footer">
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn green" @click="hideModal">Save</button>
                            </div>
                        
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_1_2">
                <br>
                <select class="bs-select form-control input-small" id="projectsParent" v-model="selectedProjectParent" @change.prevent="changeTasksParent(selectedProject)">
                    <option value="" selected>All tasks</option>
                    <option v-for="project in userProjects" v-bind:key="project.project_id" :value="project.project_id">
                        {{project.name}}
                    </option>
                </select>
                <br/><br/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> Title </th>
                            <th> Description </th>
                            <th> Assigned to </th>
                            <th class="text-center"> Points </th>
                            <th> Status </th>
                            <th> Modify </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="!tasksByParent.length" class="no-data">
                        <td colspan="4" class="text-center">Tasks not found</td>
                        </tr>
                        <tr v-else v-for="task in tasksByParent" v-bind:key="task.task_id">
                        <td>{{task.title}}</td>
                        <td>{{task.description}}</td>
                        <td>{{task.first_name}} {{task.last_name}}</td>
                        <td class="text-center">{{task.points}}</td>
                        <td>{{task.name}}</td>
                        <td>
                            edit
                        </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <div class="tab-pane fade" id="tab_1_3">
                <p>Create </p>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            userProjects: [],
            tasksByProject: [],
            tasksByParent: [],
            selectedProject: '',
            selectedProjectParent: ''
        }
    },
    props: {
        projectId: {
            default: ''
        }
    },
    watch: { 
        projectId: function(newVal, oldVal) { // watch it
            this.selectedProject = newVal;
            this.changeTasks();
        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        fetchData(){
            axios.get('http://jira-app.com/api/projects_by_user', {params:{id:this.$auth.user().user_id}})
                 .then(response => this.userProjects = response.data);

            axios.get('http://jira-app.com/api/tasks_by_project', {params:{user_id:this.$auth.user().user_id, project_id: 0}})
                 .then(response => this.tasksByProject = response.data);

            axios.get('http://jira-app.com/api/tasks_by_parent', {params:{user_id:this.$auth.user().user_id, project_id: 0}})
                 .then(response => this.tasksByParent = response.data);
        },
        changeTasks(){
            axios.get('http://jira-app.com/api/tasks_by_project', {params:{user_id:this.$auth.user().user_id, project_id: this.selectedProject}})
                 .then(response => this.tasksByProject = response.data);
        },
        changeTasksParent(){
            axios.get('http://jira-app.com/api/tasks_by_parent', {params:{user_id:this.$auth.user().user_id, project_id: this.selectedProjectParent}})
                 .then(response => this.tasksByParent = response.data);
        }
        
    }
}
</script>
