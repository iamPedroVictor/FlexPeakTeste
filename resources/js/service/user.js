import axios from 'axios';

export default class User {
    constructor(){
    }

    check(){
        const config = {
            headers: {
                Authorization: `Bearer ${sessionStorage.getItem('token')}`
            }
        }
        axios.get('/api/Vendedor',config)
            .then(resolve => {
                return resolve.data;
            })
            .catch(error => {
                return {error: error.response.status}
            });
    }

};