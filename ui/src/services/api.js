import axios from 'axios';
import Cookies from 'js-cookie';

const apiClient = axios.create({
    baseURL: 'http://localhost:8080',
    withCredentials: true,
    headers: {'Accept': 'application/json0', 'X-Requested-With': 'XMLHttpRequest'}
});

const onRequest = (config) => {
    // If http method is `post | put | delete` and XSRF-TOKEN cookie is 
    // not present, call '/sanctum/csrf-cookie' to set CSRF token, then 
    // proceed with the initial response
    if ((
            config.method == 'post' || 
            config.method == 'put' || 
            config.method == 'delete'
            /* other methods you want to add here */
        ) &&
        !Cookies.get('XSRF-TOKEN')) {
        return setCSRFToken()
            .then(response => config);
    }
    return config;
}

const setCSRFToken = () => {
    return apiClient.get('sanctum/csrf-cookie'); // resolves to '/api/csrf-cookie'.
}

// attach your interceptor
apiClient.interceptors.request.use(onRequest, null);

export default apiClient;