<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Child-Category List</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-childcategory" class="text-white">Add New Child-Category</router-link>
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
                                            <th>Child-Category</th>
                                            <th>Slug</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="allChildCategories.length != 0">
                                        <tr v-for="(childcategory,index) in allChildCategories" :key="childcategory.id">
                                            <td>{{index+1}}</td>
                                            <td>{{childcategory.category_name}}</td>
                                            <td>{{childcategory.subcategory_name}}</td>
                                            <td>{{childcategory.name}}</td>
                                            <td>{{childcategory.slug}}</td>
                                            <td>{{childcategory.created_at | timeformat2}}</td>
                                            <td>
                                                <router-link :to="`/edit-childcategory/${childcategory.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="" @click.prevent="deleteChildCategory(childcategory.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="7" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
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
    name: 'New',
    mounted(){
        this.$store.dispatch('allChildCategory')
    },
    computed: {
        allChildCategories(){
            return this.$store.getters.getAllChildCategory
        }
    },
    methods:{
        deleteChildCategory(id){
            axios.get('/delete/childcategory/'+id)
                .then(()=>{
                    this.$store.dispatch('allChildCategory')
                    toast.fire({
                        icon: 'success',
                        title: 'ChildCategory Deleted successfully'
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
