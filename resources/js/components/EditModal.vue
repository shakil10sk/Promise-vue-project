<template>
    <div class="modal fade " :id="id" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" :class="type">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-family:'Kalpurush';" id="myModalLabel">{{title}}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <slot></slot>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditModal",
    props: ['title', 'id','type'],
    data() {
        return {
            showModal: true,
        }
    },
    methods:{
        show() {
            this.showModal = true;
        },
        hide(){
            this.showModal = false;
        }
    }
}
</script>

<style scoped>

</style>
