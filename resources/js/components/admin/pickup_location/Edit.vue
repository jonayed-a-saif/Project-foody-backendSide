<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Pickup Location </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Location</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="codeID">Title</label>
                                        <input type="text" class="form-control" id="codeID" placeholder="Enter Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updateLocation()">Update</button>
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
                title: ''
            })
        }
    },
    created(){
        axios.get(`/edit/location/details/${this.$route.params.pickupId}`)
            .then((response)=>{
                this.form.fill(response.data.pickup_location)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        updateLocation(){
            this.form.post('/update/location/'+this.$route.params.pickupId)
                .then(()=>{
                    this.$router.push('/pickup-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Pickup Location Updated successfully'
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
