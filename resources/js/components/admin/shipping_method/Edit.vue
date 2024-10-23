<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Shipping Method </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Shipping Method</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="Enter Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="duration">Duration</label>
                                        <input type="text" class="form-control" id="duration" placeholder="5-7 Days" v-model="form.duration" name="duration" :class="{ 'is-invalid': form.errors.has('duration') }">
                                        <has-error :form="form" field="duration"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price (in Tk.)</label>
                                        <input type="text" class="form-control" id="price" placeholder="Enter Price" v-model="form.price" name="price" :class="{ 'is-invalid': form.errors.has('price') }">
                                        <has-error :form="form" field="price"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updateShippingMethod()">Update</button>
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
            someStyle: {
                fontSize: '10px',
            },
            form: new Form({
                title: '',
                duration: '',
                price: ''
            })
        }
    },
    created(){
        axios.get(`/edit/shipping/method/${this.$route.params.shippingMethodId}`)
            .then((response)=>{
                this.form.fill(response.data.shipping_method)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        updateShippingMethod(){
            this.form.post('/update/shipping/method/'+this.$route.params.shippingMethodId)
                .then(()=>{
                    this.$router.push('/shippingMethod-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Shipping Method Updated successfully'
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
