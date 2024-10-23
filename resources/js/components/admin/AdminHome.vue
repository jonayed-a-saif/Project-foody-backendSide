<template>
    <div>
        <!-- <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Welcome Note</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                        <i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                Welcome to the Admin panel. Lets have look on the features
                            </div>

                            <div class="card-footer">
                                Admin Panle
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <section class="content" v-if="getUserRole == 1 || getUserRole == 3">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Dashboard</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="position-relative p-3 pt-5 bg-gray" style="height: 180px">
                                    <div class="ribbon-wrapper ribbon-xl">
                                        <div class="ribbon bg-warning text-dark">
                                        Total Orders
                                        </div>
                                    </div>
                                    <h5>Total Orders :</h5>
                                    <h3>{{totalOrders}}</h3>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="position-relative p-3 pt-5 bg-gray" style="height: 180px">
                                    <div class="ribbon-wrapper ribbon-xl">
                                        <div class="ribbon bg-info text-dark">
                                        Total Amount
                                        </div>
                                    </div>
                                    <h5>Total Amount :</h5>
                                    <h3>{{totalAmount}} Taka</h3>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="position-relative p-3 pt-5 bg-gray" style="height: 180px">
                                    <div class="ribbon-wrapper ribbon-xl">
                                        <div class="ribbon bg-success text-dark">
                                        Total Customers
                                        </div>
                                    </div>
                                    <h5>Total Customer :</h5>
                                    <h3>{{totalCustomer}}</h3>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="position-relative p-3 pt-5 bg-gray" style="height: 180px">
                                    <div class="ribbon-wrapper ribbon-xl">
                                        <div class="ribbon bg-danger text-white">
                                        Total Products
                                        </div>
                                    </div>
                                    <h5>Total Product :</h5>
                                    <h3>{{totalProduct}}</h3>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row mt-3"> 
                                <div class="col-sm-3">
                                    <div class="position-relative p-3 pt-5 bg-gray" style="height: 180px">
                                    <div class="ribbon-wrapper ribbon-xl">
                                        <div class="ribbon bg-info text-white">
                                        Total SMS Sent
                                        </div>
                                    </div>
                                    <h5>Total SMS :</h5>
                                    <h3>{{totalSms}}</h3>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="position-relative p-3 pt-5 bg-gray" style="height: 180px">
                                    <div class="ribbon-wrapper ribbon-xl">
                                        <div class="ribbon bg-success text-white">
                                        Total Remaining SMS
                                        </div>
                                    </div>
                                    <h5>Remaining :</h5>
                                    <h3>{{totalRemainSms}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="content" v-if="getUserRole == 1 || getUserRole == 3">
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card card-danger mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Products with Lower Stock : <b>{{numberofProducts}}</b></h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-responsive">
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
                                    <tbody v-if="allProducts.length != 0">
                                        <tr v-for="(product,index) in allProducts" :key="product.id">
                                            <td>{{index+1}}</td>
                                            <td>{{product.user_name}}</td>
                                            <td>{{product.category_name}}</td>
                                            <td>{{product.name}}</td>
                                            <td><i class="fas fa-arrow-down bg-danger"></i> {{product.stock}}</td>
                                            <td><img :src="ourImage(product.image)" class="img-fluid"></td>
                                            <td><span v-if="product.price">{{product.price}} Taka</span></td>
                                            <td>{{product.slug}}</td>
                                            <td>{{product.created_at | timeformat2}}</td>
                                            <td v-if="product.status==1"><span class="btn btn-success btn-sm rounded" @click.prevent="statusChange(product.id)">Active</span></td>
                                            <td v-else><span class="btn btn-danger btn-sm rounded" @click.prevent="statusChange(product.id)">Deactivate</span></td>
                                            <td>
                                                <router-link :to="`/edit-product/${product.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="" @click.prevent="deleteProduct(product.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="12" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
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
    name: 'DashBoard',
    data(){
        return{
            current_page: '',
            last_page: '',
            pageNumber:1,
            url:"/get/product/stock/for/dashboard?page="+this.pageNumber,
        }
    },
    mounted(){
        this.$store.dispatch('totalOrdersForDashboard')
        this.$store.dispatch('totalSentSmsDashboard')
        this.$store.dispatch('totalRemainSmsDashboard')
        this.$store.dispatch('totalAmountsForDashboard')
        this.$store.dispatch('totalCustomerForDashboard')
        this.$store.dispatch('totalProductsrForDashboard')
        this.$store.dispatch('checkForUserRole')
        this.$store.dispatch('getAllProductWithStockDashboard',this.url),
        axios.get(this.url)
            .then((response) => {
                this.current_page=response.data.products.current_page
                this.last_page=response.data.products.last_page
            })
    },
    computed: {
        totalOrders(){
            return this.$store.getters.gettotalOrderforDashboard
        },
        totalSms(){
            return this.$store.getters.gettotalNumberofSentSms
        },
        totalRemainSms(){
            return this.$store.getters.gettotalNumberofRemainSms
        },
        totalAmount(){
            return this.$store.getters.gettotalAmountforDashboard
        },
        totalCustomer(){
            return this.$store.getters.getCustomersforDashboard
        },
        totalProduct(){
            return this.$store.getters.getProductsforDashboard
        },
        getUserRole(){
            return this.$store.getters.getUserRoleForBackend
        },
        allProducts(){
            return this.$store.getters.getAllProducts
        },
        numberofProducts(){
            return this.$store.getters.getNumberofProducts
        },
    },
    methods:{
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
            this.url = "/get/product/stock/for/dashboard?page="+this.pageNumber,
            this.$store.dispatch("getAllProduct",this.url)
        },
        prevPage(){
            if(this.pageNumber > 1){
                this.pageNumber = this.pageNumber-1
            }
            this.url = "/get/product/stock/for/dashboard?page="+this.pageNumber,
            this.$store.dispatch("getAllProduct",this.url)
        },
    }

}
</script>
