<template>
    <div id="content" class="col-lg-10 col-sm-10">
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2 style="font-family:'Kalpurush';"><i class="glyphicon glyphicon-th"></i>
                            বিভাগ এবং জেলার তালিকা</h2>
                    </div>

                    <div class="">
                        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#globalModal"
                                style="float:right;margin:10px;" @click="Add()"><i class="glyphicon glyphicon-plus"></i>
                            যোগ করুন
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-content">
                        <LegthMenu url="/location"></LegthMenu>
                        <SearchTableData url="/location"></SearchTableData>
                        <baseTable :tableid="'location_table'" :TableColumn="table.columns"
                                   :TableUrl="'/bdlocation/list_data'">

                            <tbody v-if="table.data.length > 0">
                            <tr v-for=" (item, index) in table.data" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.division }}</td>
                                <td>{{ item.district }}</td>
                                <td class="center">
                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#locationEditModal" @click="edit(index)">
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
                        <pagination url="/location"></pagination>
                    </div>

                    <Modal title="নতুন লোকেশন যোগ করুন" type="modal-md">
                        <form action="#" @submit.prevent="InsertOrUpdate()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="division_id">বিভাগ : </label>
                                        <select type="text" id="division_id" value="" class="form-control"
                                                v-model="fromData.division_id">
                                            <option value="">বিভাগ নির্বাচন করুণ</option>
                                            <option v-for="(item,index) in location_lists" :key="index"
                                                    :value="item.id">{{ item.division }}
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

                    <EditModal title="বিভাগ এবং জেলা আপডেট করুন" :id="'locationEditModal'" type="modal-md">
                        <form action="#" @submit.prevent="InsertOrUpdate()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="department">বিভাগ : </label>
                                        <select type="text" value="" class="form-control"
                                                v-model="fromData.division_id">
                                            <option value="">select</option>
                                            <option v-for="(item,index) in location_lists" :key="index"
                                                    :value="item.id">{{ item.division }}
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
    {field: "বিভাগ", title: "বিভাগ"},
    {field: "জেলা", title: "জেলা"},
    {field: "আ্যকশান", title: "আ্যকশান"}
];

export default {
    name: "BDLocation",
    data() {
        return {
            fromData: {
                division_id: '',
                name: '',
                rowId: ''
            },
            table: {
                model: "Location",
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
    methods: {
        Add() {
            this.reset();
        },
        InsertOrUpdate() {
            this.$validate().then((res) => {
                if (res) {
                    axios.post('/location', this.fromData)
                        .then((response) => {

                            this.list_data();

                            if (this.fromData.rowId) {
                                this.$refs.EditmodalClose.click();
                            } else {
                                this.$refs.modalClose.click();
                            }

                            this.reset();

                            Swal.fire('সফল', response.data.message, 'success')

                        })
                        .catch((error) => {
                            console.log(error);
                            Swal.fire('ব্যর্থ', 'কোন সমস্যা আছে', 'error')
                        })
                }
            });
        },
        async list_data() {
            let location_data = await SettingVeux.dispatch('setLocationData');
            this.table.data = SettingVeux.state.location_data;
            this.table.paginateData.totalPage = location_data.last_page
        },
        edit(index) {
            let single_data = SettingVeux.state.location_data[index];
            this.fromData.name = (single_data.parent_id == null) ? single_data.division : single_data.district;
            this.fromData.division_id = (single_data.parent_id != null) ? single_data.parent_id : "";
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
                    axios.get('/location/delete/' + rowId)
                        .then((response) => {
                            this.list_data();
                            Swal.fire('সফল', response.data.message, 'success')
                        })
                }
            })

        },
        reset() {
            this.fromData.name = '';
            this.fromData.division_id = '';
            this.fromData.rowId = '';
        }

    },
    mounted() {
        this.list_data();
    },
    computed: {
        location_lists() {
            let item = [];
            this.table.data.forEach(element => {
                if (element.parent_id == null && element.type == 1) {
                    item.push(element);
                }
            });
            return item;
        }
    }
};
</script>
