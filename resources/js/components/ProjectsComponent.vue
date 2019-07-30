<template>
    <div class="accordion" id="accordionExample">
        <br/>
  <div class="card" v-for="project in projects" v-bind:key="project.project_id"> 
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
