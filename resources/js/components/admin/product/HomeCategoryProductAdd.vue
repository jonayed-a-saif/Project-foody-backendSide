<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                    	<div class="row">
                    		
                    		<div class="col-md-6">

                    			<div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Search Product For <b>{{ home_category.name }}</b></h3>
                            </div>
                        
                                <div class="card-body">

                               

                                    <div class="form-group">
                                        <label for="search_term">Product Name</label>
                                        <input type="text" @keyup="searchProduct" class="form-control" id="search_term" placeholder="Search Product name"  name="search_term">
                                        <ul class="list-group" id="result">
                                        <template v-if="products.length > 0">
                                        	<li class="list-group-item" v-for="product in products" :key="product.id" @click="addProduct(product.id)"><img :src="`/product_images/${product.image}`" width="40"> <b>{{product.name}}</b></li>
                                        </template>
                                        <template v-else>
                                        	<li v-if="response" class="list-group-item" ><b>No Product found</b></li>
                                        </template>
										  
										</ul>
                                    </div>

                                   


                                </div>
                                <!-- <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div> -->
                        
                        </div>

                    			
                    		</div>

                    		<div class="col-md-6">


                    			   <div class="card mt-3">
		                            <div class="card-header">
		                                <h3 class="card-title">{{ home_category.name }} Product List </h3>
		                                <div class="card-tools">
		                                </div>
		                            </div>
		                            
		                            <div class="card-body">
		                                <table id="example2" class="table table-bordered table-hover">
		                                    <thead>
		                                        <tr>
		                                            <th>SL</th>
		                                            <th>Name</th>
                                                    <th>Image</th>
		                                            <th>Action</th>
		                                        </tr>
		                                    </thead>

		                                    <tbody v-if="getAllHomeCategoryProduct.length != 0">
		                                        <tr v-for="(product,index) in getAllHomeCategoryProduct" :key="product.id">
		                                            <td>{{index+1}}</td>
		                                            <td>{{product.product.name}}</td>
		                                            <td><img :src="`/product_images/${product.product.image}`" class="img-fluid" height="40" width="40"></td>
		                                            <td>
		                                                
		                                                <a href="#" @click.prevent="deleteHomeCategoryProduct(product.id)"  class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
                </div>
            </div>
        </section>
	</div>
</template>

<script>
    export default {
        name:"HomeCategoryProductAdd",

        data() {
        	return {
        		products: [],
        		response: false,
        		form: {
        			product_id: '',
        			slug: '',
        		},
        		current_page: '',
                last_page: '',
                pageNumber:1,
                url:"/get/homecateprory/product/"+this.$route.params.slug+"/?page="+this.pageNumber,
                home_category: {}
        	}
        },

        mounted(){
            this.$store.dispatch("allHomeCategoryProduct",this.url),
            axios.get(this.url)
                .then((response) => {
                    this.current_page=response.data.homecategoriesProducts.current_page
                    this.last_page=response.data.homecategoriesProducts.last_page
            })
            axios.get(`/home/category/detail/${this.$route.params.slug}`)
            .then((res) => {
                this.home_category = res.data

            })
        },
            
        computed:{
            getAllHomeCategoryProduct(){
                return this.$store.getters.getHomeCategoryProduct
            }
        },

        methods: {
        	
        	searchProduct(){
        		$('#result').show();
        		var term = $('#search_term').val();
        		axios.get('/home/category/product/search/'+term)
        		.then((res) => {
     				this.response = true
        			this.products = res.data

        		})
        	},

        	addProduct(id){

        		this.form.product_id = id;
        		this.form.slug = this.$route.params.slug;

        		axios.post('/add/home/category/product',this.form)
        		.then((res) => {
        			
        			this.$store.dispatch("allHomeCategoryProduct",this.url)
        			if (res.data == 'success') {
        				toast.fire({
	                    icon: 'success',
	                    title: 'Product Added successfully'
	                 })
        			}else{
        				swal.fire({
		                    icon: 'error',
		                    title: 'Oppss...',
		                    text: 'Product Already Added',
		                })
        			}

        			$('#search_term').val('');


        		})
        		.catch(()=> {

        		})

        		$('#result').hide();

        	},

            deleteHomeCategoryProduct(id){
            axios.get('/delete/home/category/product/'+id)
                .then(()=>{
                    this.$store.dispatch("allHomeCategoryProduct",this.url)
                    toast.fire({
                        icon: 'success',
                        title: 'Home Category Product Deleted successfully'
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
                this.url = "/get/homecateprory/product/"+this.$route.params.slug+"/?page="+this.pageNumber,
                this.$store.dispatch("allHomeCategoryProduct",this.url)
            },
            prevPage(){
                if(this.pageNumber > 1){
                    this.pageNumber = this.pageNumber-1
                }
                this.url = "/get/homecateprory/product/"+this.$route.params.slug+"/?page="+this.pageNumber,
                this.$store.dispatch("allHomeCategoryProduct",this.url)
            },
        }

    }
</script>

<style lang="sass" scoped>

</style>
