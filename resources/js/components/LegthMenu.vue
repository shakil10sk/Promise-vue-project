<template>
    <div class="dataTables_length" id="data_tbl_length">
        <label>Show
            <select name="data_tbl_length" aria-controls="data_tbl" v-model="limit" @change="change_page_data_length()" class="form-control form-control-sm">
                <option value="10" >10</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
                <option value="-1">All</option>
            </select> entries</label>
    </div>
</template>

<script>
export default {
    name: "SearchTableData",
    data() {
        return {
           limit:'10'
        }
    },
    props: ['url'],
    methods: {
        change_page_data_length(){

            if (this.limit){
               let url = this.url+'?limit='+this.limit;
                axios.get(url).then((response) => {
                    this.$parent.table.data = response.data.data;
                    this.$parent.table.paginateData.totalPage = response.data.last_page;
                })
            }

        }
    },
}
</script>

<style scoped>
    #data_tbl_length{
        float: left;
    }
    #data_tbl_length label {
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
        margin: 0;
    }
    div.dataTables_length select {
        width: 75px;
        height: 38px !important;
        display: inline-block;
    }
</style>
