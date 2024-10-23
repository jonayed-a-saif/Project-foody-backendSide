<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Payment List</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-payment" class="text-white">Add New Payment</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Subtitle</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="allPayments.length != 0">
                                        <tr v-for="(payment,index) in allPayments" :key="payment.id">
                                            <td>{{index+1}}</td>
                                            <td>{{payment.title}}</td>
                                            <td><span v-if="payment.subtitle != null">{{payment.subtitle}}</span></td>
                                            <td>{{payment.details}}</td>
                                            <td v-if="payment.status==1"><span class="btn btn-success btn-sm rounded" @click.prevent="statusChange(payment.id)">Active</span></td>
                                            <td v-else><span class="btn btn-danger btn-sm rounded" @click.prevent="statusChange(payment.id)">Deactivate</span></td>
                                            <td>{{payment.created_at | timeformat2}}</td>
                                            <td>
                                                <router-link :to="`/edit-payment/${payment.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="" @click.prevent="deletePayment(payment.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="7" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
                                        </tr>
                                    </tbody>
                                </table>
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
    name: 'List',
    mounted(){
        this.$store.dispatch('allPayments')
    },
    computed: {
        allPayments(){
            return this.$store.getters.getAllPayment
        }
    },
    methods:{
        deletePayment(id){
            axios.get('/delete/payment/'+id)
                .then(()=>{
                    this.$store.dispatch('allPayments')
                    toast.fire({
                        icon: 'success',
                        title: 'Payment Deleted successfully'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        },
        statusChange(id){
            axios.get('/payment/status/change/'+id)
                .then(()=>{
                    this.$store.dispatch('allPayments')
                    toast.fire({
                        icon: 'success',
                        title: 'Payment Status Changed successfully'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        },
    }
}
</script>

<style scoped>

</style>
