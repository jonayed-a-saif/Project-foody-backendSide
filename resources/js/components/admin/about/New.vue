<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-10">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Text</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input @change="changeLogo($event)" type="file" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="image" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                        <has-error :form="form" field="image"></has-error>
                                        <img :src="form.image" class="img-fluid mt-1">
                                    </div>

                                    <div class="form-group">
                                        <label for="details">Details</label>
                                        <vue-editor v-model="form.details" id="details" placeholder="Description" name="details" :class="{ 'is-invalid': form.errors.has('details') }"></vue-editor>
                                        <has-error :form="form" field="details"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="tag_line">Tag Line</label>
                                        <input type="text" class="form-control" id="tag_line" placeholder="Enter Tag Line" v-model="form.tag_line" name="tag_line" :class="{ 'is-invalid': form.errors.has('tag_line') }">
                                        <has-error :form="form" field="tag_line"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" placeholder="Enter Location" v-model="form.location" name="location" :class="{ 'is-invalid': form.errors.has('location') }">
                                        <has-error :form="form" field="location"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="contact">Contact</label>
                                        <input type="text" class="form-control" id="contact" placeholder="Enter contact" v-model="form.contact" name="contact" :class="{ 'is-invalid': form.errors.has('contact') }">
                                        <has-error :form="form" field="contact"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addAbout()">Submit</button>
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
                details: '',
                tag_line: '',
                location: '',
                contact: ''
            })
        }
    },
    methods: {
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
        addAbout () {
            this.form.post('/add/new/about')
            .then(({ response }) => {
                this.$router.push('/about-list');

                toast.fire({
                    icon: 'success',
                    title: 'About Added successfully'
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
