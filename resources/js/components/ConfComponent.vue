<template>
    <div class="container">
        <form>
        <div class="form-group">
            <label for="company_name">Company name</label>
            <input type="text" class="form-control" id="company_name" placeholder="Enter company name" v-model="info.company.name">
        </div>
        <div class="form-group">
            <label for="sprint_length">Sprint length</label>
            <input type="number" class="form-control" id="sprint_length" placeholder="Enter sprint length" v-model="info.sprint.length">
        </div>
        <div class="form-group">
            <label for="sprint_points">Sprint points</label>
            <input type="number" class="form-control" id="sprint_points" placeholder="Enter sprint points" v-model="info.sprint.points">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            info: []
            
        }
    },
    created(){
        this.loading = false;
        this.fetchData();
    },
    methods:{
        fetchData(){
            axios.get('http://jira-app.com/api/info')
                .then(response => this.info = response.data.info);
        }
    }

}
</script>

