<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title">Product List : <b>{{numberofProducts}}</b> </h3>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="card-tools">
                                            <button class="btn btn-primary">
                                                <router-link to="/add-product" class="text-white">Add New Product</router-link>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <form>
                                            <input @keyup="RealSearch" type="text" class="pl-2 w-25 rounded" v-model="keyword" placeholder="Search By Product Name">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example222" class="table table-bordered table-hover table-responsive d-none">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Stock</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Product Slug</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody></tbody> 
                                </table>
<!-- {{  allProducts }} -->
                                <table id="productTable" class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Stock</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Product Slug</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(product,index) in allProducts" :key="product.id">
                                            <td>{{index+1}}</td>
                                            <td>{{product.user_name}}</td>
                                            <td>{{product.category_name}}</td>
                                            <td>{{product.name}}</td>
                                            <td>{{product.stock}}</td>
                                            <td><img :src="ourImage(product.image)" class="img-fluid"></td>
                                            <td><span v-if="product.price">{{product.price}} Taka</span></td>
                                            <td>{{product.slug}}</td>
                                            <td>{{product.created_at}}</td>
                                            <td v-if="product.status==1">
                                                 <span class="btn btn-success btn-sm rounded" @click.prevent="statusChange(product.id)">Active</span></td>
                                            <td v-else><span class="btn btn-danger btn-sm rounded" @click.prevent="statusChange(product.id)">Deactivate</span> 
                                            </td>
                                            <td>
                                                 <router-link :to="`/edit-product/${product.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="" @click.prevent="deleteProduct(product.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a> 
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- <tbody v-else>
                                        <tr>
                                            <td colspan="12" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
                                        </tr>
                                    </tbody> -->
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
                            <!-- <Pagination
        :data="products"
        @pagination-change-page="getProducts"
    /> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</div>

    
</template>

<script>
import Router from 'vue-router'

import { Pagination } from 'laravel-vue-pagination';
// import EditProduct from '/.product/Edit.vue';
// import EditPost from './Edit'

export default {
    name: "List",
    components: {
        Pagination,
        // EditPost
    },
    data(){
        return{
            keyword: '',
            current_page: '',
            last_page: '',
            pageNumber:1,
            url:"/get/product/backend?page="+this.pageNumber,
            url1:"/get/product/backend",
            products: {},
            // allProducts: []
            allProducts: 
                [{
                     id: '',
                     user_name: '',
                     category_name: '',
                     name: '',
                     stock: '',
                     image: '',
                     price: '',
                     slug: '',
                     created_at: '',
                     status: '',
                    }]
                
        }
    },
    created() {
        
        $(document).ready(function(){

            
            
            $('#productTable').DataTable({
                paging: true,
                ordering: true,
                info: true,
                // 'ajax': 'get/all/products',
            })
            $('#example2222').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': 'get/all/products',
                'columns': [
                    
                     {data: 'id', name: 'id'},
            {data: 'user_name', name: 'user_name'},
            {data: 'category_name', name: 'category_name'},
            {data: 'name', name: 'name'},
            {data: 'stock', name: 'stock'},
            // {data: 'stock', name: 'stock'},
            {data: 'price', name: 'price'},
            // {data: 'price', name: 'price'},
            {data: 'status', name: 'status'},
            // {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                createdRow: function(row, data, dataIndex) {
                //     console.log(data)
                    // $('td:eq(7)', row).html('<router-link :to="{path: /edit-product/'+data.id + '}" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>') 
                    $('td:eq(7)', row).html('<a href="/edit-product/'+data.id+'" class="btn btn-warning btn-sm rounded mb-1">Edit</a>')  
                    // $('td:eq(7)', row).html('<button @click.prevent="editP('+data.id+')" class="btn btn-warning btn-sm rounded mb-1">Edit</button>')  
                    // this.$router.push('/your-custom-route')
                
                }
            })
        })

    },
    mounted(){

        axios
            .get('api/get/all/products')
            .then(response => {
                
                this.allProducts = response.data
                console.log('allProducts-'+this.allProducts)
            })
        // this.$store.dispatch('getAllProduct',this.url),
        // axios.get(this.url)
        //     .then((response) => {
        //         this.current_page=response.data.products.current_page
        //         this.last_page=response.data.products.last_page
        //     })
    },
    computed: {
        // allProducts(){
        //     return this.$store.getters.getAllProducts
        // },
        numberofProducts(){
            return this.$store.getters.getNumberofProducts
        }
    },
    methods:{
        editP(id) {
            alert('123')
            // this.$router.push('/edit-product/'+id)
            this.$router.push({name: 'Edit', params: { id: id }})
        },
        getProducts(){
            axios 
                .get('/get/product/backend')
                .then(response => {
                    console.log(response.data)
                    this.products = response.data.products
                })
        },
        ourImage(img){
            return "product_images/"+img;
        },
        deleteProduct(id){
            axios.get('/delete/product/'+id)
                .then(()=>{
                    this.$store.dispatch("getAllProduct",this.url)
                    toast.fire({
                        icon: 'success',
                        title: 'Product Deleted successfully'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        },
        statusChange(id){
            axios.get('/product/status/change/'+id)
                .then(()=>{
                    this.$store.dispatch("getAllProduct",this.url)
                    toast.fire({
                        icon: 'success',
                        title: 'Product Status Changed successfully'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        },
        nextPage(){
            if(this.pageNumber < this.last_page){
                this.pageNumber = this.pageNumber+1
            }
            this.url = "/get/product/backend?page="+this.pageNumber,
            this.$store.dispatch("getAllProduct",this.url)
        },
        prevPage(){
            if(this.pageNumber > 1){
                this.pageNumber = this.pageNumber-1
            }
            this.url = "/get/product/backend?page="+this.pageNumber,
            this.$store.dispatch("getAllProduct",this.url)
        },
        RealSearch(){
            this.$store.dispatch('SearchProduct',this.keyword),
            axios.get(this.url1)
                .then((response) => {
                    this.current_page=response.data.products.current_page
                    this.last_page=response.data.products.last_page
                })
        }
    }
}
</script>

<style scoped>

</style>
