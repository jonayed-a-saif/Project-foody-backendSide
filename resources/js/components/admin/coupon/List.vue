<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Coupon List</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-coupon" class="text-white">Add New Coupon</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Code</th>
                                            <th>Percenatge</th>
                                            <th>Amount</th>
                                            <th>Minimum Amount</th>
                                            <th>Expiration</th>
                                            <th>Used</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="allCoupons.length != 0">
                                        <tr v-for="(coupon,index) in allCoupons" :key="coupon.id">
                                            <td>{{index+1}}</td>
                                            <td>{{coupon.code}}</td>
                                            <td class="text-center"><span v-if="coupon.percentage != null">{{coupon.percentage}}%</span></td>
                                            <td><span v-if="coupon.amount != null">{{coupon.amount}} Taka</span></td>
                                            <td>{{coupon.min_qty}} Taka</td>
                                            <td>{{coupon.start_date | timeformat2}} to {{coupon.end_date | timeformat2}}</td>
                                            <td>{{coupon.used}}</td>
                                            <td>
                                                <router-link :to="`/edit-coupon/${coupon.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="" @click.prevent="deleteCoupon(coupon.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="8" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
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
        this.$store.dispatch('allCoupons')
    },
    computed: {
        allCoupons(){
            return this.$store.getters.getAllCoupon
        }
    },
    methods:{
        deleteCoupon(id){
            axios.get('/delete/coupon/'+id)
                .then(()=>{
                    this.$store.dispatch('allCoupons')
                    toast.fire({
                        icon: 'success',
                        title: 'Coupon Deleted successfully'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        }
    }
}
</script>

<style scoped>

</style>
