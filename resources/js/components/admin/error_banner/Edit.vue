<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Error Banner </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Error Banner</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="image">Error Banner</label>
                                        <input @change="changeLogo($event)" type="file" accept=".gif, .png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="image" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                        <has-error :form="form" field="image"></has-error>
                                        <img :src="uploadLoader()" class="img-fluid mt-1">
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updateErrorBanner()">Update</button>
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
                image: ''
            })
        }
    },
    created(){
        axios.get(`/edit/error/banner/${this.$route.params.errorId}`)
            .then((response)=>{
                this.form.fill(response.data.error_banner)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        changeLogo(event){
            let file = event.target.files[0];
            if(file.size>1048576){
                swal.fire({
                    icon: 'error',
                    title: 'Oppss...',
                    text: 'Image Size is Greater than 1MB',
                })
            }
            else{
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.image = event.target.result
                };
                reader.readAsDataURL(file);
            }
        },
        uploadLoader(){
            let img = this.form.image;
            if(img.length>50){
                return this.form.image
            }
            else{
                return `/error_banner/${this.form.image}`
            }
        },
        updateErrorBanner(){
            this.form.post('/update/error/banner/'+this.$route.params.errorId)
                .then(()=>{
                    this.$router.push('/error-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Error Banner Updated successfully'
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
