import authManager from "@/services/authManager";

export default {
      verifyUserAuthenticated(to, from, next){
            console.log(authManager.userIsLogged())

            if(!authManager.userIsLogged() && to.name !== 'Home')
                  next('login')
            else if(to.name === 'Home' || to.name === 'Login')
                  next('dashboard')

            next();
      }
}
