<template>
    <div id="content" class="col-lg-10 col-sm-10">
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2 style="font-family:'Kalpurush';"><i class="glyphicon glyphicon-th"></i>
                            পৌরসভার তালিকা</h2>
                    </div>


                    <div class="">
                        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#globalModal"
                                style="float:right;margin:10px;" @click="Add()"><i class="glyphicon glyphicon-plus"></i>
                            যোগ করুন
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-content">
                        <LegthMenu url="/municipility"></LegthMenu>
                        <SearchTableData url="/municipility"></SearchTableData>
                        <baseTable :tableid="'municipility_table'" :TableColumn="table.columns"
                                   :TableUrl="'/municipility'">
                            <tbody v-if="table.data && table.data.length > 0">
                            <tr v-for=" (item, index) in table.data" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ item.division.name }}</td>
                                <td>{{ item.district.name }}</td>
                                <td>{{ item.estabilish_year }}</td>
                                <td>{{ item.fax }}</td>
                                <td>{{ item.status }}</td>
                                <td>{{ item.class }}</td>
                                <td class="center">
                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#municipilityEditModal" @click="edit(index)">
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

                        <pagination url="/municipility"></pagination>

                    </div>


                    <Modal title="পৌরসভা যোগ করুন" type="modal-md">

                        <div class="modal-body">
                            <div class="form-group">
                                <form action="#" @submit.prevent="InsertOrUpdate()" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="division_id">বিভাগ : </label>
                                                <select type="text" value="" class="form-control"
                                                        v-model="formData.division_id"
                                                        @change="getDistrictData($event)">
                                                    <option value="">সিলেক্ট করুন</option>
                                                    <option v-for="(item,index) in division_list" :key="index"
                                                            :value="item.id">{{ item.division }}
                                                    </option>
                                                </select>
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.division_id')
                                                    }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="district_id">জেলা : </label>
                                                <select type="text" value="" class="form-control"
                                                        v-model="formData.district_id">
                                                    <option value="">সিলেক্ট করুন</option>
                                                    <option v-for="(item,index) in district_data" :key="index"
                                                            :value="item.id">{{ item.district }}
                                                    </option>
                                                </select>
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.district_id')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">নাম : </label>
                                                <input type="text" v-model="formData.name" class="form-control"
                                                       placeholder="পৌরসভার নাম প্রদান করুন">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.name')
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="code">কোড : </label>
                                                <input type="text" v-model="formData.code" class="form-control"
                                                       placeholder="পৌরসভার কোড প্রদান করুন">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.code')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="logo">লোগো : </label>
                                                <input type="file" @change="upload_logo" class="form-control"
                                                       placeholder="পৌরসভার লোগো প্রদান করুন" accept="image/*">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.logo')
                                                    }}</span>

                                                <div class="avatar img-fluid img-circle" style="margin-top:10px">
                                                    <img :src="formData.logo" :style="styleObject"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="class">শ্রেণী নির্বাচন করুন : </label>
                                                <select type="text" value="" class="form-control"
                                                        v-model="formData.class">
                                                    <option value="">শ্রেণী নির্বাচন করুন</option>
                                                    <option value="1">ক</option>
                                                    <option value="2">খ</option>
                                                    <option value="3">গ</option>
                                                </select>
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.class')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="email">ইমেইল : </label>
                                                    <input type="text" v-model="formData.email" class="form-control"
                                                           placeholder="পৌরসভা ইমেইল প্রদান করুন">
                                                    <span class="text-danger">{{
                                                            validation.firstError('formData.email')
                                                        }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="website">ওয়েবসাইট : </label>
                                                <input type="text" v-model="formData.website" class="form-control"
                                                       placeholder="পৌরসভা ওয়েবসাইট প্রদান করুন">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.website')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="fax">ফাক্স নম্বার : </label>
                                                    <input type="text" v-model="formData.fax" class="form-control"
                                                           placeholder="ফাক্স নম্বার প্রদান করুন">
                                                    <span class="text-danger">{{
                                                            validation.firstError('formData.fax')
                                                        }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="estabilish_year">স্থাপত্য বছর : </label>
                                                <input type="text" v-model="formData.estabilish_year"
                                                       class="form-control"
                                                       placeholder="স্থাপত্য বছর প্রদান করুন">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.estabilish_year')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" ref="modalClose" class="btn btn-warning"
                                                data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </Modal>

                    <EditModal title="পৌরসভা আপডেট করুন" :id="'municipilityEditModal'" type="modal-md">
                        <div class="modal-body">
                            <div class="form-group">
                                <form action="#" @submit.prevent="InsertOrUpdate()" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="division_id">বিভাগ নির্বাচন করুন : </label>
                                                <select type="text" value="" class="form-control"
                                                        v-model="formData.division_id" ref="district"
                                                        @change="getDistrictData($event.target.value)">
                                                    <option v-for="(item,index) in division_list" :key="index"
                                                            :value="item.id">{{ item.division }}
                                                    </option>
                                                </select>
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.division_id')
                                                    }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="district_id">জেলা নির্বাচন করুণ : </label>
                                                <select type="text" value="" class="form-control"
                                                        v-model="formData.district_id">
                                                    <option v-for="(item,index) in district_data" :key="index"
                                                            :value="item.id"
                                                            :selected="item.id == formData.district_id ? true : false">
                                                        {{ item.district }}
                                                    </option>
                                                </select>
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.district_id')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">নাম : </label>
                                                <input type="text" v-model="formData.name" class="form-control"
                                                       placeholder="পৌরসভার নাম প্রদান করুন">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.name')
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="code">কোড : </label>
                                                <input type="text" v-model="formData.code" class="form-control"
                                                       placeholder="পৌরসভার কোড প্রদান করুন">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.code')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="logo">লোগো : </label>
                                                <input type="file" @change="upload_logo" class="form-control"
                                                       placeholder="পৌরসভার লোগো প্রদান করুন" accept="image/*">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.logo')
                                                    }}</span>

                                                <div class="avatar img-fluid img-circle" style="margin-top:10px">
                                                    <img :src="formData.logo" v-bind:style="styleObject"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="class">শ্রেণী নির্বাচন করুন : </label>
                                                <select type="text" value="" class="form-control"
                                                        v-model="formData.class">
                                                    <option value="">শ্রেণী নির্বাচন করুন</option>
                                                    <option value="1">ক</option>
                                                    <option value="2">খ</option>
                                                    <option value="3">গ</option>
                                                </select>
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.class')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="email">ইমেইল : </label>
                                                    <input type="text" v-model="formData.email" class="form-control"
                                                           placeholder="পৌরসভা ইমেইল প্রদান করুন">
                                                    <span class="text-danger">{{
                                                            validation.firstError('formData.email')
                                                        }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="website">ওয়েবসাইট : </label>
                                                <input type="text" v-model="formData.website" class="form-control"
                                                       placeholder="পৌরসভা ওয়েবসাইট প্রদান করুন">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.website')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="fax">ফাক্স নম্বার : </label>
                                                    <input type="text" v-model="formData.fax" class="form-control"
                                                           placeholder="ফাক্স নম্বার প্রদান করুন">
                                                    <span class="text-danger">{{
                                                            validation.firstError('formData.fax')
                                                        }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="estabilish_year">স্থাপত্য বছর : </label>
                                                <input type="text" v-model="formData.estabilish_year"
                                                       class="form-control"
                                                       placeholder="স্থাপত্য বছর প্রদান করুন">
                                                <span class="text-danger">{{
                                                        validation.firstError('formData.estabilish_year')
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" ref="EditmodalClose" class="btn btn-warning"
                                                data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
    {field: "নাম", title: "নাম"},
    {field: "ইমেইল", title: "ইমেইল"},
    {field: "বিভাগ", title: "বিভাগ"},
    {field: "জেলা", title: "জেলা"},
    {field: "স্থাপত্য বছর", title: "স্থাপত্য বছর"},
    {field: "ফাক্স নম্বার", title: "ফাক্স নম্বার"},
    {field: "স্ট্যাটাস", title: "স্ট্যাটাস"},
    {field: "শ্রেণী", title: "শ্রেণী"},
    {field: "আ্যকশান", title: "আ্যকশান"}
];

export default {
    name: "Municipility",
    data() {
        return {
            formData: {
                name: '',
                code: '',
                logo: '',
                division_id: '',
                district_id: '',
                estabilish_year: '',
                email: '',
                website: '',
                fax: '',
                class: '',
                status: '',
                rowId: '',
                previous_logo: '',
            },
            styleObject: {
                width: '100px',
                height: '100px'
            },
            location_data: [],
            district_data: [],
            table: {
                model: "municipility",
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
        'formData.name': function (value) {
            return Validator.value(value).required("পৌরসভার নাম প্রদান করুন");
        },
        'formData.email': function (value) {
            return Validator.value(value).required('ইমেইল প্রদান করুন').email("সঠিক ইমেইল প্রদান করুন");
        },
        'formData.division_id': function (value) {
            return Validator.value(value).required("বিভাগ নির্বাচন করুন").digit();
        },
        'formData.district_id': function (value) {
            return Validator.value(value).required("জেলা নির্বাচন করুন").digit();
        },
        'formData.class': function (value) {
            return Validator.value(value).required("পৌরসভার শ্রেণী নির্বাচন করুন").digit();
        },
        'formData.estabilish_year': function (value) {
            return Validator.value(value).required("পৌরসভা স্থাপিত বছর প্রদান করুন").digit();
        },
    },
    computed: {
        division_list() {
            return SettingVeux.getters.get_division_list;
        },
    },

    methods: {
        Add() {
            this.formData.logo = this.$root.asset_url + '/img/defaultimage.png';
            this.reset();
        },

        getDistrictData() {
            let parent_id = Boolean(this.formData.division_id) ? this.formData.division_id : event.target.value;
            this.district_data = this.location_data.filter(function (item) {
                return item.parent_id == parent_id && item.type == 2;
            })
        },
        InsertOrUpdate() {
            this.$validate().then((res) => {
                if (res) {
                    axios.post('/municipility', this.formData)
                        .then((response) => {

                            this.list_data();
                            this.modalClose();

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
            let municipility_data = await SettingVeux.dispatch('setmunicipilityData');
            this.table.data = SettingVeux.state.municipility_data;
            this.table.paginateData.totalPage = municipility_data.last_page;
        },
        async locationData() {
            await SettingVeux.dispatch('setLocationData');
            this.location_data = SettingVeux.state.location_data;
        },
        async edit(index) {

            let single_data = SettingVeux.state.municipility_data[index];
            this.formData.name = single_data.name;
            this.formData.code = single_data.code;
            this.formData.previous_logo = single_data.logo;

            this.formData.division_id = single_data.division_id;
            await this.getDistrictData();
            this.formData.district_id = single_data.district_id;

            this.formData.estabilish_year = single_data.estabilish_year;
            this.formData.email = single_data.email;
            this.formData.website = single_data.website;
            this.formData.fax = single_data.fax;
            this.formData.logo = this.$root.asset_url + '/img/' + single_data.logo;
            this.formData.status = single_data.status;
            this.formData.class = single_data.class;
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
                    axios.get('/municipility/delete/' + rowId)
                        .then((response) => {
                            this.list_data();
                            Swal.fire('সফল', response.data.message, 'success')
                        })
                }
            })
        },
        reset() {
            this.formData.name = '';
            this.formData.code = '';
            this.formData.division_id = '';
            this.formData.district_id = '';
            this.formData.estabilish_year = '';
            this.formData.email = '';
            this.formData.website = '';
            this.formData.fax = '';
            this.formData.class = '';
            this.formData.rowId = '';
        },
        modalClose() {
            if (this.formData.rowId) {
                this.$refs.EditmodalClose.click();
            } else {
                this.$refs.modalClose.click();
            }
        },
        upload_logo(e) {
            let file = e.target.files[0];
            let reader = new FileReader();

            if (file['size'] < 2111775) {
                reader.onloadend = (file) => {

                    this.formData.logo = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                alert('File size can not be bigger than 2 MB')
            }
        }

    },
    mounted() {
        this.list_data();

        this.locationData();
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
