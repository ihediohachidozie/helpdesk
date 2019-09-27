<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col"><h4 class="card-title">Issue Category</h4></div>
                            <div class="col"><a href="#" class="btn btn-primary btn-sm float-right" @click="newIssue">Add</a></div>
                        </div>   
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Category </th>
                                    <th colspan="2" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="issueCategory in issueCategories.data" :key="issueCategory.id">
                                    <td v-text="issueCategory.name"></td>
                                    <td class="text-center"><a @click="editIssue(issueCategory)" ><i class="fa fa-edit" style="font-size:24px; color:dodgerblue"></i></a></td>
                                    <!--  <td><button @click="onDelete(post.id)" class="btn btn-danger btn-sm">delete</button></td> -->
                                    <td class="text-center">
                                        <a @click="confirm(issueCategory.id)">
                                            <i class="fa fa-trash" style="font-size:24px; color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-2">
                            <pagination :data="issueCategories" @pagination-change-page="getCats">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The save post Modal  -->
            <div class="modal" id="addIssue">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">New Issue Category</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
            
                            <form method="POST" @submit.prevent="onSubmit">
                                <div class="form-group">
                                    <label class="form-control-user">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-user"
                                        v-model="name" required>
                                    
            
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" >Create</button>
            
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
            <div class="modal" id="editIssue">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Issue Category</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" @submit.prevent="onUpdate(issueCategory_id)" class="user">
                                <div class="form-group">
                                    <label class="form-control-user">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-user"
                                        v-model="name" required>
                                    
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" >Update</button>
            
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
            <div class="modal" id="deleteIssue">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Attention User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Do you want to delete this Issue Category? </p>
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
                issueCategories: [],
                issueCategory_id: '',
                issueCategory: '',
                name: '',
                message: '',
                errors: ''
            }
        },
        mounted() {
            this.getCats(),
            console.log('Component mounted.')
        },
        methods:{
            getCats(page = 1) {
                axios.get('/issueCategory?page=' + page)
                    .then(response => {
                        this.issueCategories = response.data;
                    });
                },
            fetchIssue() {
                // display departments..
                axios.get('/issueCategory')
                .then(({ data }) => this.issueCategories = data);
            },
            newIssue() {
                this.name = '';
                this.message = '';
                $("#addIssue").modal("show");
            },
            onSubmit() {
                // save the data...
                axios.post('/issueCategory', this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
            },
            onSuccess(response) {
                this.message = response.data.message;
                this.name = '';
                this.fetchIssue();
            },
            editIssue(issueCategory) {
                $("#editIssue").modal("show");
                this.message = '';
                this.name = issueCategory.name;
                this.issueCategory_id = issueCategory.id;
         
            },
            onUpdate(issueCategory_id) {
                axios.put('/issueCategory/' + issueCategory_id, this.$data)
                .then(this.onSuccess)
                .catch(error => {
                    alert(error.response.data.message)
                });
                $("#editIssue").modal("hide");
            },
            confirm(id) {
                this.issueCategory_id = id;
                $("#deleteIssue").modal("show");
            },
            onDelete() {
                //   alert(this.post_id);
                axios.delete('/issueCategory/' + this.issueCategory_id)
                .then(response => {
                    alert(response.data.message);
                    this.fetchIssue();
                });
            }            
        }
    }
</script>
