<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Poster</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="categoryImage">Poster Image (1200*200)</label>
                                        <input @change="changePhoto($event)" type="file" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="categoryImage" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                        <has-error :form="form" field="image"></has-error>
                                        <img :src="form.image" class="img-fluid mt-1">
                                    </div>

                                    <div class="form-group">
                                        <label for="typeID">Select Position</label>
                                        <select class="form-control" id="typeID" v-model="form.position" :class="{ 'is-invalid': form.errors.has('position') }">
                                            <option disabled value="">Select One</option>
                                            <option value="top">Top</option>
                                            <option value="bottom">Bottom</option>
                                        </select>
                                        <has-error :form="form" field="type"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="link">Poster Link</label>
                                        <input type="text" class="form-control" id="link" placeholder="Enter Link" v-model="form.link" name="link" :class="{ 'is-invalid': form.errors.has('link') }">
                                        <has-error :form="form" field="link"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addPoster()">Submit</button>
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
                position: '',
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
        addPoster () {
            this.form.post('/add/new/poster')
            .then(({ response }) => {
                this.$router.push('/poster-list');

                toast.fire({
                    icon: 'success',
                    title: 'Poster Added successfully'
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
