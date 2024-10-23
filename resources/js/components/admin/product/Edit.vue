<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-10">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-boxes"></i> Edit Product</h3>
                            </div>
                            <form role="form" enctype="multipart/form-data" @submit.prevent="updateProduct()">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="productImage">Product Image</label>
                                                <input @change="changePhoto($event)" type="file" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="productImage" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                                <has-error :form="form" field="image"></has-error>
                                                <img :src="uploadImage()" class="img-fluid mt-1">
                                            </div>
                                        </div>

                                        <div class="col-lg-8">

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="categoryID">Select Category</label>
                                                        <select class="form-control" id="categoryID" v-model="form.category_id" @change='getSubCategory()' :class="{ 'is-invalid': form.errors.has('category_id') }">
                                                            <option disabled value="">Select One</option>
                                                            <option v-for="category in getCategoryForProduct" :value="category.id" :key="category.id">{{category.name}}</option>
                                                        </select>
                                                        <has-error :form="form" field="category_id"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="subcategoryID">Select Sub-Category</label>
                                                        <select class="form-control" id="subcategoryID" v-model="form.subcategory_id" @change='getchildCategory()' :class="{ 'is-invalid': form.errors.has('subcategory_id') }">
                                                            <option disabled value="">Select One</option>
                                                            <option v-for="subcategory in subcategories" :value="subcategory.id" :key="subcategory.id">{{subcategory.name}}</option>
                                                        </select>
                                                        <has-error :form="form" field="subcategory_id"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">

                                                    <div class="form-group">
                                                        <label for="childcategoryID">Select Child-Category</label>
                                                        <select class="form-control" id="childcategoryID" v-model="form.childcategory_id" :class="{ 'is-invalid': form.errors.has('childcategory_id') }">
                                                            <option disabled value="">Select One</option>
                                                            <option v-for="childcategory in childcategories" :value="childcategory.id" :key="childcategory.id">{{childcategory.name}}</option>
                                                        </select>
                                                        <has-error :form="form" field="category_id"></has-error>
                                                    </div>

                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="stock">Stock</label>
                                                        <input type="number" class="form-control" id="stock" placeholder="Enter Stock" v-model="form.stock" name="stock" :class="{ 'is-invalid': form.errors.has('stock') }">
                                                        <has-error :form="form" field="stock"></has-error>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="prevPrice">Prev Price (In Taka)</label>
                                                        <input type="number" class="form-control" id="prevPrice" placeholder="Previos Price" v-model="form.prev_price" name="prev_price" :class="{ 'is-invalid': form.errors.has('prev_price') }">
                                                        <has-error :form="form" field="prev_price"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="productPrice">Current Price (In Taka)</label>
                                                        <input type="number" class="form-control" id="productPrice" placeholder="Enter Product Price" v-model="form.price" name="price" :class="{ 'is-invalid': form.errors.has('price') }">
                                                        <has-error :form="form" field="price"></has-error>
                                                    </div>
                                                </div>
                                              
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" class="form-control" id="productName" placeholder="Enter Product Name" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="DescriptionID">Product Description</label>
                                        <vue-editor v-model="form.description" id="DescriptionID" placeholder="Product Description" name="description" :class="{ 'is-invalid': form.errors.has('description') }"></vue-editor>
                                        <has-error :form="form" field="description"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="policyID">Product Policy</label>
                                        <vue-editor v-model="form.policy" id="policyID" placeholder="Product Policy" name="policy" :class="{ 'is-invalid': form.errors.has('policy') }"></vue-editor>
                                        <has-error :form="form" field="policy"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label>Product Gallery :</label>

                                        <b v-if="this.form.photos != null">

                                            <span v-for="photo in JSON.parse(this.form.photos)" :key="photo.id">
                                                <img :src="`/product_images/${photo}`" alt="Product Image" class="product_image">
                                            </span>
                                             <!-- {{this.form.photos}} -->

                                        </b>
                                        <b v-else>No Images are found 😢</b>
                                    </div>

                                     <div class="row mt-3">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Upload Multiple Image (Max:5)</label>
                                                <input type="file" @change="imageChange" name="photo" class="form-control" ref="files" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" multiple>
                                                <br>
                                                <div style="display:block" v-for="(image,index) in images" :key="index">
                                                    <!-- &nbsp; Name: {{image.name}} -->
                                                    &nbsp; <a @click="removeImage(index)" class="btn btn-danger btn-sm rounded mb-1"> <i class="fas fa-trash-alt"> </i> </a>
                                                    <br>
                                                    <img class="preview"  style="max-width: 100%;" :ref="'image'" />
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                             
                                    </div>

                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Update Product</button>
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
            images: [],
            subcategories: [],
            childcategories: [],
            form: new Form({
                name: '',
                price: '',
                prev_price: '',
                description: '',
                category_id: '',
                subcategory_id: '',
                childcategory_id: '',
                stock:'',
                policy: '',
                image: '',
                condition: '',
                photos: [],
            })
        }
    },
    mounted(){
        this.$store.dispatch("allCategoryForNewProduct")
    },
    created(){

        axios.get(`/edit/product/details/${this.$route.params.productId}`)
            .then((response)=>{
                this.form.fill(response.data.product)
                axios.get('/edit-product/get/subcategory/list/'+this.form.category_id)
                    .then((response)=>{
                        this.subcategories = response.data;
                        axios.get('get/childcategory/list/'+this.form.subcategory_id)
                            .then((response)=>{
                                this.childcategories = response.data;
                            })
                            .catch(()=>{
                                console.log("Error")
                            })
                    })
                    .catch(()=>{
                        console.log("Error")
                    })
            })
            .catch(()=>{
                console.log("Error1")
            })
    },
    computed:{
        getCategoryForProduct(){
            return this.$store.getters.getCategoryForProduct
        }
    },
    methods:{
        removeImage(index){    
                this.images.splice(index,1);             
            } ,
        imageChange(e) {
            let vm = this;
            var selectedFiles = e.target.files;
            for (let i = 0; i < selectedFiles.length; i++) {
                console.log(selectedFiles[i]);
                this.images.push(selectedFiles[i]);
            }

            for (let i = 0; i < this.images.length; i++) {
                let reader = new FileReader();
            reader.onload = (e) => {
                this.$refs.image[i].src = reader.result;

                console.log(this.$refs.image[i].src);
                };

                reader.readAsDataURL(this.images[i]);
            }
        },    
        ximageChange(){
            for(let i=0;i<this.$refs.files.files.length;i++){
                this.images.push(this.$refs.files.files[i]);
                console.log(this.images);
            }
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
        getSubCategory(){
            this.childcategories = null;
            axios.get('get/subcategory/list/'+this.form.category_id)
                .then((response)=>{
                    this.subcategories = response.data;
                })
                .catch(()=>{
                    console.log("Error")
                })
        },
        getchildCategory(){
            axios.get('get/childcategory/list/'+this.form.subcategory_id)
                .then((response)=>{
                    this.childcategories = response.data;
                })
                .catch(()=>{
                    console.log("Error")
                })
        },
        updateProduct(){

            // multiple image upload start
            let self = this;
            let formData = new FormData();
            if(this.images.length >= 6){
                swal.fire({
                    icon: 'error',
                    title: 'Oppss...',
                    text: 'Maximum 5 images can be uploaded',
                })
                self.images = [];
            }
            else{
                for(let i = 0; i < this.images.length;i++){
                    let file = self.images[i];
                    formData.append('files['+i+']',file);
                }
                const config = {
                    headers:{"content-type" : "multipart/form-data"}
                }
                axios
                .post('/multiple/image',formData,config)
                .then((response) => {
                    self.$refs.files.value = '';
                    self.images = [];
                })
                .catch((error) => {
                    console.log(error)
                })
                // multiple image upload end

                this.form.post('/update/product/'+this.$route.params.productId)
                    .then(()=>{
                        this.$router.push('/product-list');
                        toast.fire({
                            icon: 'success',
                            title: 'Product Updated successfully'
                        })
                    })
                    .catch(()=>{

                    })
            }

        },
        uploadImage(){
            let img = this.form.image;
            if(img.length>50){
                return this.form.image
            }
            else{
                return `/product_images/${this.form.image}`
            }
        },
    }
}
</script>

<style scoped>
.product_image{
    height: 60px;
    width: 60px
}
</style>
