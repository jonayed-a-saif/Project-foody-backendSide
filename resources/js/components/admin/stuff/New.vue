<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-8">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> Stuff Management </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Stuff</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter Name" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter Email" v-model="form.email" name="email" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <has-error :form="form" field="email"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="contact">Contact</label>
                                        <input type="text" class="form-control" id="contact" placeholder="+8801000000000" v-model="form.contact" name="contact" :class="{ 'is-invalid': form.errors.has('contact') }">
                                        <has-error :form="form" field="contact"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="new">New Password</label>
                                        <input type="password" class="form-control" id="new" placeholder="New Password" v-model="form.password" name="password" :class="{ 'is-invalid': form.errors.has('password') }">
                                        <has-error :form="form" field="password"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm" placeholder="Confirm Password" v-model="form.confirm_password" name="confirm_password" :class="{ 'is-invalid': form.errors.has('confirm_password') }">
                                        <has-error :form="form" field="confirm_password"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Select Role</label>
                                        <select class="form-control" id="role" v-model="form.role" :class="{ 'is-invalid': form.errors.has('role') }">
                                            <option disabled value="">Select One</option>
                                            <option value="1">Admin</option>
                                            <option value="3">Stuff</option>
                                        </select>
                                        <has-error :form="form" field="role"></has-error>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Choose Which Function Can be access by this Stuff :</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" name="category" value="1" v-model="form.category" id="checkboxPrimary1">
                                                        <label for="checkboxPrimary1">
                                                        Category
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" name="product" value="1" v-model="form.product" id="checkboxPrimary2">
                                                        <label for="checkboxPrimary2">
                                                        Product
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" name="coupon" value="1" v-model="form.coupon" id="checkboxPrimary3">
                                                        <label for="checkboxPrimary3">
                                                        Coupon
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" name="blog" value="1" v-model="form.blog"  id="checkboxPrimary4">
                                                        <label for="checkboxPrimary4">
                                                        Blog
                                                        </label>
                                                    </div>
                                                     <div class="icheck-primary">
                                                        <input type="checkbox" name="general" value="1" v-model="form.general" id="checkboxPrimary5">
                                                        <label for="checkboxPrimary5">
                                                        General
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" name="home" value="1" v-model="form.home" id="checkboxPrimary6">
                                                        <label for="checkboxPrimary6">
                                                        Home
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" name="payment" value="1" v-model="form.payment"  id="checkboxPrimary7">
                                                        <label for="checkboxPrimary7">
                                                        Payment
                                                        </label>
                                                    </div>
                                                     <div class="icheck-primary">
                                                        <input type="checkbox" name="stuff" value="1" v-model="form.stuff" id="checkboxPrimary8">
                                                        <label for="checkboxPrimary8">
                                                        Stuff
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" name="order_manage" value="1" v-model="form.order_manage" id="checkboxPrimary9">
                                                        <label for="checkboxPrimary9">
                                                        Order
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" name="customer" value="1" v-model="form.customer"  id="checkboxPrimary10">
                                                        <label for="checkboxPrimary10">
                                                        Customer
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addNewStuff()">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name : "New",
    data () {
        return {
            someStyle: {
                fontSize: '10px',
            },
            form: new Form({
                name: '',
                email: '',
                contact: '',
                password: '',
                confirm_password: '',
                role: '',
                category: '',
                product: '',
                coupon: '',
                blog: '',
                general: '',
                home: '',
                payment: '',
                stuff: '',
                order_manage: '',
                customer: ''
            })
        }
    },
    methods: {
        addNewStuff () {
            this.form.post('/add/new/stuff')
            .then(({ response }) => {
                this.$router.push('/stuff-list');

                toast.fire({
                    icon: 'success',
                    title: 'Stuff Added successfully'
                })

            })
            .catch(()=>{
                toast.fire({
                    icon: 'error',
                    text: 'Email Exists / Password Not Matched',
                })
            })
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
