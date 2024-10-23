<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Packaging </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Packaging</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="codeID">Title</label>
                                        <input type="text" class="form-control" id="codeID" placeholder="Enter Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
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
                                    <button type="submit" class="btn btn-primary" @click.prevent="updatePackaging()">Update</button>
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
                subtitle: '',
                price: ''
            })
        }
    },
    created(){
        axios.get(`/edit/packaging/details/${this.$route.params.packagingId}`)
            .then((response)=>{
                this.form.fill(response.data.packaging)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        updatePackaging(){
            this.form.post('/update/packaging/'+this.$route.params.packagingId)
                .then(()=>{
                    this.$router.push('/packaging-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Packaging Updated successfully'
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
