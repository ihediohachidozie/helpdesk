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
                        <div class="card-body">
                            <p>This measures the quality or support team's efforts. Below shows status for months in the current year.
                            </p>
                            <select class="form-control mb-2" @change="onChange($event)" id="exampleFormControlSelect2">
                                <option v-for="(value, name) in months" :value="value">
                                    {{name}}
                                </option>
                            </select>
                                <table class="table table-striped text-center">
                                <thead class="table-success">
                                    <td>Satisfaction</td>
                                    <td>Progress</td>
                                    <td>Percentage</td>
                                </thead>
                                <tr>
                                    <td>Great</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" :style="{width: greatP}"></div>
                                        </div>
                                    </td>
                                    <td>{{greatP}}</td>
                                </tr>
                                <tr>
                                    <td>Good</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" :style="{width: goodP}"></div>
                                        </div>
                                    </td>
                                    <td>{{goodP}}</td>
                                </tr>
                                <tr>
                                    <td>Okay</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" :style="{width: okayP}"></div>
                                        </div>
                                    </td>
                                    <td>{{okayP}}</td>
                                </tr>
                                <tr>
                                    <td>Bad</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" :style="{width: badP}"></div>
                                        </div>
                                    </td>
                                    <td>{{badP}}</td>
                                </tr>
                                <tr>
                                    <td>Terrible</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" :style="{width: terribleP}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{terribleP}}</td>
                                </tr>
                            </table>
      
                            
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
                month: '',
                months: {
                    January : 1,
                    February : 2,
                    March : 3,
                    April : 4,
                    May : 5,
                    June : 6,
                    July : 7,
                    August : 8,
                    September : 9,
                    October : 10,
                    November : 11,
                    December : 12
                }
        
            }
        },
        mounted() {
            this.fetch(),
            this.getStatus(),
            this.getAgents(),
            this.onChange(),
            console.log('Component mounted.')
        },
        methods:{
            fetch(page = 1) {
                // get tickets..
                axios.get('/ticket?page=' + page)
                    .then(({ data }) => this.tickets = data);
            },
            onChange: function (event) {
                this.id = event.target.value;
                this.clearall();
                this.getSurvey();
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
            },
            clearall(){
                this.terrible = this.bad = this.okay = this.good = this.great = '';
            }
        },
        computed: {
            sum: function (){
                return parseInt(this.terrible ? parseInt(this.terrible) : 0) + parseInt(this.okay ? parseInt(this.okay) : 0) + parseInt(this.bad ? parseInt(this.bad) : 0) + (this.good ? parseInt(this.good) : 0) + (this.great ? parseInt(this.great) : 0);
            },
            terribleP: function(){
                if(this.terrible){
                    this.terrible = this.terrible ? parseInt(this.terrible) : 0;
                    return (Math.round((parseInt(this.terrible) / this.sum) * 100) / 1 + '%');
                } else {
                    return 0 + '%';
                }

            },
            okayP: function () {
                if(this.okay){
                    this.okay = this.okay ? parseInt(this.okay) : 0;
                    return (Math.round((parseInt(this.okay) / this.sum) * 100) / 1 + '%');                    
                }else{
                    return 0 + '%';
                }

            },
            greatP: function () {
                if(this.great){
                    this.great = this.great ? parseInt(this.great) : 0;
                    return (Math.round((parseInt(this.great) / this.sum) * 100) / 1 + '%');
                }else{
                    return 0 + '%';
                }

            },
            badP: function () {
                if(this.bad){
                    this.bad = this.bad ? parseInt(this.bad) : 0;
                    return (Math.round((parseInt(this.bad) / this.sum) * 100) / 1 + '%');
                } else{
                    return 0 + '%';
                }

            },
            goodP: function () {
                if(this.good){
                    this.good = this.good ? parseInt(this.good) : 0;
                    return (Math.round((parseInt(this.good) / this.sum) * 100) / 1 + '%');
                } else{
                    return 0 + '%';
                }


            }
        }
    }
</script>
