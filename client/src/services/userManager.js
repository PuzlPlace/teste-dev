import ajaxCall from "@/services/ajaxCall";

export default {
      async getAllUsers() {
            // eslint-disable-next-line no-useless-catch
            try {
                  let result = null

                  await ajaxCall.callApi('/users/all', null, true, 'GET')
                  .then(response => {
                        result = response.data.data.users
                  })

                  return result
            }catch (e) {
                  throw e;
            }
      },

      async createUser(payload) {
            // eslint-disable-next-line no-useless-catch
            try {
                  return await ajaxCall.callApi('/users/store', payload, true, 'POST')
            }catch (e) {
                  throw e;
            }
      },

      async updateUser(payload) {
            // eslint-disable-next-line no-useless-catch
            try {
                  return await ajaxCall.callApi(`/users/update/${payload.uuid}`, payload, true, 'PUT')
            }catch (e) {
                  throw e;
            }
      },

      async deleteUser(id) {
            // eslint-disable-next-line no-useless-catch
            try {
                  return await ajaxCall.callApi(`/users/delete/${id}`, null, true, 'DELETE')
            }catch (e) {
                  throw e;
            }
      }
}
