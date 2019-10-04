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
                            <h5 class="mb-2 font-weight-medium text-primary">
                                <div v-if="closedTickets > 0">
                                    <router-link to="/home/closedtickets">Tickets Resolved</router-link>
                                </div>
                                <div v-else>
                                    Tickets Resolved
                                </div>
                            </h5>
                            <p class="mb-4 text-muted">Total number of complaints resolved.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-0 font-weight-semibold">{{openTickets}}</h1>
                            <h5 class="mb-2 font-weight-medium text-primary">
                                <div v-if="openTickets > 0">
                                    <router-link to="/home/openTickets">Open Tickets</router-link>
                                </div>
                                <div v-else>
                                    Open Tickets

                                </div>
                            </h5>
                            <p class="mb-4 text-muted">Total number of Open complaints.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-0 font-weight-semibold">{{wipTickets}}</h1>
                            <h5 class="mb-2 font-weight-medium text-primary">
                                <div v-if="wipTickets > 0">
                                    <router-link to="/home/wiptickets">Tickets on WIP </router-link>
                                </div>
                                <div v-else> 
                                    Tickets on WIP
                                </div>
                                
                            </h5>
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

                        </div>
                        <div class="card-body d-flex">
                            <div class="d-flex flex-column">
         
                                <table class="table table-bordered text-center">
                                    <thead class="table-success">
                                        <td>Great</td>
                                        <td>Good</td>
                                        <td>Okay</td>
                                        <td>Bad</td>
                                        <td>Terrible</td>
                                    </thead>
                                    <tr>
                                        <td>{{greatP}}</td>
                                        <td>{{goodP}}</td>
                                        <td>{{okayP}}</td>
                                        <td>{{badP}}</td>
                                        <td>{{terribleP}}</td>
                                    </tr>
                                </table>
                             </div>
                            
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
                survey: [],
                id: '',
                tickets: [],
                openTickets: '',
                wipTickets: '',
                closedTickets: '',
                agents: [],
                agent: '',
                great: '',
                good: '',
                okay: '',
                bad:'',
                terrible:'',
        
            }
        },
        mounted() {
            this.fetch(),
            this.getStatus(),
            this.getAgents(),
            this.getSurvey(),
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
            },
            getSurvey(){
                this.id = 9;
                axios.get('survey.count/'+this.id)
                //.then(({data}) => this.survey = data);
                .then(({ data }) => {
                    this.terrible = data[0].survey_count;
                    this.bad = data[1].survey_count;
                    this.okay = data[2].survey_count;
                    this.good = data[3].survey_count;
                    this.great = data[4].survey_count;
                    //this.sum = parseInt(this.terrible) + parseInt(bad) + parseInt(data[2].survey_count) + parseInt(good) + parseInt(great);
                });
            }
        },
        computed: {
            sum: function (){
                //return parseInt(this.terrible) + parseInt(this.bad) + parseInt(this.okay) + parseInt(this.good) + parseInt(this.great);
                return parseInt(this.terrible) + parseInt(this.okay) + parseInt(this.bad) + (this.good ? parseInt(this.good) : 0) + (this.great ? parseInt(this.great) : 0);
            },
            terribleP: function(){
                this.terrible = this.terrible ? parseInt(this.terrible) : 0;
                return (Math.round((parseInt(this.terrible) / this.sum)* 100)/1 + '%');
            },
            okayP: function () {
                this.okay = this.okay ? parseInt(this.okay) : 0;
                return (Math.round((parseInt(this.okay) / this.sum) * 100) / 1 + '%');
            },
            greatP: function () {
                this.great = this.great ? parseInt(this.great) : 0;
                return (Math.round((parseInt(this.great) / this.sum) * 100) / 1 + '%');
            },
            badP: function () {
                this.bad = this.bad ? parseInt(this.bad) : 0;
                return (Math.round((parseInt(this.bad) / this.sum) * 100) / 1 + '%');
            },
            goodP: function () {
                this.good = this.good ? parseInt(this.good) : 0;
                return (Math.round((parseInt(this.good) / this.sum) * 100) / 1 + '%');
            }
        }
    }
</script>
