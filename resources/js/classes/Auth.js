import LocalStorage from "./LocalStorage";

class Auth {
    async SetData(data) {
        LocalStorage.store(data);
    }

    loggedIn() {
        return LocalStorage.logged();
    }

    name() {
        if (this.loggedIn()) {
            if (LocalStorage.getAuthUser()) {
                return LocalStorage.getAuthUser()['name'];
            } else {
                return "";
            }
        }
    }

    username() {
        if (this.loggedIn()) {
            if (LocalStorage.getAuthUser()) {
                return LocalStorage.getAuthUser()['information']['name'];
            } else {
                return "";
            }
        }
    }

    getType(){
        if (this.loggedIn()) {
            if (LocalStorage.getAuthUser()) {
                return LocalStorage.getAuthUser()['type'];
            }
        }

        return 0;
    }

    id() {
        if (this.loggedIn()) {
            if (LocalStorage.getAuthUser()) {
                return LocalStorage.getAuthUser()['id'];
            } else {
                return "";
            }
        }
    }
    token(){
        return LocalStorage.getToken()
    }

    clear(){
        LocalStorage.clear();
    }


}

export default Auth = new Auth();
