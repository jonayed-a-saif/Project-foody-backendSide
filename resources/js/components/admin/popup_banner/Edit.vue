<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Popup Banner </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Popup Banner</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="image">Popup Banner</label>
                                        <input @change="changeLogo($event)" type="file" accept=".gif, .png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="image" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                        <has-error :form="form" field="image"></has-error>
                                        <img :src="uploadLoader()" class="img-fluid mt-1">
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Popup Banner Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="text">Popup Banner Text</label>
                                        <vue-editor v-model="form.text" id="text" placeholder="Text" name="text" :class="{ 'is-invalid': form.errors.has('text') }"></vue-editor>
                                        <has-error :form="form" field="text"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updatePopupBanner()">Update</button>
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
                image: '',
                title: '',
                text: ''
            })
        }
    },
    created(){
        axios.get(`/edit/popup/banner/details/${this.$route.params.popupId}`)
            .then((response)=>{
                this.form.fill(response.data.popup_banner)
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
                return `/popup_banners/${this.form.image}`
            }
        },
        updatePopupBanner(){
            this.form.post('/update/popup/banner/'+this.$route.params.popupId)
                .then(()=>{
                    this.$router.push('/popup-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Popup Banner Updated successfully'
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
