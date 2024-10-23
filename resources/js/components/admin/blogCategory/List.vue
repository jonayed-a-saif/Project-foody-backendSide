<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Blog-Category List</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-blogCategory" class="text-white">Add New Blog-Category</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category</th>
                                            <th>Slug</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="allBlogCategories.length != 0">
                                        <tr v-for="(blogcategory,index) in allBlogCategories" :key="blogcategory.id">
                                            <td>{{index+1}}</td>
                                            <td>{{blogcategory.name}}</td>
                                            <td>{{blogcategory.slug}}</td>
                                            <td>{{blogcategory.created_at | timeformat2}}</td>
                                            <td>
                                                <router-link :to="`/edit-blogCategory/${blogcategory.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="" @click.prevent="deleteBlogCategory(blogcategory.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="5" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</div>
</template>

<script>
export default {
    name: 'BlogCategoryList',
    mounted(){
        this.$store.dispatch('allBlogCategory')
    },
    computed: {
        allBlogCategories(){
            return this.$store.getters.getAllBlogCategory
        }
    },
    methods:{
        deleteBlogCategory(id){
            axios.get('/delete/blog/category/'+id)
                .then(()=>{
                    this.$store.dispatch('allBlogCategory')
                    toast.fire({
                        icon: 'success',
                        title: 'BlogCategory Deleted successfully'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        }
    }
}
</script>

<style scoped>

</style>
