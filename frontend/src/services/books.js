import { http } from './config';

export default {

    list:()=>{
        return http.get('/books')
    },
    saveBook:(book)=>{
        return http.post('/book/create', book)
    },
    updateBook:(book, id)=>{
        return http.put(`/book/update/${id}`, book )
    },
    specificBook:(id)=>{
        return http.get(`/book/${id}`)
    },
    removeBook:(id)=>{
        return http.delete(`/book/delete/${id}`, )
    }
}

