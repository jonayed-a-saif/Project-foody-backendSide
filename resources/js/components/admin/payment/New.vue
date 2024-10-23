<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Payment</h3>
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
                                    <button type="submit" class="btn btn-primary" @click.prevent="addCoupon()">Submit</button>
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
    name : "New",
    data () {
        return {
            form: new Form({
                title: '',
                subtitle: '',
                details: '',
            })
        }
    },
    methods: {
        addCoupon () {
            this.form.post('/add/new/payment')
            .then(({ response }) => {
                this.$router.push('/payment-list');

                toast.fire({
                    icon: 'success',
                    title: 'Payment Added successfully'
                })

            })
            .catch(()=>{
                console.log('Error cateched')
            })
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
