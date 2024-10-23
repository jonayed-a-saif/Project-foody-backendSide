<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Footer </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Footer</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="footer_text">Footer Text</label>
                                        <vue-editor v-model="form.footer_text" id="footer_text" placeholder="Footer Text" name="footer_text" :class="{ 'is-invalid': form.errors.has('footer_text') }"></vue-editor>
                                        <has-error :form="form" field="footer_text"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="copyright_text">Copyright Text</label>
                                        <vue-editor v-model="form.copyright_text" id="copyright_text" placeholder="Copyright Text" name="copyright_text" :class="{ 'is-invalid': form.errors.has('copyright_text') }"></vue-editor>
                                        <has-error :form="form" field="copyright_text"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updateFooter()">Update</button>
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
                footer_text: '',
                copyright_text: ''
            })
        }
    },
    created(){
        axios.get(`/edit/footer/details/${this.$route.params.footerId}`)
            .then((response)=>{
                this.form.fill(response.data.footer)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        updateFooter(){
            this.form.post('/update/footer/'+this.$route.params.footerId)
                .then(()=>{
                    this.$router.push('/footer-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Footer Updated successfully'
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
