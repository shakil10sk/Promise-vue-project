<template>
    <div id="content" class="col-lg-10 col-sm-10">
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2 style="font-family:'Kalpurush';"><i class=" 	glyphicon glyphicon-th"></i>
                            কর্মচারীর কোটার তালিকা</h2>
                    </div>


                    <div class="">
                        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#globalModal"
                                style="float:right;margin:10px;" @click="Add()"><i class="glyphicon glyphicon-plus"></i>
                            যোগ করুন
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-content">
                        <LegthMenu url="/employee/quota"></LegthMenu>
                        <SearchTableData url="/employee/quota"></SearchTableData>
                        <baseTable :tableid="'department_table'" :TableColumn="table.columns" :TableUrl="'/department'">
                            <tbody v-if="table.data.length > 0">
                            <tr v-for=" (item, index) in table.data" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.municipility_class }}</td>
                                <td>{{ item.designation.name }}</td>
                                <td>{{ item.total_quota }} জন</td>
                                <td class="center">
                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#EmployeeQuotaEditModal" @click="edit(index)">
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

                        <pagination url="/employee/quota"></pagination>

                    </div>


                    <Modal title="যোগ করুন" type="modal-md">
                        <form action="#" @submit.prevent="InsertOrUpdate()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="department">পৌরসভা শ্রেণী : </label>
                                        <select type="text" value="" class="form-control"
                                                v-model="formData.municipility_class">
                                            <option value="">select</option>
                                            <option value="1">ক</option>
                                            <option value="2">খ</option>
                                            <option value="3">গ</option>
                                        </select>
                                        <span class="text-danger">{{
                                                validation.firstError('formData.municipility_class')
                                            }}</span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="department">পদবী : </label>
                                        <select type="text" value="" class="form-control"
                                                v-model="formData.designation_id">
                                            <option value="">select</option>
                                            <option v-for="(item,index) in designation_list" :key="index"
                                                    :value="item.id">{{ item.designation }}
                                            </option>

                                        </select>
                                        <span class="text-danger">{{
                                                validation.firstError('formData.designation_id')
                                            }}</span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="name">কোটার সংখ্যা : </label>
                                        <input type="text" v-model.number="formData.total_quota" class="form-control"
                                               placeholder="কোটার সংখ্যা প্রদান করুন">
                                        <span class="text-danger">{{
                                                validation.firstError('formData.total_quota')
                                            }}</span>

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


                    <EditModal title="আপডেট করুন" :id="'EmployeeQuotaEditModal'" type="modal-md">
                        <form action="#" @submit.prevent="InsertOrUpdate()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="department">পৌরসভা শ্রেণী : </label>
                                        <select type="text" value="" class="form-control"
                                                v-model="formData.municipility_class">
                                            <option value="">select</option>
                                            <option value="1">ক</option>
                                            <option value="2">খ</option>
                                            <option value="3">গ</option>
                                        </select>
                                        <span class="text-danger">{{
                                                validation.firstError('formData.municipility_class')
                                            }}</span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="department">পদবী : </label>
                                        <select type="text" value="" class="form-control"
                                                v-model="formData.designation_id">
                                            <option value="">select</option>
                                            <option v-for="(item,index) in designation_list" :key="index"
                                                    :value="item.id">{{ item.designation }}
                                            </option>

                                        </select>
                                        <span class="text-danger">{{
                                                validation.firstError('formData.designation_id')
                                            }}</span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="name">কোটার সংখ্যা : </label>
                                        <input type="text" v-model.number="formData.total_quota" class="form-control"
                                               placeholder="কোটার সংখ্যা প্রদান করুন">
                                        <span class="text-danger">{{
                                                validation.firstError('formData.total_quota')
                                            }}</span>

                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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
    {field: "পৌরসভা শ্রেণী", title: "পৌরসভা শ্রেণী"},
    {field: "পদবী", title: "পদবী"},
    {field: "মোট কোটার সংখ্যা", title: "মোট কোটার সংখ্যা"},
    {field: "আ্যকশান", title: "আ্যকশান"}
];

export default {
    name: "Department",
    data() {
        return {
            formData: {
                municipility_class: '',
                designation_id: '',
                total_quota: '',
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
        'formData.municipility_class': function (value) {
            return Validator.value(value).required("পৌরসভা শ্রেণী সিলেক্ট করুন");
        },
        'formData.designation_id': function (value) {
            return Validator.value(value).required("পদবী সিলেক্ট করুন");
        },
        'formData.total_quota': function (value) {
            return Validator.value(value).required("কোটার সংখ্যা প্রদান করুন");
        },
    },
    computed: {
        designation_list() {
            return SettingVeux.getters.get_designation_list;
        }
    },
    methods: {
        Add() {
            this.reset();
        },
        InsertOrUpdate() {
            this.$validate().then((res) => {
                if (res) {
                    axios.post('/employee/quota', this.formData)
                        .then((response) => {

                            this.list_data();

                            this.modalClose();

                            Swal.fire('সফল', response.data.message, 'success')

                        }).catch((error) => {
                        this.modalClose();
                        Swal.fire('ব্যর্থ', error.response.data.message, 'error')
                    })
                }
            });
        },
        async list_data() {
            await axios.get('/employee/quota')
                .then((response) => {
                    this.table.data = response.data.data;
                    this.table.paginateData.totalPage = response.data.last_page

                })

        },
        edit(index) {
            let single_data = this.table.data[index];
            this.formData.municipility_class = this.getMunicipilityClass(single_data.municipility_class);
            this.formData.designation_id = single_data.designation_id;
            this.formData.total_quota = single_data.total_quota;
            this.formData.rowId = single_data.id;

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
                    axios.get('/employee/quota/delete/' + rowId)
                        .then((response) => {

                            this.list_data();
                            Swal.fire('সফল', response.data.message, 'success')
                        })
                }
            })

        },
        getMunicipilityClass($class) {
            if ($class == "ক") {
                return 1
            } else if ($class == "খ") {
                return 2;
            } else {
                return 3;
            }
        },
        reset() {
            this.formData.municipility_class = '';
            this.formData.designation_id = '';
            this.formData.total_quota = '';
            this.formData.rowId = '';
        },
        modalClose() {
            if (this.formData.rowId) {
                this.$refs.EditmodalClose.click();
            } else {
                this.$refs.modalClose.click();
            }
        }

    },
    mounted() {
        this.list_data();
        SettingVeux.dispatch('setDepartmentData')
    }
};
</script>

<style scoped>

</style>
