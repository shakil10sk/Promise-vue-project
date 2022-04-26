<template>
    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div class=" row">
            <div class="col-md-5 col-sm-5 col-xs-6">
                <Chart :type="'pie'" :width="380" :labels='["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]' :data="[25, 15, 44, 55, 41, 17]" ></Chart>
            </div>

            <div class="col-md-5 col-sm-5 col-xs-6">
                <Chart :type="'pie'" :width="380" :labels='["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]' :data="[25, 15, 44, 55, 41, 17]" ></Chart>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="bg-primary" style="padding: 3px">
                    <h5 class="short-heading " style="text-align:center;color: #fbf6f6"> সাইট
                        পরিসংখ্যান </h5>
                </div>
                <ul class="list-group">
                    <li class="list-group-item tablecolor1">
							<span class="badge badge-color-notification">
								<a style="color: #1C1C1C" href="Applicant/nagorik_applicant_list?napply=new">116</a>
							</span>মোট মেয়র
                    </li>
                    <li class="list-group-item tablecolor1">
							<span class="badge badge-color-notification">
								<a href="Applicant/nagorickapplicant?napply=new">90</a>
							</span> কর্তব্যরত মেয়র
                    </li>

                    <li class="list-group-item">
							<span class="badge badge-color">
								<a href="Applicant/nagorick_certi_list?napply=5">12410</a>
							</span> ছুটিরত মেয়র
                    </li>
                    <li class="list-group-item tablecolor1">
							<span class="badge badge-color-notification">
								<a href="Applicant/tradelicense_applicant_list?napply=new">26</a>
							</span> সাময়িক বরখাস্তকৃত মেয়র
                    </li>
                    <li class="list-group-item">
							<span class="badge badge-color">
								<a href="Applicant/tradelicense_certificate_list?napply=5">557</a>
							</span>মোট কর্মী
                    </li>
                    <li class="list-group-item tablecolor1">
							<span class="badge badge-color-warning">
								<a href="Applicant/tradelicenseapplicant?napply=expire">743</a>
							</span> কর্তব্যরত কর্মী
                    </li>
                    <li class="list-group-item">
							<span class="badge badge-color-notification">
								<a href="Applicant/reNewTradelicense">4</a>
							</span> ছুটিরত কর্মী
                    </li>
                    <li class="list-group-item tablecolor1">
							<span class="badge badge-color-notification">
								<a href="Applicant/warish_applicant_list?napply=new">80</a>
							</span>সাময়িক বরখাস্তকৃত কর্মী
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12" style="background: #FBFDFE;">
                <div class="bg-primary" style="padding: 3px">
                    <h5 class="short-heading " style="text-align:center; color: #FFFFFF">দ্রুত পরিচালনা
                        করুন</h5>
                </div>
                <br>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="quick-manage">
                        <a href="Applicant/nagorik_applicant_list?napply=new">
                            <img :src="$root.asset_url+'/img/icon/info.png'" alt="image">
                            <p>পৌরসভার তথ্য</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="quick-manage">
                        <a href="Applicant/tradelicense_applicant_list?napply=new">
                            <img :src="$root.asset_url+'/img/icon/school.png'" alt="image">
                            <p>শিক্ষা প্রতিষ্ঠান</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="quick-manage">
                        <a href="Applicant/warish_applicant_list?napply=new">
                            <img :src="$root.asset_url+'/img/icon/embassy.png'" alt="image">
                            <p>প্রশাসন বিভাগ </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="quick-manage">
                        <a href="Applicant/warish_applicant_list?napply=new">
                            <img :src="$root.asset_url+'/img/icon/engineer.png'" alt="image">
                            <p>প্রকৌশল বিভাগ </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="quick-manage">
                        <a href="Applicant/warish_applicant_list?napply=new">
                            <img :src="$root.asset_url+'/img/icon/stethoscope.png'" alt="image">
                            <p>স্বাস্থ্য বিভাগ </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="quick-manage">
                        <a href="Applicant/warish_applicant_list?napply=new">
                            <img :src="$root.asset_url+'/img/icon/note.png'" alt="image">
                            <p>তথ্য রেজিষ্টার </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="quick-manage">
                        <a href="Applicant/warish_applicant_list?napply=new">
                            <img :src="$root.asset_url+'/img/icon/calculator.png'" alt="image">
                            <p>হিসাব বিভাগ </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="quick-manage">
                        <a href="Applicant/warish_applicant_list?napply=new">
                            <img :src="$root.asset_url+'/img/icon/testing.png'" alt="image">
                            <p>প্রকল্প বিভাগ </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="quick-manage">
                        <a href="Applicant/warish_applicant_list?napply=new">
                            <img :src="$root.asset_url+'/img/icon/salary.png'" alt="image">
                            <p>বেতন-ভাতা বিভাগ </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Chart from '../components/Chart'

export default {
    name: "Deshboard",
    components: {Chart  }
}
</script>

<style scoped>
a{
    color: #272626;
    text-decoration: none;
}
</style>
