import ajaxCall from "@/services/ajaxCall";
import Cookies from "js-cookie";
import store from "@/store";

export default {
      async login (payload = []) {
            return ajaxCall.callApi('/login', payload);
      },

      userIsLogged(){
            return (Cookies.get(process.env.VUE_APP_COOKIE_NAME) != null && store.state.userLogged != null)
      }
}
