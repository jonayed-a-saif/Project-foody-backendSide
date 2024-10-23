<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Coupon</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="codeID">Coupon Code</label>
                                        <input type="text" class="form-control" id="codeID" placeholder="Enter Coupon Code" v-model="form.code" name="code" :class="{ 'is-invalid': form.errors.has('code') }">
                                        <has-error :form="form" field="code"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="typeID">Select Type</label>
                                        <select class="form-control" id="typeID" v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }">
                                            <option disabled value="">Select One</option>
                                            <option value="percentage" @click.prevent="show(1)">Dicsount By Percentage</option>
                                            <option value="amount" @click.prevent="show(2)">Dicsount By Amount</option>
                                        </select>
                                        <has-error :form="form" field="type"></has-error>
                                    </div>

                                    <div class="form-group percentage" style="display:block">
                                        <label for="percentageID">Percentage (%) :</label>
                                        <input type="number" class="form-control" id="percentageID" placeholder="%" v-model="form.percentage" name="percentage" :class="{ 'is-invalid': form.errors.has('percentage') }">
                                        <has-error :form="form" field="percentage"></has-error>
                                    </div>

                                    <div class="form-group amount" style="display:block">
                                        <label for="amountID">Amount (৳) :</label>
                                        <input type="number" class="form-control" id="amountID" placeholder="Taka" v-model="form.amount" name="amount" :class="{ 'is-invalid': form.errors.has('amount') }">
                                        <has-error :form="form" field="amount"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="qtyID">Minmum Quantity :</label>
                                        <input type="number" class="form-control" id="qtyID" placeholder="Taka" v-model="form.min_qty" name="min_qty" :class="{ 'is-invalid': form.errors.has('min_qty') }">
                                        <has-error :form="form" field="min_qty"></has-error>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="start_dateID">Start Date :</label>
                                                <input type="date" class="form-control" id="start_dateID" v-model="form.start_date" name="start_date" :class="{ 'is-invalid': form.errors.has('start_date') }">
                                                <has-error :form="form" field="start_date"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="end_dateID">End Date :</label>
                                                <input type="date" class="form-control" id="end_dateID" v-model="form.end_date" name="end_date" :class="{ 'is-invalid': form.errors.has('end_date') }">
                                                <has-error :form="form" field="end_date"></has-error>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updateCoupon()">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: 'Edit',
    data(){
        return{
            form: new Form({
                code: '',
                type: '',
                percentage: '',
                amount: '',
                min_qty: '',
                start_date: '',
                end_date: ''
            })
        }
    },
    created(){
        axios.get(`/edit/coupon/details/${this.$route.params.couponId}`)
            .then((response)=>{
                this.form.fill(response.data.coupon)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        show(value){
            if(value == 1){
                document.querySelector(".amount").style.display = "none";
                document.querySelector(".percentage").style.display = "block";
            }
            if(value == 2){
                document.querySelector(".amount").style.display = "block";
                document.querySelector(".percentage").style.display = "none";
            }
        },
        updateCoupon(){
            this.form.post('/update/coupon/'+this.$route.params.couponId)
                .then(()=>{
                    this.$router.push('/coupon-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Coupon Updated successfully'
                    })
                })
                .catch(()=>{

                })
        }
    }
}
</script>

<style scoped>

</style>
