<template>
        <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Home Category</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="CategoryID">New Home Category Name</label>
                                        <input type="text" class="form-control" id="CategoryID" placeholder="Enter Home Category Name" v-model="form.category_name" name="category_name" :class="{ 'is-invalid': form.errors.has('category_name') }">
                                        <has-error :form="form" field="category_name"></has-error>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="start_time">Start Time</label>
                                        <datetime format="YYYY-MM-DD h:i:s" placeholder="Start time"  v-model="form.start_time" name="start_time"></datetime>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="end_time">End Time</label>
                                        <datetime format="YYYY-MM-DD h:i:s" placeholder="End time"  v-model="form.end_time" name="end_time"></datetime>
                                        
                                    </div>
                                  
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addCategory()">Submit</button>
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
    import datetime from 'vuejs-datetimepicker';
export default {
    
    name : "New",
    components: { datetime },
    data () {
        return {
            form: new Form({
                category_name: '',
                start_time: '',
                end_time: '',
            })
        }
    },
    methods: {
        addCategory () {
            this.form.post('/add/new/home/category')
            .then(({ response }) => {
                this.$router.push('/home-category-list');

                toast.fire({
                    icon: 'success',
                    title: 'HomeCategory Added successfully'
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
