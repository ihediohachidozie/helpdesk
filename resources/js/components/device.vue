<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col"><h4 class="card-title">Hardware</h4></div>
                            <div class="col"><a href="#" class="btn btn-primary btn-sm float-right" @click="newDevice">Add</a></div>
                        </div>   
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th> Device </th>
                                    <th> Description </th>
                                    <th> Location </th>
                                   
                                    <th> User </th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="device in devices.data" :key="device.id">
                                    <td v-text="device.device_type"></td>
                                    <td v-text="device.description"></td>
                                    <td v-text="device.location"></td>
                                   

                                    <td v-text="device.customer.firstname"></td>
                                    <td><a @click="editDevice(device)" ><i class="fa fa-edit" style="font-size:24px; color:dodgerblue"></i></a></td>
                                    <!--  <td><button @click="onDelete(post.id)" class="btn btn-danger btn-sm">delete</button></td> -->
                                    <td>
                                        <a @click="confirm(device.id)">
                                            <i class="fa fa-trash" style="font-size:24px; color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-2">
                            <pagination :data="devices" @pagination-change-page="fetchDevice">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The save post Modal  -->
            <div class="modal" id="addDevice">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">New Device</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
            
                            <form method="POST" @submit.prevent="onSubmit" autocomplete="off">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Device</label>
                                            <input type="text" name="device_type" id="device_type"
                                                class="form-control form-control-user" v-model="device_type" required>
            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Description</label>
                                            <input type="text" name="description" id="description"
                                                class="form-control form-control-user" v-model="description" required>
            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Location</label>
                                            <input type="text" name="location" id="location" class="form-control form-control-user"
                                                v-model="location">
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Model</label>
                                            <input type="text" name="model" id="model" class="form-control form-control-user"
                                                v-model="model">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Manufacturer</label>
                                            <input type="text" name="manufacture" id="manufacture"
                                                class="form-control form-control-user" v-model="manufacture">
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Operating System</label>
                                            <input type="text" name="os" id="os" class="form-control form-control-user"
                                                v-model="os">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label class="form-control-user">Customer</label>
                                    <select v-model="customer_id" class="form-control"
                                        id="exampleFormControlSelect2" required>
                                        <option v-for="customer in customers" :value="customer.id">{{customer.firstname}}
                                        </option>
                                    </select>
    
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Add
                                    Device</button>
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
            <div class="modal" id="editDevice">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Device</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" @submit.prevent="onUpdate(device_id)" autocomplete="off">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Device</label>
                                            <input type="text" name="device_type" id="device_type"
                                                class="form-control form-control-user" v-model="device_type" required>
            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Description</label>
                                            <input type="text" name="description" id="description"
                                                class="form-control form-control-user" v-model="description" required>
            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Location</label>
                                            <input type="text" name="location" id="location" class="form-control form-control-user"
                                                v-model="location">
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Model</label>
                                            <input type="text" name="model" id="model" class="form-control form-control-user"
                                                v-model="model">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Manufacturer</label>
                                            <input type="text" name="manufacture" id="manufacture"
                                                class="form-control form-control-user" v-model="manufacture">
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Operating System</label>
                                            <input type="text" name="os" id="os" class="form-control form-control-user"
                                                v-model="os">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
            
            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Customer</label>
                                            <select v-model="customer_id" class="form-control"
                                                id="exampleFormControlSelect2" required>
                                                <option v-for="customer in customers" :value="customer.id">{{customer.firstname}}
                                                </option>
                                            </select>
            
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Update
                                    Device</button>
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
            <div class="modal" id="deleteDevice">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Attention User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Do you want to delete this Device? </p>
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
                devices: [],
                device_id: '',
                device_type: '',
                description: '',
                location: '',
                model: '',
                manufacture: '',
                customer_id: '',
                message: '',
                os: "",
                customer: '',
                customers: [],
                errors: ''
            }
            
        },
        mounted() {
            this.fetchDevice(),
            this.fetchCust(),
            console.log('Component mounted.')
        },
        methods:{
            fetchCust() {
                // display departments..
                axios.get('/device.customer')
                .then(({ data }) => this.customers = data);
            },
            fetchDevice(page = 1) {
                axios.get('/device?page=' + page)
                    .then(({ data }) => this.devices = data);
            },
            newDevice() {
                this.device_type = this.description = this.location = this.manufacture = this.os = this.model = this.customer_id = '';
                this.message = '';
                $("#addDevice").modal("show");
            },
            onSubmit() {
                // save the data...
                axios.post('/device', this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
            },
            onSuccess(response) {
                this.message = response.data.message;
                this.device_type = this.description = this.location = this.manufacture = this.os = this.model = this.customer_id = '';
                this.fetchDevice();
            },
            editDevice(device) {
                $("#editDevice").modal("show");
                
                this.message = '';
                this.device_type = device.device_type;
                this.description = device.description;
                this.location = device.location;
                this.model = device.model;
                this.manufacture = device.manufacture;
                this.os = device.os;
                this.device_id = device.id;
                this.customer_id = device.customer_id;
            },
            onUpdate(device_id) {
                axios.put('/device/' + device_id, this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
                $("#editDevice").modal("hide");
            },
            confirm(id) {
                this.device_id = id;
                $("#deleteDevice").modal("show");
            },
            onDelete() {
                //   alert(this.post_id);
                axios.delete('/device/' + this.device_id)
                .then(response => {
                    alert(response.data.message);
                    this.fetchDevice();
                });
            }            
        }
    }
</script>