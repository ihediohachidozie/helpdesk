<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col"><h4 class="card-title">Customers</h4></div>
                            <div class="col"><a href="#" class="btn btn-primary btn-sm float-right" @click="newCust">Add</a></div>
                        </div>   
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Job Title </th>
                                    <th> Department </th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="customer in customers.data" :key="customer.id">
                                    <td v-text="customer.firstname + ' ' + customer.lastname"></td>
                                    <td v-text="customer.email"></td>
                                    <td v-text="customer.job_title"></td>
                                    <td v-text="customer.department.name"></td>
                                    <td><a @click="editCust(customer)" ><i class="fa fa-edit" style="font-size:24px; color:dodgerblue"></i></a></td>
                                    <!--  <td><button @click="onDelete(post.id)" class="btn btn-danger btn-sm">delete</button></td> -->
                                    <td>
                                        <a @click="confirm(customer.id)">
                                            <i class="fa fa-trash" style="font-size:24px; color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-2">
                            <pagination :data="customers" @pagination-change-page="fetchCust">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- The save post Modal  -->
            <div class="modal" id="addCust">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">New Customer</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
            
                            <form method="POST" @submit.prevent="onSubmit" autocomplete="off">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Firstname</label>
                                            <input type="text" name="firstname" id="firstname" class="form-control form-control-user" v-model="firstname" required>
                                            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Lastname</label>
                                            <input type="text" name="lastname" id="lastname" class="form-control form-control-user" v-model="lastname" required>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-user">Email</label>
                                    <input type="text" name="email" id="email" class="form-control form-control-user" v-model="email" required>
                                                                   
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Job Title</label>
                                            <input type="text" name="job_title" id="job_title" class="form-control form-control-user" v-model="job_title">
                                            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Department</label>
                                                <select v-model ="department_id" class="form-control" id="exampleFormControlSelect2" required>
                                                    <option v-for="department in departments" :value="department.id">{{department.name}}</option>
                                                </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Add
                                    Customer</button>
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
            <div class="modal" id="editCust">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Customer</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" @submit.prevent="onUpdate(customer_id)" autocomplete="off" >
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Firstname</label>
                                            <input type="text" name="firstname" id="firstname" class="form-control form-control-user"
                                                v-model="firstname" required>
                                            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Lastname</label>
                                            <input type="text" name="lastname" id="lastname" class="form-control form-control-user"
                                                v-model="lastname" required>
                                         
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-user">Email</label>
                                    <input type="text" name="email" id="email" class="form-control form-control-user"
                                        v-model="email" required>
                                    
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Job Title</label>
                                            <input type="text" name="job_title" id="job_title"
                                                class="form-control form-control-user" v-model="job_title">
                                            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Department</label>
                                                <select v-model="department_id" class="form-control" id="exampleFormControlSelect2" required>
                                                    <option v-for="department in departments" :value="department.id">{{department.name}}</option>
                                                </select>
                                                
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Update Customer</button>
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
            <div class="modal" id="deleteCust">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Attention User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Do you want to delete this Customer? </p>
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
                customers: [],
                customer_id: '',
                customer: '',
                firstname: '',
                lastname: '',
                email: '',
                job_title: '',
                department_id: '',
                message: '',
                department: '',
                departments: [],
                errors: ''
            }
            
        },
        mounted() {
            this.fetchCust(),
            this.fetchDept();
            console.log('Component mounted.')
        },
        methods:{
            fetchCust(page = 1) {
                // display departments..
                axios.get('/customer?page='+page)
                .then(({ data }) => this.customers = data);
            },
            fetchDept() {
                axios.get('/customer.department')
                    .then(({ data }) => this.departments = data);
            },
            newCust() {
                this.firstname = this.lastname = this.email = this.job_title = this.department_id = '';
                this.message = '';
                $("#addCust").modal("show");
            },
            onSubmit() {
                // save the data...
               // alert(this.department_id);
                axios.post('/customer', this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
            },
            onSuccess(response) {
                this.message = response.data.message;
                this.firstname = this.lastname = this.email = this.job_title = this.department_id = '';
                this.fetchCust();
            },
            editCust(customer) {
                $("#editCust").modal("show");
                
                this.message = '';
                this.firstname = customer.firstname;
                this.lastname = customer.lastname;
                this.email = customer.email;
                this.job_title = customer.job_title;
                this.department_id = customer.department_id;
                this.customer_id = customer.id;

            },
            onUpdate(customer_id) {
                axios.put('/customer/' + this.customer_id, this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
                $("#editCust").modal("hide");
            },
            confirm(id) {
                this.customer_id = id;
                $("#deleteCust").modal("show");
            },
            onDelete() {
                //   alert(this.post_id);
                axios.delete('/customer/' + this.customer_id)
                .then(response => {
                    alert(response.data.message);
                    this.fetchCust();
                });
            }            
        }
    }
</script>