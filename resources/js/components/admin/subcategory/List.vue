<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Sub-Category List</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-subcategory" class="text-white">Add New Sub-Category</router-link>
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
                                            <th>Sub-Category</th>
                                            <th>Slug</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="allSubCategories.length != 0">
                                        <tr v-for="(subcategory,index) in allSubCategories" :key="subcategory.id">
                                            <td>{{index+1}}</td>
                                            <td>{{subcategory.category_name}}</td>
                                            <td>{{subcategory.name}}</td>
                                            <td>{{subcategory.slug}}</td>
                                            <td>{{subcategory.created_at | timeformat2}}</td>
                                            <td>
                                                <router-link :to="`/edit-subcategory/${subcategory.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="" @click.prevent="deleteSubCategory(subcategory.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
    mounted(){
        this.$store.dispatch('allSubCategory')
    },
    computed: {
        allSubCategories(){
            return this.$store.getters.getAllSubCategory
        }
    },
    methods:{
        deleteSubCategory(id){
            axios.get('/delete/subcategory/'+id)
                .then(()=>{
                    this.$store.dispatch('allSubCategory')
                    toast.fire({
                        icon: 'success',
                        title: 'SubCategory Deleted successfully'
                    })
                })
                .catch(()=>{
                     toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        },
    }
}
</script>

<style scoped>

</style>
