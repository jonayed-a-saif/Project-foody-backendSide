<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> Customers </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Customers</h3>
                                <div class="card-tools">
                                    <!-- <button class="btn btn-primary">
                                        <router-link to="/add-customer" class="text-white">Add New Customer</router-link>
                                    </button> -->
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Registered At</th>
                                            <th>Last Login</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllCustomers.length != 0">
                                        <tr v-for="(customer,index) in getAllCustomers" :key="customer.id">
                                            <td>{{index+1}}</td>
                                            <td>{{customer.name}}</td>
                                            <td>{{customer.email}}</td>
                                            <td>{{customer.contact}}</td>
                                            <td>{{customer.created_at | timeformat}}</td>
                                            <td>{{customer.updated_at | timeformat}}</td>
                                            <td>
                                                <!-- <router-link :to="`/edit-customer/${customer.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link> -->
                                                <a href="#" @click.prevent = "deleteCustomer(customer.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
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
        data() {
            return {
            current_page: '',
            last_page: '',
            pageNumber:1,
            url:"/get/customer/list/for/backend?page="+this.pageNumber,
            someStyle: {
                    fontSize: '10px',
                },
            };
        },
        mounted(){
            this.$store.dispatch('allCustomerList',this.url),
            axios.get(this.url)
            .then((response) => {
                this.current_page=response.data.customers.current_page
                this.last_page=response.data.customers.last_page
            })
        },
        computed:{
            getAllCustomers(){
                return this.$store.getters.getCustomerForBackend
            }
        },
        methods:{
            deleteCustomer(id){
                axios.get('/delete/customer/'+id)
                    .then(()=>{
                        this.$store.dispatch("allCustomerList",this.url)
                        toast.fire({
                            icon: 'success',
                            title: 'Customer has been Deleted successfully'
                        })
                    })
                    .catch(()=>{
                        toast.fire({
                            icon: 'error',
                            text: 'Some Orders are related to that User',
                        })
                    })
            },
            nextPage(){
                if(this.pageNumber < this.last_page){
                    this.pageNumber = this.pageNumber+1
                }
                this.url = "/get/customer/list/for/backend?page="+this.pageNumber,
                this.$store.dispatch("allCustomerList",this.url)
            },
            prevPage(){
                if(this.pageNumber > 1){
                    this.pageNumber = this.pageNumber-1
                }
                this.url = "/get/customer/list/for/backend?page="+this.pageNumber,
                this.$store.dispatch("allCustomerList",this.url)
            },
        }
    }
</script>

<style lang="sass" scoped>

</style>
