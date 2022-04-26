import axiosWithoutToken from 'axios';


axiosWithoutToken.defaults.baseURL = process.env.MIX_VUE_URL+'/api/'
axiosWithoutToken.defaults.withCredentials = true;
axiosWithoutToken.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

const hasToken = () => {
    return auth.token();
}




const axios = axiosWithoutToken.create();

axios.interceptors.request.use(function (config) {
    // Do something before request is sent
    let token = hasToken();
    if (token) {
        config.headers.Authorization = `Bearer ${token}` ;
    } else {
        window.location.replace(process.env.MIX_VUE_URL+ '/login');
    }


    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
}, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    if (error.response.status == 401) {
        window.location.replace(process.env.MIX_VUE_URL+ '/login');
    }
    return Promise.reject(error);
});


export {axios, axiosWithoutToken};
