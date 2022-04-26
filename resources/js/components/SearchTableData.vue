<template>
    <div class="filter">
        <input type="search" v-model="search_data.search_item" class="form-control" placeholder="search..."
               aria-controls="example" ></div>
</template>

<script>
export default {
    name: "SearchTableData",
    data() {
        return {
            search_data: {
                field_name: 0,
                search_item: ""
            },
        }
    },
    props: ['url'],
    methods: {

    },
    watch:{
        'search_data.search_item'(search_item){
            let url = this.url+ '?page='+ this.$parent.table.paginateData.currentPage;
            axios.get(url,{params:{search_item}}).then((response) => {
                this.$parent.table.data = response.data.data;
                this.$parent.table.paginateData.totalPage = response.data.last_page;
            })
        }
    }
}
</script>

<style scoped>
.filter {
    width: 20%;
    float: right;
    margin: 5px;
}
</style>
