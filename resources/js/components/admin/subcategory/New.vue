<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Sub-Category</h3>
                            </div>
                            <form role="form">
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
                                        <label for="SubCategoryID">New Sub-Category Name</label>
                                        <input type="text" class="form-control" id="SubCategoryID" placeholder="Enter Sub-Category Name" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addSubCategory()">Submit</button>
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
    data(){
        return{
            form: new Form({
                category_id: '',
                name: ''
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
    methods: {
        addSubCategory(){
            this.form.post('/add/new/subcategory')
            .then(({response})=>{
                this.$router.push('/subcategory-list');

                toast.fire({
                    icon: 'success',
                    title: 'Sub-Category Added successfully'
                })
            })
            .catch(()=>{
                console.log('Error cateched')
            })
        }
    }

}
</script>

<style scoped>

</style>



