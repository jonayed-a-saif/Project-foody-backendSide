<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Category</h3>
                            </div>
                            <form role="form" @submit.prevent="updateCategory()">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="productImage">Category Image (120*120)</label>
                                        <input @change="changePhoto($event)" type="file" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="productImage" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                        <has-error :form="form" field="image"></has-error>
                                        <img :src="uploadImage()" class="img-fluid mt-1">
                                    </div>
                                    <div class="form-group">
                                        <label for="CategoryID">Category Rename</label>
                                        <input type="text" class="form-control" id="CategoryID" placeholder="Enter New Name" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
    name : "Edit",
    mounted(){
        axios.get(`/edit/category/${this.$route.params.categoryId}`)
            .then((response)=>{
                this.form.fill(response.data.category)
            })
            .catch(()=>{
                console.log('error')
            })
    },
    data () {
        return {
            form: new Form({
                name: '',
                image: ''
            })
        }
    },
    methods: {
        updateCategory () {
            this.form.post(`/update/category/name/${this.$route.params.categoryId}`)
            .then(({ response }) => {
                this.$router.push('/category-list');
                toast.fire({
                    icon: 'success',
                    title: 'Category Name Updated'
                })

            })
            .catch(()=>{
                console.log('Error cateched')
            })
        },
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
        uploadImage(){
            let img = this.form.image;
            if(img.length>50){
                return this.form.image
            }
            else{
                return `/category_images/${this.form.image}`
            }
        },
    }
}
</script>

<style lang="sass" scoped>

</style>
