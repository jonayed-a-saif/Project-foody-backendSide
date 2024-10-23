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
                                        <label for="codeID">Title</label>
                                        <input type="text" class="form-control" id="codeID" placeholder="Enter Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="qtyID">Subtitle (optional) :</label>
                                        <input type="text" class="form-control" id="qtyID" placeholder="Subtitle" v-model="form.subtitle" name="subtitle" :class="{ 'is-invalid': form.errors.has('subtitle') }">
                                        <has-error :form="form" field="subtitle"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="DescriptionID">Payment Details</label>
                                        <vue-editor v-model="form.details" id="DescriptionID" placeholder="Details" name="details" :class="{ 'is-invalid': form.errors.has('details') }"></vue-editor>
                                        <has-error :form="form" field="details"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updatePayment()">Update</button>
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
                title: '',
                subtitle: '',
                details: '',
            })
        }
    },
    created(){
        axios.get(`/edit/payment/details/${this.$route.params.paymentId}`)
            .then((response)=>{
                this.form.fill(response.data.payment)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        updatePayment(){
            this.form.post('/update/payment/'+this.$route.params.paymentId)
                .then(()=>{
                    this.$router.push('/payment-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Payment Updated successfully'
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
