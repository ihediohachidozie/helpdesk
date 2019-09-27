<template>
    <div class="main-panel">
        <div class="content-wrapper">
  
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search Type </h4>
 
                            <form class="mt-2">
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="radio1">
                                        <input type="radio" class="form-check-input" id="radio1" name="search" value="Category" v-model="search"
                                            checked>Category
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="radio2">
                                        <input type="radio" class="form-check-input" id="radio2" name="search" value="Customer"
                                            v-model="search">Customer
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" id="radio3" name="search" value="Both" v-model="search">Both
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2" v-if="search == 'Category'">
                                <div class="col-6">
                                    <label class="form-label">Category:</label>
                                    <select v-model="issuecategory_id" @change="onChange($event)" class="form-control" id="exampleFormControlSelect2">
                                        <option v-for="issueCategory in issueCategories" :value="issueCategory.id">{{issueCategory.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2" v-else-if="search == 'Customer'">
                                 <div class="col-6">
                                    <label class="form-label">Customer:</label>
                                    <select v-model="customer_id" @change="onChange($event)" class="form-control" id="exampleFormControlSelect2">
                                        <option v-for="customer in customers" :value="customer.id">{{customer.firstname}}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2" v-else-if="search == 'Both'">
                                   <div class="col">
                                    <label class="form-label">Category:</label>
                                    <select v-model="issuecategory_id" @change="onCat" class="form-control" id="exampleFormControlSelect2">
                                        <option v-for="issueCategory in issueCategories" :value="issueCategory.id">{{issueCategory.name}}
                                        </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">Customer:</label>
                                    <select v-model="customer_id" @change="onCust" class="form-control" id="exampleFormControlSelect2">
                                        <option v-for="customer in customers" :value="customer.id">{{customer.firstname}}
                                        </option>
                                    </select>
     
                                </div>
                                <div class="col pt-2">
                                    <br>
                                    <a href="#" class="btn btn-primary btn-sm " @click="getBoth">Display</a>
                                </div>
                            </div>
                            
                        
                            
                            <div v-if="tickets">
                                <table class="table table-bordered mt-3">
                                    <thead class="text-center">
                                        <tr>
                                            <th> ID </th>
                                            <th> Summary </th>
                                            <th> Customer </th>
                                            <th> Prority </th>
                                            <th> Status </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>  
                                    
                                    <tbody>
                                        <tr v-for="ticket in tickets.data" :key="ticket.id" class="text-center">
                                            <td v-text="ticket.id"></td>
                                            <td v-text="ticket.summary" class="text-left"></td>
                                            <td v-text="ticket.customer.firstname"></td>
                                            <td>{{changePrority(ticket.prority)}}</td>
                                            <td>{{changeStatus(ticket.status)}}</td>
                                            <td><a @click="edit(ticket)"><i class="fa fa-eye" style="font-size:24px; color:dodgerblue"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-2">
                                    <pagination :data="tickets" @pagination-change-page="fetch">
                                        <span slot="prev-nav">&lt; Previous</span>
                                        <span slot="next-nav">Next &gt;</span>
                                    </pagination>
                                </div>
                               
                            </div>
                            <div v-else>
                                <p class="text-info text-center text-bold mt-3">No record..</p>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- The update post Modal  -->
            <div class="modal" id="edit">
                <div class="modal-dialog modal-xl ">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">View Ticket</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Summary</label>
                                            <div class="col-sm-9">
                                                <!--  <input type="text" class="form-control" name="summary" id="summary" v-model="summary" /> -->
                                                <input type="text" name="summary" id="summary"
                                                    class="form-control form-control-user" v-model="summary" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Related</label>
                                            <div class="col-sm-9">
                                                <textarea name="related" id="related" class="form-control" v-model="related"
                                                    cols="30" rows="2"></textarea>
            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="description" id="description" class="form-control"
                                                    v-model="description" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Resolution</label>
                                            <div class="col-sm-9">
                                                <textarea name="resolution" id="resolution" class="form-control"
                                                    v-model="resolution" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Customer</label>
                                            <div class="col-sm-9">
                                                <select v-model="customer_id" class="form-control" id="exampleFormControlSelect2"
                                                    required>
                                                    <option v-for="customer in customers" :value="customer.id">
                                                        {{customer.firstname}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Category</label>
                                            <div class="col-sm-9">
                                                <select v-model="issuecategory_id" class="form-control"
                                                    id="exampleFormControlSelect2" required>
                                                    <option v-for="issueCategory in issueCategories" :value="issueCategory.id">
                                                        {{issueCategory.name}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Prority</label>
                                            <div class="col-sm-9">
                                                <select v-model="prority" class="form-control" id="exampleFormControlSelect2"
                                                    required>
                                                    <option v-for="(key, value) in prorities" :value="value">
                                                        {{key}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <select v-model="status" class="form-control" id="exampleFormControlSelect2"
                                                    required>
                                                    <option v-for="(key, value) in statuses" :value="value">
                                                        {{key}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">HD Agent</label>
                                            <div class="col-sm-9">
                                                <select v-model="user_id" class="form-control" id="exampleFormControlSelect2"
                                                    required>
                                                    <option v-for="user in users" :value="user.id">{{user.name}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
            
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-user btn-block" data-dismiss="modal">Close Ticket</button>
                               
                            </form>
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
                tickets: [],
                id: '',
                issueCategories: [],
                issueCategory: '',
                issuecategory_id: '',
                customer: '',
                customers: [],
                customer_id: '',
                search:'',
                prorities: [],
                statuses: [],
                user: '',
                users: [],
                user_id: '',
                prority: '',
                status: '',
                related: '',
                resolution: '',
                summary: '',
                description: '',
                message: '',
            }
        },
        mounted() {
            this.fetch(),
            this.fetchIssue(),
            this.fetchCust(),
            this.fetchUsers(),
            this.getPrority(),
            this.getStatus(),
            console.log('Component mounted.')
        },
        methods:{
            fetch(page = 1) {
                // display departments..
                axios.get('/ticket?page=' + page)
                    .then(({ data }) => this.tickets = data);
            },
            onChange: function (event) {
                this.id = event.target.value;
                this.getTickets();
            },
            onCat: function (event) {
                this.issuecategory_id = event.target.value;
            },
            onCust: function (event) {
                this.customer_id = event.target.value;
            }, 
            fetchCust() {
                // display departments..
                axios.get('/ticket.customer')
                    .then(({ data }) => this.customers = data);
            },
            getTickets(){
             //   alert(this.search);
                this.tickets = [];
                axios.get('/ticket.search/'+ this.id+'/'+this.search)
                    .then(({ data }) => this.tickets = data);
            },
            getBoth() {
                //alert(this.customer_id);
                this.tickets = [];
                axios.get('/ticket.both/'+ this.issuecategory_id +'/'+ this.customer_id)
                    .then(({ data }) => this.tickets = data);
            }, 
            fetchIssue() {
                // display departments..
                axios.get('/ticket.issuecategory')
                    .then(({ data }) => this.issueCategories = data);
            },
            changePrority(a) {
                return this.b = (a == 0 ? 'Low' : a == 1 ? 'Medium' : 'High');
            },
            changeStatus(a) {
                return this.b = (a == 0 ? 'Open' : a == 1 ? 'In-Progress' : 'Closed');
            },
            fetchUsers() {
                // get helpdesk agents...
                axios.get('/ticket.users')
                    .then(({ data }) => this.users = data);
            },
            getPrority() {
                // get helpdesk agents...
                axios.get('/ticket.prority')
                    .then(({ data }) => this.prorities = data);
            },
            getStatus() {
                // get helpdesk agents...
                axios.get('/ticket.status')
                    .then(({ data }) => this.statuses = data);
            },
            edit(ticket) {
                $("#edit").modal("show");

                this.message = '';
                this.ticket_id = ticket.id;
                this.summary = ticket.summary;
                this.description = ticket.description;
                this.customer_id = ticket.customer_id;
                this.user_id = ticket.user_id;
                this.issuecategory_id = ticket.issuecategory_id;
                this.prority = ticket.prority;
                this.status = ticket.status;
                this.related = ticket.related;
                this.resolution = ticket.resolution;
            },
        }
    }
</script>