<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Sent SMS List</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/send-sms" class="text-white">Send SMS</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>SMS</th>
                                            <th> Mobile </th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllSms.length != 0">
                                        <tr v-for="(sms,index) in getAllSms" :key="sms.id">
                                            <td>{{index+1}}</td>
                                            <td>{{sms.message}}</td>
                                            <td>{{sms.recipients}}</td>
                                            
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="6" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="pagination">
                                    <button class="btn btn-sm btn-primary" @click.prevent="prevPage()">
                                        Previous
                                    </button>
                                    <span class="ml-2 mr-2">Page {{this.pageNumber}} of {{this.last_page}}</span>
                                    <button class="btn btn-sm btn-primary" @click.prevent="nextPage()">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</div>
</template>

<script>
    export default {
        name:"List",
        data(){
            return{
                current_page: '',
                last_page: '',
                pageNumber:1,
                url:"/get/sms/backend?page="+this.pageNumber,
            }
        },
        mounted(){
            this.$store.dispatch("allSms",this.url),
            axios.get(this.url)
                .then((response) => {
                    this.current_page=response.data.messages.current_page
                    this.last_page=response.data.messages.last_page
                })
        },
        computed:{
            getAllSms(){
                return this.$store.getters.getSms
            }
        },
        methods:{
           
            nextPage(){
                if(this.pageNumber < this.last_page){
                    this.pageNumber = this.pageNumber+1
                }
                this.url = "/get/sms/backend?page="+this.pageNumber,
                this.$store.dispatch("allsms",this.url)
            },
            prevPage(){
                if(this.pageNumber > 1){
                    this.pageNumber = this.pageNumber-1
                }
                this.url = "/get/sms/backend?page="+this.pageNumber,
                this.$store.dispatch("allsms",this.url)
            },
        }
    }
</script>

<style lang="sass" scoped>

</style>
