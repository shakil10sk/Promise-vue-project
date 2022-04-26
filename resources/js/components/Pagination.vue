<template>
    <div class="pagination" style="float: right">
        <a v-if="$parent.table.paginateData.currentPage > 1" style="cursor: pointer"  @click="PaginatePreviousePage()">&laquo;</a>
        <a :class="{ 'active-item':$parent.table.paginateData.currentPage == pageNo }" style="cursor: pointer"
           v-for="(pageNo,index) in $parent.table.paginateData.totalPage"
           :key="index" @click="get_pagination_data(pageNo)">{{ pageNo }}</a>
        <a v-if="$parent.table.paginateData.currentPage < $parent.table.paginateData.totalPage" style="cursor: pointer"
           @click="PaginateNextPage()">&raquo;</a>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: ['url'],
    methods: {
        get_pagination_data(pageNo = 1) {
            let url = this.url + "?page=" + pageNo;
            this.$parent.table.paginateData.currentPage = pageNo;
            axios.get(url).then((response) => {
                this.$parent.table.data = response.data.data;
                this.$parent.table.paginateData.totalPage = response.data.last_page;
            })
        },
        PaginatePreviousePage() {
            this.$parent.table.paginateData.currentPage--;
            this.get_pagination_data(this.$parent.table.paginateData.currentPage);
        },
        PaginateNextPage() {
            this.$parent.table.paginateData.currentPage++;
            this.get_pagination_data(this.$parent.table.paginateData.currentPage);
        },
    }
}


</script>

<style scoped>
.pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
}

.active-item {
    color: #040404;
    background: #63cdd2;
}

</style>
