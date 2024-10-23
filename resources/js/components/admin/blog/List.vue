<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Blog List</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-blog" class="text-white">Add New Blog</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>View</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="allBlogs.length != 0">
                                        <tr v-for="(blog,index) in allBlogs" :key="blog.id">
                                            <td>{{index+1}}</td>
                                            <td>{{blog.user_name}}</td>
                                            <td>{{blog.category_name}}</td>
                                            <td><img :src="ourImage(blog.image)" class="img-fluid"></td>
                                            <td>{{blog.title}}</td>
                                            <td>{{blog.slug}}</td>
                                            <td>{{blog.views}}</td>
                                            <td>{{blog.created_at | timeformat2}}</td>
                                            <td>
                                                <router-link :to="`/edit-blog/${blog.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="" @click.prevent="deleteBlog(blog.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="9" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="pagination">
                                    <button class="btn btn-sm btn-primary" @click.prevent="prevPage()">
                                        Previous
                                    </button>
                                    <span class="ml-2 mr-2">Page {{this.pageNumber}} of {{this.last_page}}</span>
                                    <button class="btn btn-sm btn-primary" @click.prevent="nextPage()">
                                        Next
                                    </button>
                                </div>
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
    name: 'BlogList',
    data(){
        return{
            current_page: '',
            last_page: '',
            pageNumber:1,
            url:"/get/blog/backend?page="+this.pageNumber,
        }
    },
    mounted(){
        this.$store.dispatch('getAllBlog',this.url),
        axios.get(this.url)
            .then((response) => {
                this.current_page=response.data.blogs.current_page
                this.last_page=response.data.blogs.last_page
            })
    },
    computed: {
        allBlogs(){
            return this.$store.getters.getAllBlogs
        }
    },
    methods:{
        ourImage(img){
            return "blog_images/"+img;
        },
        deleteBlog(id){
            axios.get('/delete/blog/'+id)
                .then(()=>{
                    this.$store.dispatch("getAllBlog",this.url)
                    toast.fire({
                        icon: 'success',
                        title: ' Blog Deleted successfully'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: ' Something went wrong',
                    })
                })
        },
        nextPage(){
            if(this.pageNumber < this.last_page){
                this.pageNumber = this.pageNumber+1
            }
            this.url = "/get/blog/backend?page="+this.pageNumber,
            this.$store.dispatch("getAllBlog",this.url)
        },
        prevPage(){
            if(this.pageNumber > 1){
                this.pageNumber = this.pageNumber-1
            }
            this.url = "/get/blog/backend?page="+this.pageNumber,
            this.$store.dispatch("getAllBlog",this.url)
        },
    }
}
</script>

<style scoped>

</style>
