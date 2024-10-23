<template>
	<div>
              <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Home Category List</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/home-add-category" class="text-white">Add New Home Category</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category Name</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody v-if="getAllCategory.length != 0">
                                        <tr v-for="(category,index) in getAllCategory" :key="category.id">
                                            <td>{{index+1}}</td>
                                            <td>{{category.name}}</td>
                                            <td><span v-if="category.start_time !=null">{{category.start_time | timeformat}}</span></td>
                                            <td><span v-if="category.end_time !=null">{{category.end_time | timeformat}}</span></td>
                                            <td>{{category.slug}}</td>
                                            <td>
                                                <router-link :to="`/home-edit-category/${category.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteCategory(category.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="6" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
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
        name:"List",
        data(){
            return{
                current_page: '',
                last_page: '',
                pageNumber:1,
                url:"/get/homecategory/backend?page="+this.pageNumber,
            }
        },
        mounted(){
            this.$store.dispatch("allHomeCategory",this.url),
            axios.get(this.url)
                .then((response) => {
                    this.current_page=response.data.homecategories.current_page
                    this.last_page=response.data.homecategories.last_page
                })
        },
        computed:{
            getAllCategory(){
                return this.$store.getters.getHomeCategory
            }
        },
        methods:{
           
            deleteCategory(id){
                axios.get('/delete/homecategory/'+id)
                    .then(()=>{
                       this.$store.dispatch("allHomeCategory",this.url)
                        toast.fire({
                            icon: 'success',
                            title: 'Home Category Deleted successfully'
                        })
                    })
                    .catch(()=>{
                        toast.fire({
                            icon: 'error',
                            text: 'Something Wrong',
                        })
                    })
            },
            nextPage(){
                if(this.pageNumber < this.last_page){
                    this.pageNumber = this.pageNumber+1
                }
                this.url = "/get/homecategory/backend?page="+this.pageNumber,
                this.$store.dispatch("allHomeCategory",this.url)
            },
            prevPage(){
                if(this.pageNumber > 1){
                    this.pageNumber = this.pageNumber-1
                }
                this.url = "/get/homecategory/backend?page="+this.pageNumber,
                this.$store.dispatch("allHomeCategory",this.url)
            },
        }
    }
</script>

<style lang="sass" scoped>

</style>
