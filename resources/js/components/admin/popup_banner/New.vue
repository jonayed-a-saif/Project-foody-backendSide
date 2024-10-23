<template>
    <div>
        <section class="content">
            <div class="container-fluid">

                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Popup Banner </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Popup Banner</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="image">Popup Banner</label>
                                        <input @change="changeLoader($event)" type="file" accept=".gif, .png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="image" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                        <has-error :form="form" field="image"></has-error>
                                        <img :src="form.image" class="img-fluid mt-1">
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
                                    <button type="submit" class="btn btn-primary" @click.prevent="addPopupBanner()">Submit</button>
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
                image: '',
                title: '',
                text: ''
            })
        }
    },
    methods: {
        changeLoader(event){
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
        addPopupBanner () {
            this.form.post('/add/new/popup/banner')
            .then(({ response }) => {
                this.$router.push('/popup-list');

                toast.fire({
                    icon: 'success',
                    title: 'Popup Banner Added successfully'
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
