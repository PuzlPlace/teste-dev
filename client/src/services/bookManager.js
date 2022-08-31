import ajaxCall from "@/services/ajaxCall";

export default {
      async getAllCategories() {
            // eslint-disable-next-line no-useless-catch
            try {
                  let result = null

                  await ajaxCall.callApi('/books/categories/all', null, true, 'GET')
                  .then(response => {
                        result = response.data.data.categories
                  })

                  return result
            }catch (e) {
                  throw e;
            }
      },

      async getAllBooks(categoryId = null, fileType = null, bookName = null, regsByPage = 5, page = 1) {
            // eslint-disable-next-line no-useless-catch
            try {
                  let result = null

                  await ajaxCall.callApi(`/books/all/${categoryId}/${fileType}/${bookName}/${regsByPage}/${page}`, null, true, 'GET')
                  .then(response => {
                        result = response.data.data.result
                  })

                  return result
            }catch (e) {
                  throw e;
            }
      },

      async findBookByCode(code) {
            // eslint-disable-next-line no-useless-catch
            try {
                  let result = null

                  await ajaxCall.callApi('/books/show/' + code, null, true, 'GET')
                  .then(response => {
                        result = response.data.data.book
                  })

                  return result
            }catch (e) {
                  throw e;
            }
      },

      async createBook(payload) {
            // eslint-disable-next-line no-useless-catch
            try {
                  return await ajaxCall.callApi('/books/store', payload, true, 'POST')
            }catch (e) {
                  throw e;
            }
      },

      async updateBook(payload, code) {
            // eslint-disable-next-line no-useless-catch
            try {
                  return await ajaxCall.callApi(`/books/update/${code}`, payload, true, 'PUT')
            }catch (e) {
                  throw e;
            }
      },

      async deleteBook(id) {
            // eslint-disable-next-line no-useless-catch
            try {
                  return await ajaxCall.callApi(`/books/delete/${id}`, null, true, 'DELETE')
            }catch (e) {
                  throw e;
            }
      }
}
