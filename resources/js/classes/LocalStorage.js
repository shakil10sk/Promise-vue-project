class LocalStorage {

    store(data) {
        this.storeData(data);
    }
    storeData(data) {
        localStorage.setItem('isLogged', true);
        localStorage.setItem('user', JSON.stringify(data.user));
        localStorage.setItem('token', data.access_token);
        localStorage.setItem('token_type', data.token_type);
    }
    clear() {
        localStorage.removeItem('isLogged')
        localStorage.removeItem('user')
        localStorage.removeItem('token')
        localStorage.removeItem('token_type')
    }
    getAuthUser() {
        if (localStorage.getItem('user')) {
            try {
                return JSON.parse(localStorage.getItem('user'));
            } catch (e) {
                return [];
            }
        }
    }
    getToken(){
        return localStorage.getItem('token');
    }
    logged() {
        return localStorage.getItem('isLogged') ?? false;
    }
}

export default LocalStorage = new LocalStorage()
