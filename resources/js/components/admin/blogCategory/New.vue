<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Blog-Category</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="ChildCategoryID">Blog-Category Name</label>
                                        <input type="text" class="form-control" id="ChildCategoryID" placeholder="Enter Blog-Category Name" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addBlogCategory()">Submit</button>
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
    name: 'BlogCategoryNew',
    data(){
        return{
            form: new Form({
                name: ''
            })
        }
    },
    methods:{
        addBlogCategory(){
            this.form.post('/add/new/blog/category')
            .then(({response})=>{
                this.$router.push('/blogCategory-list');

                toast.fire({
                    icon: 'success',
                    title: 'Blog-Category Added successfully'
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
