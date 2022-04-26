<template>
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"> <img alt="Charisma Logo" :src="$root.asset_url+'/img/icon/logo.gif'"
                                                            class="hidden-xs"/>
                <span>Promise</span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs">&nbsp;{{ username }}</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a  @click="logout()"  style="cursor: pointer"  >Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->


            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="#"><i class="glyphicon glyphicon-globe"></i></a></li>
                <li>
                    <form class="navbar-search pull-left">
                        <input placeholder="Search here...." class="search-query form-control col-md-10" name="query"
                               type="text">
                    </form>
                </li>
            </ul>

        </div>
    </div>
</template>

<script>
export default {
    name: "Topbar",
    computed:{
        username(){
            return auth.username();
        }
    },
    methods:{
        logout(){
            this.$store.dispatch('logout');
        }
    }
}
</script>

<style scoped>

</style>
