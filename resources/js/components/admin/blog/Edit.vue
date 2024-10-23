<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-10">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-boxes"></i> Edit Blog</h3>
                            </div>
                            <form role="form" enctype="multipart/form-data" @submit.prevent="updateBlog()">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="productImage">Blog Image (1200*700)</label>
                                                <input @change="changePhoto($event)" type="file" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="productImage" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                                <has-error :form="form" field="image"></has-error>
                                                <img :src="uploadImage()" class="img-fluid mt-1">
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="categoryID">Select Category</label>
                                                <select class="form-control" id="categoryID" v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category_id') }">
                                                    <option disabled value="">Select One</option>
                                                    <option v-for="category in allBlogCategories" :value="category.id" :key="category.id">{{category.name}}</option>
                                                </select>
                                                <has-error :form="form" field="category_id"></has-error>
                                            </div>

                                            <div class="form-group">
                                                <label for="titleID">Blog Title</label>
                                                <input type="text" class="form-control" id="titleID" placeholder="Enter Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                                <has-error :form="form" field="title"></has-error>
                                            </div>

                                            <div class="form-group">
                                                <label for="tagsID">Tags (optional)</label>
                                                <input type="text" class="form-control" id="tagsID" placeholder="Enter Tags" v-model="form.tags" name="tags" :class="{ 'is-invalid': form.errors.has('tags') }">
                                                <has-error :form="form" field="tags"></has-error>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="DescriptionID">Blog Description</label>
                                        <vue-editor v-model="form.details" id="DescriptionID" placeholder="Description" name="details" :class="{ 'is-invalid': form.errors.has('details') }"></vue-editor>
                                        <has-error :form="form" field="details"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Update Blog</button>
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
    name: "Edit",
    data(){
        return{
            form: new Form({
                category_id: '',
                title: '',
                image: '',
                details: '',
                tags: '',
            })
        }
    },
    mounted(){
        this.$store.dispatch('allBlogCategory')
    },
    created(){
        axios.get(`/edit/blog/details/${this.$route.params.blogId}`)
            .then((response)=>{
                this.form.fill(response.data.blog)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    computed:{
        allBlogCategories(){
            return this.$store.getters.getAllBlogCategory
        }
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
                    this.form.image = event.target.result
                };
                reader.readAsDataURL(file);
            }
        },
        updateBlog(){
            this.form.post('/update/blog/'+this.$route.params.blogId)
                .then(()=>{
                    this.$router.push('/blog-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Blog Updated successfully'
                    })
                })
                .catch(()=>{

                })
        },
        uploadImage(){
            let img = this.form.image;
            if(img.length>50){
                return this.form.image
            }
            else{
                return `/blog_images/${this.form.image}`
            }
        },
    }
}
</script>

<style scoped>

</style>
