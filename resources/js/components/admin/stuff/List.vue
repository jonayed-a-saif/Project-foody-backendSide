<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> Stuff Management </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Stuff Management</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-stuff" class="text-white">Add New Stuff</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Role</th>
                                            <th>Permissions</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllStuff.length != 0">
                                        <tr v-for="(stuff,index) in getAllStuff" :key="stuff.id">
                                            <td>{{index+1}}</td>
                                            <td>{{stuff.name}}</td>
                                            <td>{{stuff.email}}</td>
                                            <td>{{stuff.contact}}</td>
                                            <td v-if="stuff.role == 1">Admin</td>
                                            <td v-else>Stuff</td>
                                            <td>
                                                <span v-if="stuff.category">Category, </span>
                                                <span v-if="stuff.product">Product, </span>
                                                <span v-if="stuff.coupon">Coupon, </span>
                                                <span v-if="stuff.blog">Blog, </span>
                                                <span v-if="stuff.general">General, </span>
                                                <span v-if="stuff.home">HomePage, </span>
                                                <span v-if="stuff.payment">Payment, </span>
                                                <span v-if="stuff.stuff">Stuff, </span>
                                                <span v-if="stuff.order_manage">Order</span>
                                            </td>
                                            <td>{{stuff.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-stuff/${stuff.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteStuff(stuff.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
        name:"List",
        data() {
            return {
            someStyle: {
                    fontSize: '10px',
                },
            };
        },
        mounted(){
            this.$store.dispatch('allStuffs')
        },
        computed:{
            getAllStuff(){
                return this.$store.getters.getstuffForBackend
            }
        },
        methods:{
            deleteStuff(id){
                axios.get('/delete/stuff/'+id)
                    .then(()=>{
                        this.$store.dispatch('allStuffs')
                        toast.fire({
                            icon: 'success',
                            title: 'Stuff Deleted successfully'
                        })
                    })
                    .catch(()=>{
                        toast.fire({
                            icon: 'error',
                            text: 'Some Orders are related to that User',
                        })
                    })
            }
        }
    }
</script>

<style lang="sass" scoped>

</style>
