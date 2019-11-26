import axios from 'axios';

export default class API {
    constructor(recurso){
        this.recurso = recurso;
    }
    all() {
        return axios.get(`/api/${this.recurso}`);
    }
    find(id) {
        return axios.get(`/api/${this.recurso}/${id}`);
    }
    update(id, data) {
        return axios.put(`/api/${this.recurso}/${id}`, data);
    }
    delete(id){
        return axios.delete(`/api/${this.recurso}/${id}`);
    }
    store(data){
        console.log(data);
        return axios.post(`/api/${this.recurso}`, data);
    }
};