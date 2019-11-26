import axios from 'axios';

export default class API {
    constructor(){
    }
    get(cep){
        return axios.get(`https://viacep.com.br/ws/${cep}/json/`);
    }
};