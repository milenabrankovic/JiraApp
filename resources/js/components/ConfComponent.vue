<template>
    <div class="portlet light ">
        <div class="portlet-title">
            <div id="prefix_1438324840626" class="custom-alerts alert alert-success">Here you can configure your company name and sprint properties.</div>
        </div>
        <form  @submit.prevent="updateInfo" method="POST" role="form">
        <input type="hidden" name="_token" :value="csrf">
        
        <div class="form-group">
            <label for="company_name">Company name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company name" v-model="info.company_name">
        </div>
        <div class="form-group">
            <label for="sprint_length">Sprint length</label>
            <input type="number" class="form-control" id="sprint_length" name="sprint_length" placeholder="Enter sprint length" v-model="info.sprint_length">
        </div>
        <div class="form-group">
            <label for="sprint_points">Sprint points</label>
            <input type="number" class="form-control" id="sprint_points" name="sprint_points" placeholder="Enter sprint points" v-model="info.sprint_points">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            info: {
                company_name: '',
                sprint_length: '',
                sprint_points: ''
            },
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')   
        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        fetchData(){
            axios.get('http://jira-app.com/api/info')
                .then(response => 
                {
                    this.info.company_name = response.data.info.company.name;
                    this.info.sprint_length = response.data.info.sprint.length;
                    this.info.sprint_points = response.data.info.sprint.points;
                    
                });
        },
        updateInfo(){

            const currentObject = this;

            axios.post('http://jira-app.com/api/info_update', {info: currentObject.info})
            .then(function (response) {
                swal("Saved","", "success");
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        }   
    },
    
}
</script>

