<template>
    <div>
        <!-- topbar header  starts -->
        <Topbar v-if="Object.keys($route.meta).length === 0 ? true :false" ></Topbar>
        <!-- topbar header  end -->
        <div class="ch-container">
            <div class="row">

                <!-- left menu starts -->
                <Sidebar v-if="Object.keys($route.meta).length === 0 ? true :false" ></Sidebar>
                <!-- left menu ends -->


                <!-- main content !-->
              <router-view></router-view>
                <!-- main content !-->


            </div>
            <!-- footer !-->
            <Footer v-if="Object.keys($route.meta).length === 0 ? true :false" ></Footer>
            <!-- footer !-->

        </div>
    </div>

</template>

<script>

import Sidebar from './includes/Sidebar'
import Topbar from './includes/Topbar'
import Footer from './includes/Footer'
export default {
    name: "AppLayout",
    components: {Sidebar, Topbar, Footer},
    mounted() {

        if(Object.keys(this.$route.meta).length === 0){
            document.querySelector('body').style.backgroundColor = 'white';
        }else{
            let bg_url = this.$root.asset_url+'/img/lg-bg.jpg';
            document.querySelector('body').style.backgroundImage = "url("+bg_url+")";
        }

    }
}
</script>

<style scoped>
body{
    background: #f5f0f0;
}
</style>
