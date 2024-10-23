<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Send SMS</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="CategoryID">Select Customer</label>
                                        
                                        <select v-model="form.user_ids" class="form-control" style="width: 100%">
                                            <option v-for="(data, i) in allData" :value="data.id"> {{ data.name }} </option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile_number" class="col-md-12 col-form-label">Recipent(Type Your Number Without 0)<span class='text-danger'></span></label>
                                        <div class="col-md-3"> <input name="mobile_code" value="+880" class="form-control" readonly> </div>
                                        <div class="col-md-9"> <input v-model="form.mobile_number" placeholder="17xxxxx" class="form-control"> </div>

                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" class="" v-model="form.all_customers"> All Customer
                                    </div>
                                    <div class="form-group">
                                    <label for="message" class="col-form-label">Message (Max 160 characters)<span class='text-danger'>*</span></label>
                                    <textarea v-model="form.message" id="message" class="form-control" rows="5" maxlength="160" placeholder="Type message (maxmimun 160 characters)"></textarea>
                                    
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addSms()">Submit</button>
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
            form: new Form({
                mobile_number: '',
                message: '',
                all_customers: '',
                user_ids: []
            }),
            allData: []
        }
    },
    created() {
        axios
                .get('AllCustomers')
                .then(response => {
                    console.log(response.data)
                    this.allData = response.data
                });
    },
    methods: {
       
        addSms () {
            this.form.post('/sendsms', this.form)
            .then(({ response }) => {
                // this.$router.push('/category-list');

                toast.fire({
                    icon: 'success',
                    title: 'Category Added successfully'
                })

            })
            .catch(()=>{
                console.log('Error cateched')
            })
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
