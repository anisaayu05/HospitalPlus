import axios from 'axios';

const Api = axios.create({
    baseURL: 'http://localhost:8000',  // Pastikan URL ini benar
    headers: {
        'Content-Type': 'application/json',  // Pastikan header sudah benar
    }
});

export default Api;
