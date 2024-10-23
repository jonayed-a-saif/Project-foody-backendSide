<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Website Color </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Website Color</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="theme_color">Theme Color</label>
                                        <input type="color" class="form-control" id="theme_color" v-model="form.theme_color" name="theme_color" :class="{ 'is-invalid': form.errors.has('theme_color') }">
                                        <has-error :form="form" field="theme_color"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="menu_color">Menu Color</label>
                                        <input type="color" class="form-control" id="menu_color" v-model="form.menu_color" name="menu_color" :class="{ 'is-invalid': form.errors.has('menu_color') }">
                                        <has-error :form="form" field="menu_color"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="footer_color">Footer Color</label>
                                        <input type="color" class="form-control" id="footer_color" v-model="form.footer_color" name="footer_color" :class="{ 'is-invalid': form.errors.has('footer_color') }">
                                        <has-error :form="form" field="footer_color"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="copyright_color">Copyright Color</label>
                                        <input type="color" class="form-control" id="copyright_color" v-model="form.copyright_color" name="copyright_color" :class="{ 'is-invalid': form.errors.has('copyright_color') }">
                                        <has-error :form="form" field="copyright_color"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updateWebsiteColor()">Update</button>
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
                theme_color: '',
                menu_color: '',
                footer_color: '',
                copyright_color: ''
            })
        }
    },
    created(){
        axios.get(`/edit/website/color/details/${this.$route.params.websiteColorId}`)
            .then((response)=>{
                this.form.fill(response.data.website_color)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        updateWebsiteColor(){
            this.form.post('/update/website/color/'+this.$route.params.websiteColorId)
                .then(()=>{
                    this.$router.push('/websiteColor-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Website Color Updated successfully'
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
