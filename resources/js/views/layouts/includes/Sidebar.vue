<template>
    <div class="col-sm-2 col-lg-2">
        <div class="sidebar-nav">
            <div class="nav-canvas">
                <div class="nav-sm nav nav-stacked">

                </div>
                <ul class="nav nav-pills nav-stacked main-menu">
                    <li class="nav-header">Main</li>
                    <li><router-link :to="{name:'deshborad'}" class="ajax-link"><i class="glyphicon glyphicon-home"></i><span> ড্যাশবোর্ড</span></router-link>
                    </li>
                    <li class="accordion">
                        <a href="javascript:void(0)"><i
                            class="glyphicon glyphicon-user"></i><span> মানব সম্পদ</span> &nbsp;<i
                            class="glyphicon glyphicon-chevron-down"></i></a>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"> জনপ্রতিনিধি</a></li>
                            <li><a href="#"> কর্মকর্তা/কর্মচারীগণ</a></li>
                            <li><a href="#"> চুক্তিভিত্তিক কর্মচারী</a></li>

                        </ul>
                    </li>
                    <li class="accordion">
                        <a href="javascript:void(0)"><i
                            class="glyphicon glyphicon-list-alt"></i><span> হিসাব ব্যবস্থাপনা</span> &nbsp;<i
                            class="glyphicon glyphicon-chevron-down"></i></a>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">আয়-ব্যয়</a></li>
                            <li><a href="#"> বার্ষিক বাজেট</a></li>
                        </ul>
                    </li>
                    <li><a class="ajax-link" href="#"><i
                        class="glyphicon glyphicon-file"></i><span> ত্রৈমাসিক হিসাব</span></a>
                    </li>
                    <li><a class="ajax-link" href="#"><i
                        class="glyphicon glyphicon-list-alt"></i><span> বেতন হিসাব</span></a>
                    </li>

                    <li v-show="AuthType == 1" class="accordion">
                        <a href="javascript:void(0)"><i
                            class="glyphicon glyphicon-cog"></i><span> সেটিং</span> &nbsp;<i
                            class="glyphicon glyphicon-chevron-down"></i></a>
                        <ul class="nav nav-pills nav-stacked">
                            <li><router-link :to="{name: 'municipility'}" class="ajax-link">পৌরসভা</router-link></li>
                            <li><router-link :to="{name: 'location'}" class="ajax-link">লোকেশন</router-link></li>
                            <li><router-link :to="{name: 'department'}" class="ajax-link">ডিপার্টমেন্ট/ পদবী</router-link></li>
                            <li><router-link :to="{name: 'branch'}" class="ajax-link">শাখা</router-link></li>
                            <li><router-link :to="{name: 'employee.quota'}" class="ajax-link">শূন্যপদ সেটআপ</router-link></li>

                            <li class="accordion">
                                <a href="javascript:void(0)">
                                    <i class="glyphicon glyphicon-asterisk"></i>
                                    <span>ব্যাংক তথ্য</span> &nbsp;
                                    <i class="glyphicon glyphicon-chevron-down"></i>
                                </a>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">ব্যাংক</a></li>
                                    <li><router-link :to="{name: 'bank_branch'}" class="ajax-link">ব্যাংক শাখা</router-link></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li v-show="AuthType == 1" class="accordion">
                        <a href="javascript:void(0)"><i
                            class="glyphicon glyphicon-th-list"></i><span> রোল সেটআপ</span> &nbsp;<i
                            class="glyphicon glyphicon-chevron-down"></i></a>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="applicant/nagorik_applicant_list">রোল লিস্ট</a></li>
                            <li><a href="applicant/nagorick_certi_list">এসাইন রোল</a></li>
                        </ul>
                    </li>

                    <li v-show="AuthType == 1" ><a class="ajax-link" href="#"><i
                        class="glyphicon glyphicon-link"></i><span> একটিভিটি লগস</span></a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Sidebar",
    computed:{
        AuthType(){
            return auth.getType();
        }
    }
}
</script>

<style scoped>

</style>
