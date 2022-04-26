<template>
     <div id="content" class="col-lg-10 col-sm-10">
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2 style="font-family:'Kalpurush';"><i class=" 	glyphicon glyphicon-th"></i>
                            ব্যাংক শাখার তালিকা</h2>
                    </div>


                    <div class="">
                        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#globalModal"
                                style="float:right;margin:10px;" @click="Add()"><i class="glyphicon glyphicon-plus"></i>
                            যোগ করুন
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-content">
                        <LegthMenu url="/bank_branch"></LegthMenu>
                        <SearchTableData url="/bank_branch"></SearchTableData>
                        <baseTable :tableid="'bank_branch_table'" :TableColumn="table.columns" :TableUrl="'/bank_branch'">
                            <tbody v-if="table.data.length > 0">
                                <tr v-for=" (item, index) in table.data" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td></td>
                                    <td>{{ item.department }}</td>
                                    <td>{{ item.designation }}</td>
                                    <td class="center">
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#departmentEditModal" @click="edit(index)">
                                            <i class="glyphicon glyphicon-edit icon-white"></i>
                                            সম্পাদন
                                        </button>
                                        <button class="btn btn-danger btn-sm" @click="destroy(item.id)">
                                            <i class="glyphicon glyphicon-trash icon-white"></i>
                                            ডিলিট
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else :TableColumn="table.columns">
                                <tr>
                                    <td :colspan="table.columns.length"><h6 style="text-align:center">কোন তথ্য পাওয়া যায়
                                        নাই</h6></td>
                                </tr>
                            </tbody>
                        </baseTable>

                        <pagination url="/department"></pagination>

                    </div>


                    <Modal title="বিভাগ এবং পদবী যোগ করুন" type="modal-md">
                        <form action="#" @submit.prevent="InsertOrUpdate()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="department">বিভাগ : </label>
                                        <select type="text" value="" class="form-control"
                                                v-model="fromData.department_id">
                                            <option value="">select</option>
                                            <option v-for="(item,index) in department_list" :key="index"
                                                    :value="item.id">{{ item.department }}
                                            </option>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="name">নাম : </label>
                                        <input type="text" v-model="fromData.name" class="form-control"
                                               placeholder="নাম প্রদান করুন">
                                        <span class="text-danger">{{ validation.firstError('fromData.name') }}</span>

                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" ref="modalClose" class="btn btn-warning" data-dismiss="modal">
                                    Close
                                </button>
                            </div>

                        </form>
                    </Modal>


                    <EditModal title="বিভাগ এবং পদবী আপডেট করুন" :id="'departmentEditModal'" type="modal-md">
                        <form action="#" @submit.prevent="InsertOrUpdate()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="department">বিভাগ : </label>
                                        <select type="text" value="" class="form-control"
                                                v-model="fromData.department_id">
                                            <option value="">select</option>
                                            <option v-for="(item,index) in department_list" :key="index"
                                                    :value="item.id">{{ item.department }}
                                            </option>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="name">নাম : </label>
                                        <input type="text" v-model="fromData.name" class="form-control"
                                               placeholder="নাম প্রদান করুন">
                                        <span class="text-danger">{{ validation.firstError('fromData.name') }}</span>

                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" ref="EditmodalClose" class="btn btn-warning" data-dismiss="modal">
                                    Close
                                </button>
                            </div>

                        </form>
                    </EditModal>


                </div>
            </div>
            <!--/span-->
        </div>


    </div>
</template>

<script>
const tableColumns = [
    {field: "নং", title: "No"},
    {field: "জেলা", title: "জেলা"},
    {field: "ব্যাংক", title: "ব্যাংক"},
    {field: "শাখা নাম", title: "শাখা নাম"},
    {field: "আ্যকশান", title: "আ্যকশান"}
];

export default {
    name:"BankBranch",
     data() {
        return {
            fromData: {
                department_id: '',
                name: '',
                rowId: ''
            },
            table: {
                model: "Department",
                columns: tableColumns,
                data: [],
                routes: [],
                paginateData: {
                    totalPage: 0,
                    currentPage: 1
                }
            }

        }
    },
    validators: {
        'fromData.name': function (value) {
            return Validator.value(value).required("নাম প্রদান করুন");
        },
    },
    computed: {
        department_list() {
            return SettingVeux.getters.get_department_list;
        }
    },

    methods: {
        Add() {
            this.reset();
        },
        InsertOrUpdate() {
            this.$validate().then((res) => {
                if (res) {
                    axios.post('/department', this.fromData)
                        .then((response) => {

                            this.list_data();

                            if (this.fromData.rowId) {
                                this.$refs.EditmodalClose.click();
                            } else {
                                this.$refs.modalClose.click();
                            }


                            Swal.fire('সফল', response.data.message, 'success')

                        })
                        .catch((error) => {
                            Swal.fire('ব্যর্থ', 'কোন সমস্যা আছে', 'error')
                        })
                }
            });
        },
        async list_data() {
            let department_data = await SettingVeux.dispatch('setDepartmentData');
            this.table.data = SettingVeux.state.designation_data;
            this.table.paginateData.totalPage = department_data.last_page
        },
        edit(index) {
            let single_data = SettingVeux.state.designation_data[index];
            this.fromData.name = (single_data.parent_id == null) ? single_data.department : single_data.designation;
            this.fromData.department_id = (single_data.parent_id != null) ? single_data.parent_id : "";
            this.fromData.rowId = single_data.id;


        },
        async destroy(rowId) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete  this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/department/delete/' + rowId)
                        .then((response) => {
                            this.list_data();
                            Swal.fire('সফল', response.data.message, 'success')
                        })
                }
            })

        },

        reset() {
            this.fromData.name = '';
            this.fromData.department_id = '';
            this.fromData.rowId = '';
        }

    },
    mounted() {
        this.list_data();
    }
};
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
</style>
