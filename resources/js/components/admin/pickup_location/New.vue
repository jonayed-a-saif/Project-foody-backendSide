<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Pickup Location </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Location</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Location</label>
                                        <input type="text" class="form-control" id="title" placeholder="Enter Location" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addPackaging()">Submit</button>
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
            someStyle: {
                fontSize: '10px',
            },
            form: new Form({
                title: ''
            })
        }
    },
    methods: {
        addPackaging () {
            this.form.post('/add/new/location')
            .then(({ response }) => {
                this.$router.push('/pickup-list');

                toast.fire({
                    icon: 'success',
                    title: 'Pickup Location Added successfully'
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
