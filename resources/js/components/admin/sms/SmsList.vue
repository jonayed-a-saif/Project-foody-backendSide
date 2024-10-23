<template>
    <div class="container"> 
       
        <div class="mt-4"> 
            <router-link class="btn btn-info" to="/newProkolpoForm" ><i class="fa fa-plus"> </i>  নতুন প্রকল্প</router-link> 
        </div>
        <h4 class="text-info text-center mt-2 mb-2"> সকল প্রকল্পের লিস্ট </h4>
        <p class="text-danger text-center mt-2 d-none" v-if="allData.length == 0"> কোনো প্রকল্প পাওয়া যায় নাই!</p>
        <table class="table table-striped">
            <tr>
                <th> SL </th>
                <th> Name </th>
                <th> Action </th>
            </tr>
            <tbody>
                <tr v-for="(prokolpo, index) in allData" :key="prokolpo.id">
                    <th>{{ (index+1) }} </th>
                    <th>{{ prokolpo.prokolpo_name }}</th>
                    <th> 
                        <router-link :to="{ name: 'viewProkolpo', params: { id: prokolpo.id }}"  class="btn btn-info mr-2" > <i class="fa fa-file"></i> </router-link> 
                        <router-link :to="{ name: 'editProkolpo', params: { id: prokolpo.id }}"  class="btn btn-success mr-2" > <i class="fa fa-pencil"></i> </router-link> 
                        <button @click="deleteProkolpo(prokolpo.id)" class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                          
                    </th>
                </tr>
            </tbody>
        </table>
        

    </div>
</template>
 
<script>

    export default {
        created() {
            
            this.axios
                .get('AllSms/')
                .then(response => {
                    console.log(response.data)
                    this.allData = response.data
                });
                
        },
        data() {
            return {
                allData: [],
                isLogged: false
            } 
        },
        methods: {
            deleteProkolpo(id)
            {
                var result = confirm("Want to delete?");
                if (result) {
                    //Logic to delete the item
                    this.axios
                    .delete('api/prokolpo/deleteProkolpo/'+id)
                    .then(response => {
                        // console.log(response.data)
                        let i = this.allData.map(item => item.id).indexOf(id) // find index of object
                        this.allData.splice(i, 1)
                    })
                }
                
            }
        }
    }
</script>

<style>
navbar-collapse {
    background-color: #e3f2fd;
}
</style>