<template>
    
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Page Title Header Starts-->
            <div class="row page-title-header">
                <div class="col-12">
                    <div class="page-header">
                        <h4 class="page-title">Dashboard</h4>

                    </div>
                </div>
                <div class="col-md-12">

                </div>
            </div>
            <!-- Page Title Header Ends-->
            <div class="row grid-margin">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-0 font-weight-semibold">{{tickets.total}}</h1>
                            <h5 class="mb-2 font-weight-medium text-primary">Tickets Raised</h5>
                            <p class="mb-4 text-muted">Total number of requests reported.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-0 font-weight-semibold">{{closedTickets}}</h1>
                            <h5 class="mb-2 font-weight-medium text-primary"><router-link to="/home/closedtickets">Tickets Resolved</router-link></h5>
                            <p class="mb-4 text-muted">Total number of complaints resolved.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-0 font-weight-semibold">{{openTickets}}</h1>
                            <h5 class="mb-2 font-weight-medium text-primary"><router-link to="/home/openTickets">Open Tickets</router-link></h5>
                            <p class="mb-4 text-muted">Total number of Open complaints.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-0 font-weight-semibold">{{wipTickets}}</h1>
                            <h5 class="mb-2 font-weight-medium text-primary"><router-link to="/home/wiptickets">Tickets on WIP </router-link></h5>
                            <p class="mb-4 text-muted">Total number of complaints on WIP.</p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row grid-margin">
                <div class="col-lg-6 stretch-card">
                    <div class="card">
                        <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
                            <h4 class="card-title mb-0">Customer Satisfaction</h4>

                            <id id="pie-chart-legend" class="mr-4"></id>
                        </div>
                        <div class="card-body d-flex">
                            <p class="text-grey">Measures the quality or your support team’s efforts. It is important to monitor your customer
                                satisfaction status.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 stretch-card">
                    <div class="card">
                        <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
                            <h4 class="card-title mb-0">Top Performing Helpdesk Agents</h4>
                            <id id="scatter-chart-legend"></id>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <thead class="table-success">
                                    <td>Agent</td>
                                    <td>Issues Count</td>
                                </thead>
                                <tr v-for = "agent in agents" >
                                    <td v-text="agent.username"></td>
                                    <td v-text="agent.resolved"></td>
                                </tr>
                            </table>
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
        data(){
            return {
                data: [],
                id: '',
                tickets: [],
                openTickets: '',
                wipTickets: '',
                closedTickets: '',
                agents: [],
                agent: ''
            }
        },
        mounted() {
            this.fetch(),
            this.getStatus(),
            this.getAgents(),
            console.log('Component mounted.')
        },
        methods:{
            fetch(page = 1) {
                // get tickets..
                axios.get('/ticket?page=' + page)
                    .then(({ data }) => this.tickets = data);
            },
            getStatus() {
                axios.get('/ticket.open')
                .then(({data}) => {
                    this.openTickets = data[0];
                    this.wipTickets = data[1];
                    this.closedTickets = data[2];
                });
            },
            getAgents(){
                axios.get('ticket.agents')
                .then(({data}) => this.agents = data);
            }
        }
    }
</script>
