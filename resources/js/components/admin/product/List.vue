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
                                        <h3 class="card-title">Product List : <b>{{allProductsCount}}</b> </h3>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="card-tools">
                                            <button class="btn btn-primary">
                                                <router-link to="/add-product" class="text-white">Add New Product</router-link>
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="productTable" class="table table-bordered table-hover ">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
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



import { Pagination } from 'laravel-vue-pagination';
import EditProduct from './Edit.vue';
import EditPost from './Edit.vue'

export default {
    name: "List",
    components: {
        Pagination,
        EditPost,
        EditProduct
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
            allProducts: [],
            allProductsCount: ''
        }
    },
    created() {

        axios
            .get('api/get/all/products')
            .then(response => {
                
                this.allProductsCount = response.data.length
                console.log('allProducts-'+this.allProducts)
            })

        $(document).ready(function(){
        })
    },
    mounted(){
        var self = this;
        $('#productTable').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': 'get/all/products',
                "searchable": true,
                // "sorting": true,
                "pageLength": 10,
                "paging": true,
                'columns': [
                    {data: 'id', name: 'id'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'name', name: 'name'},
                    {data: 'stock', name: 'stock'},
                    {data: 'image', name: 'image', targets: 5,
                        "render": function(data, type, row, meta) {
                            return '<img src="product_images/'+(data)+'" class="img-fluid">'
                        }
                    },
                    {data: 'price', name: 'price'},
                    {data: 'slug', name: 'slug'},
                    {data: 'created_at', name: 'created_at'},
                    /*{data: 'created_at', name: 'created_at', targets: 8,
                        "render": function(data, type, row, meta) {
                            let date_format = new Date(data)
                            return date_format.getDate()+'-'+date_format.getMonth()+'-'+date_format.getFullYear
                        }
                    },*/
                    {title: 'Status', data: 'status',  targets: 9,
                        "render": function(data, type, row, meta) {
                            if(data == 0) {
                                return '<a  href="javascript:void" data-item-id='+row.id+' class="status-change btn btn-danger btn-sm rounded">Deactive</a>'
                            } else if(data == 1) {
                                return '<a  href="javascript:void" data-item-id='+row.id+' class="status-change btn btn-success btn-sm rounded">Active</a>'
                            }
                        }
                    },
            
                    { title: 'Action', data: 'id', targets: 10, 
                        "render":function(data, type, row, meta){
                            //data item in case you want to send any data
                            return '<i class="fas fa-edit edit-item btn btn-warning btn-sm rounded mb-1 p-2"  data-item-id='+data+'></i>'+ ' <i class="fas fa-trash-alt delete-item btn btn-danger btn-sm rounded mb-1 p-2" data-item-id='+data+'></i>';
                            
                        }
                    }
                ],
                
                "drawCallback": function( data ) {
                        $(".edit-item").on( 'click', function (e) {
                            self.editP(e.target.dataset.itemId)
                        });
                        $(".delete-item").on( 'click', function (e) {
                            self.deleteP(e.target.dataset.itemId)
                        });
                        $(".status-change").on( 'click', function (e) {
                            self.statusChange(e.target.dataset.itemId)
                        });

                },
                'columnDefs' : 
                [        
                    { 
                        'searchable'    : false, 
                        'targets'       : [1,4,8,9] 
                    },
                    // { 'orderable': false, 'targets': [-1] }
                ]
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

        editP:function(id) {
            console.log(id);
            this.$router.push('/edit-product/'+id)
        },

        deleteP:function(id) {
            axios.get('/delete/product/'+id)
            .then(()=>{
                this.$store.dispatch("getAllProduct",this.url)
                toast.fire({
                    icon: 'success',
                    title: 'Product Deleted successfully'
                })
                $('#productTable').DataTable().ajax.reload()
            })
            .catch(()=>{
                toast.fire({
                    icon: 'error',
                    text: 'Something went wrong',
                })
            })
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
                    $('#productTable').DataTable().ajax.reload();
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
