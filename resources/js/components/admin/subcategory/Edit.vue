<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Sub-Category</h3>
                            </div>
                            <form role="form" @submit.prevent="updateSubCategory()">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="categoryID">Select Category</label>
                                        <select class="form-control" id="categoryID" v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category_id') }">
                                            <option disabled value="">Select One</option>
                                            <option v-for="category in getCategoryForProduct" :value="category.id" :key="category.id">{{category.name}}</option>
                                        </select>
                                        <has-error :form="form" field="category_id"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="subCategoryID">SubCategory Rename</label>
                                        <input type="text" class="form-control" id="subCategoryID" placeholder="Enter New Name" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
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
    data () {
        return {
            form: new Form({
                name: '',
                category_id: ''
            })
        }
    },
    mounted(){
        this.$store.dispatch("allCategoryForNewProduct")
    },
    computed:{
        getCategoryForProduct(){
            return this.$store.getters.getCategoryForProduct
        }
    },
    created(){
        axios.get(`/edit/subcategory/details/${this.$route.params.subCategoryId}`)
            .then((response)=>{
                this.form.fill(response.data.subcategory)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        updateSubCategory(){
            this.form.post('/update/subcategory/'+this.$route.params.subCategoryId)
                .then(()=>{
                    this.$router.push('/subcategory-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Subcategory Updated successfully'
                    })
                })
                .catch(()=>{

                })
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
