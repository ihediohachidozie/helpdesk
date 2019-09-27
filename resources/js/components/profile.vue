<template>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Page Title Header Starts-->
<!--             <div class="row page-title-header">
                <div class="col-12">
                    <div class="page-header">
                        <h4 class="page-title">User's Profile</h4>
            
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-6 d-flex align-items-stretch grid-margin">
                    <div class="row flex-grow">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="card-title">User information</h1>
                                </div>
                                <div class="card-body text-center">
                                    <form class="forms-sample" method="POST" @submit.prevent="onUpdate(id)" >

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" v-model="name">
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email" v-model="email">
                                        </div>

                                        <button type="submit" class="btn btn-success btn-block mr-2 p-3">Update Information</button>
                                        
                                    </form>
                                    <!-- <div class="text-info pt-3" v-text="message"></div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Change Password</h4>
                                </div>
                                <div class="card-body">
                                    <form class="forms-sample" method="POST" @submit.prevent="onPwUpdate(id)">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="current_password" placeholder="Current Password" v-model="current_password"> 
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"  name="password" placeholder="Password" v-model="password">           
                                        </div>
                                        <div class="form-group">    
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" v-model="password_confirmation">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block mr-2 p-3">Change Password</button>
                                    </form>
                                   <!--  <div class="text-info pt-3" v-text="message"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Profile Picture</h4>

                        </div>
                        <div class="card-body text-center">
                            <div class="col-md-3 text-center" v-if="image">
                                <img :src="image" class="img-responsive" height="70" width="90">
                            </div>
                        <form @submit="onPicUpdate" enctype="multipart/form-data">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01" @change="onImageChange">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            
                            <div class="my-2"></div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-user btn-block">Change Image</button>
                            </div>
                        
                        </form>
                            <!-- <img class="img-md rounded-circle mb-5" :src="image" width="400px"> -->
<!--                             <form class="forms-sample" @submit.prevent="onPicUpdate(id)" enctype="multipart/form-data">
                                <div class="form-group">
                                      
                                    <input type="file" class="form-control" @change="onImageChange">
                                </div>

                                <button type="submit" class="btn btn-success mr-2 p-3 btn-block">Submit</button>
                                
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer-part></footer-part>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->

</template>

<script>
    export default {
        data() {
            return {
                image: '',
                name: '',
                email: '',
                id: '',
                password: '',
                password_confirmation: '',
                current_password: '',
                message: ''
            }
        },
        created() {
          console.log('Component mounted.')
          this.getUser();
          
        },
        methods:{
            getUser(){
                axios.get('/profile')
                .then(({ data }) => {
                    this.name = data[0].name;
                    this.email = data[0].email;
                    this.image = data[0].image;
                    this.id = data[0].id;
                });
            },
            onUpdate(id) {
                //alert(this.name);
                axios.put('/profile/'+id, {
                    name: this.name,
                    email: this.email
                })
                .then(response => {
                    this.message = response.data.message;
                    alert(this.message);
                    this.getUser();                   
                })
                .catch(error => {
                    alert(error.response.data.message)
                });  
            },
            onPwUpdate(id){
                //alert(this.name);
                axios.put('/profile/'+id, {
                    current_password: this.current_password,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });               
            },
            onSuccess(response){
                this.message = response.data.message;
                alert(this.message);
                this.current_password = '',
                this.password = '',
                this.password_confirmation = ''
            },
            onImageChange(e) {
                console.log(e.target.files[0]);
                this.image = e.target.files[0];
            },
            onPicUpdate(e){
                 //alert(this.image);
                e.preventDefault();
                let currentObj = this;
                const config = {
                    headers: { 'Content-Type': 'multipart/form-data' }
                }
                let formData = new FormData();   
                formData.append('image', this.image);
                formData.append('id', this.id);

                //alert(this.id);
                axios.post('/profile', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.message;
                    alert(currentObj.success);
                })
                .catch(function (error) {
                    currentObj.output = error;
                });                
            }
        }
    }
</script>