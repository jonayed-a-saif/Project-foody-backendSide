<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> User Account <i :style="someStyle" class="fas fa-chevron-right"></i> Change Password </h6>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="new">New Password</label>
                                        <input type="password" class="form-control" id="new" placeholder="New Password" v-model="form.new" name="new" :class="{ 'is-invalid': form.errors.has('new') }">
                                        <has-error :form="form" field="new"></has-error>
                                    </div>

                                     <div class="form-group">
                                        <label for="confirm">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm" placeholder="Confirm Password" v-model="form.confirm" name="confirm" :class="{ 'is-invalid': form.errors.has('confirm') }">
                                        <has-error :form="form" field="confirm"></has-error>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="changePassword()">Change</button>
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
                new: '',
                confirm : ''
            })
        }
    },
    methods: {
        changePassword () {
            this.form.post('/change/your/password')
            .then(({ response }) => {
                this.$router.push('/home');

                toast.fire({
                    icon: 'success',
                    title: 'Password Changed Successfully'
                })

            })
            .catch(()=>{
                toast.fire({
                    icon: 'error',
                    text: 'Confirm Password Does Not Match',
                })
            })
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
