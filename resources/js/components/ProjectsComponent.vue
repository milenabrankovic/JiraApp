<template>
<div class="portlet light ">
            <div class="page-head">
            <div class="page-title">
                <h1>Projects</h1>
            </div>
            </div>
            <div class="portlet-title">
                <div id="prefix_1438324840626" class="custom-alerts alert alert-success">Here you can see projects you are on.</div>
            </div>
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
                        <th class="text-center"> Tasks </th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr v-if="!userProjects.length" class="no-data">
                      <td colspan="5" class="text-center">Projects not found</td>
                    </tr>
                    <tr v-else v-for="project in userProjects" v-bind:key="project.project_id" data-toggle="collapse" v-bind:data-target="'#collapse'+project.project_id">
                      <td> {{project.name}} </td>
                      <td> {{project.description}} </td>
                      <td> {{project.start_date.split(' ')[0]}} </td>
                      <td> ks </td>
                      <td class="text-center"><a href="#tasks_modal" @click="openTasksModal(project)"><i class="icon-list font-green"></i></a></td>
                      <br>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" tabindex="-1" role="dialog"   id="tasks_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title">Tasks by "<span id="project_name_tasks"></span>" project </h5>
                    </div>
                      <div class="modal-footer">
                          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
  </div>

    <!-- <div class="accordion" id="accordionExample">
  <div class="card" v-for="project in userProjects" v-bind:key="project.project_id"> 
    <div class="card-header" v-bind:id="'heading'+project.project_id">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" v-bind:data-target="'#collapse'+project.project_id" aria-expanded="true" v-bind:aria-controls="'collapse'+project.project_id">
          {{project.name}}
        </button>
      </h5>
    </div>

    <div v-bind:id="'collapse'+project.project_id" class="collapse" v-bind:aria-labelledby="'heading'+project.project_id" data-parent="#accordionExample">
      <div class="card-body">
          {{project.description}}
          <span class="badge badge-primary float-right">{{project.start_date}}</span>
      </div>
    </div>
  </div>
</div> -->
</template>

<script>
export default {
    data(){
        return{
            userProjects: [],
            tasksByProject: []
        }
    },
    created(){
        this.fetchData();
        console.log(this.$auth.user().user_id);
    },
    methods:{
        fetchData(){
            axios.get('http://jira-app.com/api/projects_by_user', {params:{id:this.$auth.user().user_id}})
                 .then(response => this.userProjects = response.data);
        },
        openTasksModal(project){
            $('#tasks_modal').find('.modal-header #project_name_tasks').text(project.name);

            axios.get('http://jira-app.com/api/tasks_by_project', {params:{user_id:this.$auth.user().user_id, project_id: project.project_id}})
                 .then(response => console.log(response));
        },
    }
}
</script>
