<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Logo/Icon</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="icon">Icon (12*12)</label>
                                        <input @change="changePhoto($event)" type="file" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="icon" name="icon" :class="{ 'is-invalid': form.errors.has('icon') }">
                                        <has-error :form="form" field="icon"></has-error>
                                        <img :src="uploadIcon()" class="img-fluid mt-1" height="40" width="40">
                                    </div>

                                    <div class="form-group">
                                        <label for="icon">Logo</label>
                                        <input @change="changeLogo($event)" type="file" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="logo" name="logo" :class="{ 'is-invalid': form.errors.has('logo') }">
                                        <has-error :form="form" field="logo"></has-error>
                                        <img :src="uploadLogo()" class="img-fluid mt-1">
                                    </div>

                                    <div class="form-group">
                                        <label for="link">Title</label>
                                        <input type="text" class="form-control" id="link" placeholder="Enter Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updateLogoData()">Update</button>
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
                icon: '',
                logo: '',
                title: ''
            })
        }
    },
    created(){
        axios.get(`/edit/logo/details/${this.$route.params.logoId}`)
            .then((response)=>{
                this.form.fill(response.data.logo)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        changePhoto(event){
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
                    this.form.icon = event.target.result
                };
                reader.readAsDataURL(file);
            }
        },
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
                    this.form.logo = event.target.result
                };
                reader.readAsDataURL(file);
            }
        },
        uploadIcon(){
            let img = this.form.icon;
            if(img.length>50){
                return this.form.icon
            }
            else{
                return `/logo_images/${this.form.icon}`
            }
        },
        uploadLogo(){
            let img = this.form.logo;
            if(img.length>50){
                return this.form.logo
            }
            else{
                return `/logo_images/${this.form.logo}`
            }
        },
        updateLogoData(){
            this.form.post('/update/logo/'+this.$route.params.logoId)
                .then(()=>{
                    this.$router.push('/logo-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Logo Updated successfully'
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
