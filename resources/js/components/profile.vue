<template>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

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
                            <div class="row mb-3">
                                
                                <div class="mx-auto" v-if="imageURL">
                                    <img :src="imageURL" class="rounded-circle" height="300px" width="300px">
                                </div>
                                <div v-else class="mx-auto">
                                    <img src="/assets/images/faces/face8.jpg" class="rounded-circle" height="300px" width="300px">
                                </div>
                                <input style="display: none" type="file" name="image" @change="onImageChange" ref="fileInput">

                            </div>
                            <div class="row">
                                <div class="col"><button class="btn btn-success" @click="$refs.fileInput.click()">Select Image</button></div>
                                <div class="col"><button class="btn btn-primary" @click="onUpload">Upload</button></div>
                            </div>
                            
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
                imageURL:'',
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
                    this.imageURL = data[0].image;
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
               
                const file = e.target.files[0];
                this.image = file;
                this.imageURL = URL.createObjectURL(file);
            },
            onUpload(){
                let currentObj = this;
                const formData = new FormData();   
                formData.append('image', this.image, this.image.name);
                
                const config = {
                    headers: { 'Content-Type': 'multipart/form-data' }
                }

                axios.post('/picUpload', formData, config)
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