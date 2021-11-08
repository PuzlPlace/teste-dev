import Cookies from "js-cookie";

export default{
    auth(to, from, next){
        const token = Cookies.get('_app_token');
        if(!token){
            next('/login');
        }
        next();
    }
}