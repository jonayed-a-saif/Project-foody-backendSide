<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Slider</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="categoryImage">Slider Image (1920*510)</label>
                                        <input @change="changePhoto($event)" type="file" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="categoryImage" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                        <has-error :form="form" field="image"></has-error>
                                        <img :src="form.image" class="img-fluid mt-1">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="sliderysubID">Slider Sub-Title</label>
                                                <input type="text" class="form-control" id="sliderysubID" placeholder="Enter Subtitle" v-model="form.subtitle" name="subtitle" :class="{ 'is-invalid': form.errors.has('subtitle') }">
                                                <has-error :form="form" field="subtitle"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="subtitle_color">Color</label>
                                                <input type="color" class="form-control" id="subtitle_color" v-model="form.subtitle_color" name="subtitle_color" :class="{ 'is-invalid': form.errors.has('subtitle_color') }">
                                                <has-error :form="form" field="subtitle_color"></has-error>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="slideryID">Slider Title</label>
                                                <input type="text" class="form-control" id="slideryID" placeholder="Enter Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                                <has-error :form="form" field="title"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="title_color">Color</label>
                                                <input type="color" class="form-control" id="title_color" v-model="form.title_color" name="title_color" :class="{ 'is-invalid': form.errors.has('title_color') }">
                                                <has-error :form="form" field="title_color"></has-error>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="slideryTextID">Slider Text</label>
                                                <input type="text" class="form-control" id="slideryTextID" placeholder="Enter Text" v-model="form.text" name="text" :class="{ 'is-invalid': form.errors.has('text') }">
                                                <has-error :form="form" field="text"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="text_color">Color</label>
                                                <input type="color" class="form-control" id="text_color" v-model="form.text_color" name="text_color" :class="{ 'is-invalid': form.errors.has('text_color') }">
                                                <has-error :form="form" field="text_color"></has-error>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="link">Slider Link</label>
                                        <input type="text" class="form-control" id="link" placeholder="Enter Link" v-model="form.link" name="link" :class="{ 'is-invalid': form.errors.has('link') }">
                                        <has-error :form="form" field="link"></has-error>
                                    </div>


                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addSlider()">Submit</button>
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
            form: new Form({
                image: '',
                subtitle: '',
                subtitle_color: '',
                title: '',
                title_color: '',
                text: '',
                text_color: '',
                link: ''
            })
        }
    },
    methods: {
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
                    this.form.image = event.target.result
                };
                reader.readAsDataURL(file);
            }
        },
        addSlider () {
            this.form.post('/add/new/slider')
            .then(({ response }) => {
                this.$router.push('/slider-list');

                toast.fire({
                    icon: 'success',
                    title: 'Slider Added successfully'
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
