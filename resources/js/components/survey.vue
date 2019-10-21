<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-weight-bold">Customer Service Survey</h4>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">Month: <span class="small text-danger">[for current year]</span></h4>
                                <select class="form-control mb-3" @change="onChange($event)" id="exampleFormControlSelect2">
                                    <option v-for="(value, name) in months" :value="value">
                                        {{name}}
                                    </option>
                                </select>
                            </div>
                            <div class="col">
                                <h4 class="card-title">Satisfaction Level: <span class="small text-danger">[for current month & year]</span></h4> 
                                <form class="mt-2">
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="radio1">
                                            <input type="radio" class="form-check-input" name="level" @click="check($event)" :value="4">Great
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="radio2">
                                            <input type="radio" class="form-check-input" name="level" @click="check($event)" :value="3">Good
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="level" @click="check($event)" value="2">Okay
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="level" @click="check($event)" :value="1">Bad
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="level" @click="check($event)" :value="0">Terrible
                                        </label>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <table class="table table-bordered text-center">
                            <thead class="table-success">
                                
                                <td>Level</td>
                                <td>Comments</td>
                               
                            </thead>
                            <tr v-for="survey in surveys.data" :key="survey.id">
                                
                                <td v-text="getSat(survey.satisfaction)"></td>
                                <td v-text="survey.comment"></td>
                                
                            </tr>
                        </table>
                        <div class="mt-2">
                            <pagination :data="surveys" @pagination-change-page="me">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
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
                surveys: [],
                survey: '',
                id: '',
                b:'',
                me: '',
                month: '',
                months: {
                    January: 1,
                    February: 2,
                    March: 3,
                    April: 4,
                    May: 5,
                    June: 6,
                    July: 7,
                    August: 8,
                    September: 9,
                    October: 10,
                    November: 11,
                    December: 12
                }

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            onChange: function(e) {
            
                this.id = event.target.value;
                this.getMonth();
                this.me = this.getMonth;
            },
            check(e) {
                this.me = this.getLevel;
                if (e.target.checked) {
                    this.id = event.target.value;
                    //alert(this.id)
                    this.getLevel();
                    
                }
            },
            getMonth(page = 1) {
                //alert(id)
                this.surveys = [];
                axios.get('/month/' + this.id +'?page='+page)
                    .then(({ data }) => this.surveys = data);
            },
            getLevel(page = 1) {
                //alert(id)
                this.surveys = [];
                axios.get('/level/' + this.id + '?page=' + page)
                    .then(({ data }) => this.surveys = data);
            },
            getSat(a)
            {
                return this.b = (a == 0 ? 'Terrible' : a == 1 ? 'Bad' : a == 2 ? 'Okay' : a == 3 ? 'Good' : 'Great' );
            }
        }
    }
</script>