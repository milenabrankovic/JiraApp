<template>
<div>
        <div class="portlet light ">
            <div class="page-head">
            <div class="page-title">
                <h1>Users</h1>
            </div>
            </div>
            <div class="portlet-title">
                <div id="prefix_1438324840626" class="custom-alerts alert alert-success">Here you can do CRUD actions on users.</div>
            </div>
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list font-green"></i>
                    <span class="caption-subject font-green bold uppercase">User List</span>
                </div>
                 
            </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th> First Name</th>
                                    <th> Last Name </th>
                                    <th> Username </th>
                                    <th> Email </th>
                                    <th> Role </th>
                                    <th> Leader </th>
                                    <th> Modify </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!users.length" class="no-data">
                                    <td colspan="7" class="text-center">Users not found</td>
                                </tr>
                                <tr v-if="users.length" v-for="user in users" v-bind:key="user.user_id">
                                    <td> {{user.first_name}} </td>
                                    <td> {{user.last_name}} </td>
                                    <td> {{user.username}} </td>
                                    <td> {{user.email}} </td>
                                    <td> {{user.name}} </td>
                                    <td> {{user.parent_id}} </td>
                                    <td> 
                                        <a data-toggle="modal" href="#user_modal"><i class="icon-pencil font-green" data-toggle="modal" ></i></a> /
                                        <a href="#delete_user_modal" data-toggle="modal" style="color:red;"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="clearfix margin-bottom-20"> </div>
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
            users: [],
            edit: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    },
    created(){
        this.fetchUsers();
    },
    methods:{

        fetchUsers(){
            axios.get('http://jira-app.com/api/user')
                    .then(response => { console.log(response['data']); this.users = response['data']});
        }
    }
}
</script>