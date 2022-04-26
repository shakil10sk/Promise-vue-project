<template>
    <div>
        <table :id="Tableid" class="data-table table table-striped table-bordered table-hover responsive nowrap"
               cellspacing="0" width="100%">
            <thead>
            <tr>
                <th v-for="(column,key) in TableColumn" :key="key">{{ column.field }}</th>
            </tr>
            </thead>
            <slot></slot>
        </table>
    </div>
</template>

<script>


export default {
    name: "BaseTable",
    props: {
        Tableid:{
            type: String,
        },
        TableColumn: {
            type: Array,
            default: () => [],
            description: "Table column"
        },
        TableUrl:{
            type:String,
            default: () => '',
            description: "Table data url"
        }
    },
    methods: {


    },

}
</script>

<style scoped>

</style>
