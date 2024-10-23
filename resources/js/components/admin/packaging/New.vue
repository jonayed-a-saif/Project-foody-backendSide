<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Packaging </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Packaging</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="Enter Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="subtitle">Subtitle</label>
                                        <input type="text" class="form-control" id="subtitle" placeholder="Enter Subtitle" v-model="form.subtitle" name="subtitle" :class="{ 'is-invalid': form.errors.has('subtitle') }">
                                        <has-error :form="form" field="subtitle"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price (in Tk.)</label>
                                        <input type="text" class="form-control" id="price" placeholder="Enter Price" v-model="form.price" name="price" :class="{ 'is-invalid': form.errors.has('price') }">
                                        <has-error :form="form" field="price"></has-error>
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
                title: '',
                subtitle: '',
                price: ''
            })
        }
    },
    methods: {
        addPackaging () {
            this.form.post('/add/new/packaging')
            .then(({ response }) => {
                this.$router.push('/packaging-list');

                toast.fire({
                    icon: 'success',
                    title: 'Packaging Added successfully'
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
