<template>

    <div>
        <div style="height: 170px"></div>
        <div class="login-box box-shadow" style="backround:red">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <img alt="Charisma Logo" :src="$root.asset_url+'/img/icon/login_icon.gif'"
                         class="hidden-xs"/>
                </div>
            </div>
            <form>

                <label class="mb-1">
                    <h6 class="mb-0 text-sm">মোবাইল নং</h6>
                </label>

                <div class="input-group input-group-md">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                    <input type="text" class="form-control" v-model="formData.mobile_no" placeholder="মোবাইল নং">
                    <span class="text-danger">{{ validation.firstError('formData.mobile_no') }}</span>
                </div>

                <label class="mb-1">
                    <h6 class="mb-0 text-sm">পাসওয়ার্ড</h6>
                </label>

                <div class="input-group input-group-md">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                    <input type="password" class="form-control" v-model="formData.password" placeholder="পাসওয়ার্ড">
                    <span class="text-danger">{{ validation.firstError('formData.password') }}</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-info btn-block" type="button" @click.prevent="login()">লগইন</button>
                        </div>
                    </div>
                </div>

            </form>


        </div>
    </div>
</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            formData: {mobile_no: '01716685646', password: '01716685646'}
        }
    },
    validators: {
        'formData.mobile_no': function (value) {
            return Validator.value(value).required("ইউজারনেম দিন");
        },
        'formData.password': function (value) {
            return Validator.value(value).required("পাসওয়ার্ড দিন");
        },
    },
    methods: {
        async login() {
            this.$validate().then((res) => {
                if (res) {
                    axiosWithoutToken.post('login', this.formData)
                        .then((response) => {
                            this.$store.dispatch('login', response.data)
                            window.location.replace(process.env.MIX_VUE_URL+ '/');
                        })
                        .catch((error) => {
                            console.log(error);
                        })
                }
            });
        }
    },
    created() {
        if (auth.loggedIn()) {
            this.$router.push({name: 'deshborad'})
        }
    }

}
</script>

<style>
.login-box {
    max-width: 550px;
    width: 100%;
    margin: 5px auto;
    position: relative;
    background: white;
    padding: 30px 100px;
    border-radius: 10px;
}
</style>
