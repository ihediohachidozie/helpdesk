<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col">
                                <h4 class="card-title">WIP Tickets</h4>
                            </div>
                            <!-- <div class="col"><a href="#" class="btn btn-primary btn-sm float-right" @click="add">Add</a></div> -->
                        </div>
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th> ID </th>
                                    <th> Summary </th>
                                    <th> Customer </th>
                                    <th> Prority </th>
                                    <th> Status </th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ticket in tickets.data" :key="ticket.id" class="text-center">
                                    <td v-text="ticket.id"></td>
                                    <td v-text="ticket.summary" class="text-left"></td>
                                    <td v-text="ticket.customer.firstname"></td>
                                    <td>{{changePrority(ticket.prority)}}</td>
                                    <td>{{changeStatus(ticket.status)}}</td>
                                    <td><a @click="edit(ticket)"><i class="fa fa-edit"
                                                style="font-size:24px; color:dodgerblue"></i></a></td>
                                    <!--  <td><button @click="onDelete(post.id)" class="btn btn-danger btn-sm">delete</button></td> -->
                                    <td>
                                        <a @click="confirm(ticket.id)">
                                            <i class="fa fa-trash" style="font-size:24px; color:red"></i>
                                        </a>
                                    </td>
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
                </div>
            </div>


            <!-- The save post Modal  -->
            <div class="modal" id="add">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">New Ticket</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <form method="POST" @submit.prevent="onSubmit">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Summary</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="summary" id="summary"
                                                    v-model="summary" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Related</label>
                                            <div class="col-sm-9">
                                                <textarea name="related" id="related" class="form-control"
                                                    v-model="related" cols="30" rows="2"></textarea>

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
                                                <select v-model="customer_id" class="form-control"
                                                    id="exampleFormControlSelect2" required>
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
                                                    <option v-for="issueCategory in issueCategories"
                                                        :value="issueCategory.id">{{issueCategory.name}}
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
                                                <select v-model="prority" class="form-control"
                                                    id="exampleFormControlSelect2" required>
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
                                                <select v-model="status" class="form-control"
                                                    id="exampleFormControlSelect2" required>
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
                                                <select v-model="user_id" class="form-control"
                                                    id="exampleFormControlSelect2" required>
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
                                <button type="submit" class="btn btn-primary btn-user btn-block">Create Ticket</button>
                            </form>
                            <div v-if="message" class="alert alert-info alert-dismissible fade show text-center"
                                role="alert">
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
            <div class="modal" id="edit">
                <div class="modal-dialog modal-xl ">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Ticket</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" @submit.prevent="onUpdate(ticket_id)">
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
                                                <textarea name="related" id="related" class="form-control"
                                                    v-model="related" cols="30" rows="2"></textarea>

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
                                                <select v-model="customer_id" class="form-control"
                                                    id="exampleFormControlSelect2" required>
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
                                                    <option v-for="issueCategory in issueCategories"
                                                        :value="issueCategory.id">{{issueCategory.name}}
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
                                                <select v-model="prority" class="form-control"
                                                    id="exampleFormControlSelect2" required>
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
                                                <select v-model="status" class="form-control"
                                                    id="exampleFormControlSelect2" required>
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
                                                <select v-model="user_id" class="form-control"
                                                    id="exampleFormControlSelect2" required>
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
                                <button type="submit" class="btn btn-primary btn-user btn-block">Update Ticket</button>
                            </form>
                            <div v-if="message" class="alert alert-info alert-dismissible fade show text-center"
                                role="alert">
                                <strong>{{ message}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
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
                ticket_id: '',
                summary: '',
                description: '',
                issuecategory_id: '',
                customer_id: '',
                user_id: '',
                prority: '',
                status: '',
                related: '',
                resolution: '',
                message: '',
                errors: '',
                customer: '',
                customers: [],
                issueCategories: [],
                issueCategory: '',
                user: '',
                users: [],
                active: '',
                inactive: '',
                prorities: [],
                statuses: [],
                a: '',
                b: ''
            }
        },
        mounted() {
            this.fetch(),
                this.fetchCust(),
                this.fetchIssue(),
                this.fetchUsers(),
                this.getPrority(),
                this.getStatus(),
                console.log('Component mounted.')
        },
        methods: {
            fetch(page = 1) {
                // display departments..
                axios.get('/ticket.wiptickets?page=' + page)
                    .then(({ data }) => this.tickets = data);
            },
            fetchIssue() {
                // display departments..
                axios.get('/ticket.issuecategory')
                    .then(({ data }) => this.issueCategories = data);
            },
            fetchCust() {
                // display departments..
                axios.get('/ticket.customer')
                    .then(({ data }) => this.customers = data);
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
            add() {
                this.summary = this.description = this.customer_id = this.user_id = this.issuecategory_id = '';
                this.prority = this.status = this.resolution = this.related = this.ticket_id = '';
                this.message = '';
                $("#add").modal("show");
            },
            onSubmit() {
                // save the data...
                axios.post('/ticket', this.$data)
                    .then(this.onSuccess)
                    .catch(error => {
                        alert(error.response.data.message)
                    });
            },
            onSuccess(response) {
                this.message = response.data.message;
                this.summary = this.description = this.customer_id = this.user_id = this.issuecategory_id = '';
                this.prority = this.status = this.resolution = this.related = this.ticket_id = '';
                this.fetch();
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
            onUpdate(ticket_id) {
                axios.put('/ticket/' + ticket_id, this.$data)
                    .then(this.onSuccess)
                    .catch(error => {
                        alert(error.response.data.message)
                    });
                $("#edit").modal("hide");
            },
            confirm(id) {
                this.software_id = id;
                $("#delete").modal("show");
            },
            onDelete() {
                //   alert(this.post_id);
                axios.delete('/ticket/' + this.ticket_id)
                    .then(response => {
                        alert(response.data.message);
                        this.fetch();
                    });
            },
            changePrority(a) {
                return this.b = (a == 0 ? 'Low' : a == 1 ? 'Medium' : 'High');
            },
            changeStatus(a) {
                return this.b = (a == 0 ? 'Open' : a == 1 ? 'In-Progress' : 'Closed');
            }
        }
    }
</script>