<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Blog-Category</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="ChildCategoryID">Edit Name</label>
                                        <input type="text" class="form-control" id="ChildCategoryID" placeholder="Enter Name" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="updateBlogCategory()">Update</button>
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
    name: 'Edit',
    data(){
        return{
            form: new Form({
                name: ''
            })
        }
    },
    created(){
        axios.get(`/edit/blog/category/details/${this.$route.params.blogCategoryId}`)
            .then((response)=>{
                this.form.fill(response.data.blogCategory)
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        updateBlogCategory(){
            this.form.post('/update/blog/category/'+this.$route.params.blogCategoryId)
                .then(()=>{
                    this.$router.push('/blogCategory-list');
                    toast.fire({
                        icon: 'success',
                        title: 'Blog Category Updated successfully'
                    })
                })
                .catch(()=>{

                })
        }
    }
}
</script>

<style scoped>

</style>
