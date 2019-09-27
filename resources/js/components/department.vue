<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col"><h4 class="card-title">Departments</h4></div>
                            <div class="col"><a href="#" class="btn btn-primary btn-sm float-right" @click="newDept">Add</a></div>
                        </div>   
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Department </th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="department in departments.data" :key="department.id" class="text-center">
                                    <td v-text="department.name" class="text-left"></td>
                                    <td><a @click="editDept(department)" ><i class="fa fa-edit" style="font-size:24px; color:dodgerblue"></i></a></td>
                                    <!--  <td><button @click="onDelete(post.id)" class="btn btn-danger btn-sm">delete</button></td> -->
                                    <td>
                                        <a @click="confirm(department.id)">
                                            <i class="fa fa-trash" style="font-size:24px; color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-2">
                            <pagination :data="departments" @pagination-change-page="fetchDept">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The save post Modal  -->
            <div class="modal" id="addDept">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">New Department</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
            
                            <form method="POST" @submit.prevent="onSubmit" autocomplete="off">
                                <div class="form-group">
                                    <label class="form-control-user">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-user"
                                        v-model="name" required>
                                   
            
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Create Department</button>
            
                            </form>
                            <div v-if="message" class="alert alert-info alert-dismissible fade show text-center" role="alert">
                                <strong>{{ message}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>
            <!-- The update post Modal  -->
            <div class="modal" id="editDept">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Department</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" @submit.prevent="onUpdate(department_id)" class="user" autocomplete="off">
                                <div class="form-group">
                                    <label class="form-control-user">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-user"
                                        v-model="name" required>
                                    
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" >Update Department</button>
            
                            </form>
                            <div v-if="message" class="alert alert-info alert-dismissible fade show text-center" role="alert">
                                <strong>{{ message}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
            <!-- The delete post Modal  -->
            <div class="modal" id="deleteDept">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Attention User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Do you want to delete this Department? </p>
                        </div>
            
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" @click="onDelete" class="btn btn-success" data-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                        </div>
            
                    </div>
                </div>
            </div>

        </div>
        <footer-part></footer-part>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: [],
                departments: [],
                department_id: '',
                name: '',
                message: '',
                errors: ''
            }
        },
        mounted() {
            this.fetchDept(),
            console.log('Component mounted.')
        },
        methods:{
            fetchDept(page = 1) {
                // display departments..
                axios.get('/department?page=' + page)
                .then(({ data }) => this.departments = data);
            },
            newDept() {
                this.name = '';
                this.message = '';
                $("#addDept").modal("show");
            },
            onSubmit() {
                // save the data...
                axios.post('/department', this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
            },
            onSuccess(response) {
                this.message = response.data.message;
                this.name = '';
                this.fetchDept();
            },
            editDept(department) {
                $("#editDept").modal("show");
                this.message = '';
                this.name = department.name;
                this.department_id = department.id;
         
            },
            onUpdate(department_id) {
                axios.put('/department/' + department_id, this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
                $("#editDept").modal("hide");
            },
            confirm(id) {
                this.department_id = id;
                $("#deleteDept").modal("show");
            },
            onDelete() {
                //   alert(this.post_id);
                axios.delete('/department/' + this.department_id)
                .then(response => {
                    alert(response.data.message);
                    this.fetchDept();
                });
            }            
        }
    }
</script>