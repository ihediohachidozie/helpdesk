<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col"><h4 class="card-title">Softwares</h4></div>
                            <div class="col"><a href="#" class="btn btn-primary btn-sm float-right" @click="newSoft">Add</a></div>
                        </div>   
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th> Name </th>
                                    <th> License </th>
                                    <th> Verison </th>
                                    <th> Manufacturer </th>
                                    <th> Expiration </th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="software in softwares.data" :key="software.id">
                                    <td v-text="software.name"></td>
                                    <td v-text="software.license"></td>
                                    <td v-text="software.version"></td>
                                    <td v-text="software.manufacturer"></td>
                                    <td v-text="software.expire_date"></td>
                                    <td><a @click="editSoft(software)" ><i class="fa fa-edit" style="font-size:24px; color:dodgerblue"></i></a></td>
                                    <!--  <td><button @click="onDelete(post.id)" class="btn btn-danger btn-sm">delete</button></td> -->
                                    <td>
                                        <a @click="confirm(software.id)">
                                            <i class="fa fa-trash" style="font-size:24px; color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-2">
                            <pagination :data="softwares" @pagination-change-page="fetchSoft">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The save post Modal  -->
            <div class="modal" id="addSoft">
                <div class="modal-dialog">
                    <div class="modal-content"> 
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">New Software</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
            
                            <form method="POST" @submit.prevent="onSubmit" autocomplete="off">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Name</label>
                                            <input type="text" name="name" id="name" class="form-control form-control-user" v-model="name" required>
                                            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Verison</label>
                                            <input type="text" name="version" id="version" class="form-control form-control-user" v-model="version">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-user">License</label>
                                    <input type="text" name="license" id="license" class="form-control form-control-user" v-model="license">
                                                                  
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Manufacturer</label>
                                            <input type="text" name="manufacturer" id="manufacturer" class="form-control form-control-user" v-model="manufacturer">
                                            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Expiration</label>
                                            <input type="date" name="expire_date" id="expire_date" class="form-control form-control-user" v-model="expire_date">
                                           
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" >Add
                                    Software</button>
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
            <div class="modal" id="editSoft">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Department</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" @submit.prevent="onUpdate(software_id)" autocomplete="off">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Name</label>
                                            <input type="text" name="name" id="name" class="form-control form-control-user" v-model="name" required>
                                            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Verison</label>
                                            <input type="text" name="version" id="version" class="form-control form-control-user" v-model="version">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-user">License</label>
                                    <input type="text" name="license" id="license" class="form-control form-control-user" v-model="license">
                                    
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-control-user">Manufacturer</label>
                                            <input type="text" name="manufacturer" id="manufacturer" class="form-control form-control-user"
                                                v-model="manufacturer">
                                            
                                        </div>
                                        <div class="col">
                                            <label class="form-control-user">Expiration</label>
                                            <input type="date" name="expire_date" id="expire_date" class="form-control form-control-user"
                                                v-model="expire_date">
                                            
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" >Update
                                    Software</button>
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
            <div class="modal" id="deleteSoft">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Attention User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Do you want to delete this Software? </p>
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
                softwares: [],
                software_id: '',
                name: '',
                version: '',
                manufacturer: '',
                license: '',
                expire_date: '',
                message: '',
            }
        },
        mounted() {
            this.fetchSoft(),
            console.log('Component mounted.')
        },
        methods:{
            fetchSoft(page = 1) {
                // display departments..
                axios.get('/software?page=' + page)
                .then(({ data }) => this.softwares = data);
            },
            newSoft() {
                this.name = this.license = this.version = this.manufacturer = this.expire_date = '';
                this.message = '';
                $("#addSoft").modal("show");
            },
            onSubmit() {
                // save the data...
                axios.post('/software', this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
            },
            onSuccess(response) {
                this.message = response.data.message;
                this.fetchSoft();
                this.name = this.license = this.version = this.manufacturer = this.expire_date = this.message = '';
                
            },
            editSoft(software) {
                $("#editSoft").modal("show");
                this.message = '';
                this.name = software.name;
                this.software_id = software.id;
                this.manufacturer = software.manufacturer;
                this.license = software.license;
                this.version = software.version;
                this.expire_date = software.expire_date;
            },
            onUpdate(software_id) {
                axios.put('/software/' + software_id, this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
                $("#editSoft").modal("hide");
            },
            confirm(id) {
                this.software_id = id;
                $("#deleteSoft").modal("show");
            },
            onDelete() {
                //   alert(this.post_id);
                axios.delete('/software/' + this.software_id)
                .then(response => {
                    alert(response.data.message);
                    this.fetchSoft();
                });
            }            
        }
    }
</script>