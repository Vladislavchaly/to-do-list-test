class ApiService {
    constructor(baseUrl) {
        this.baseUrl = baseUrl;
        this.token = localStorage.getItem('access_token');
    }

    request(endpoint, method = 'GET', data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: this.baseUrl + endpoint,
                type: method,
                dataType: 'json',
                contentType: 'application/json',
                headers: {
                    'Authorization': this.token,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data ? JSON.stringify(data) : null,
                success: (response) => {
                    resolve(response);
                },
                error: (jqXHR) => {
                    this.handleError(jqXHR);
                    reject(jqXHR);
                }
            });
        });
    }

    handleError(jqXHR) {
        if (jqXHR.status === 401) {
            alert('Session expired. Redirecting to login.');
            localStorage.removeItem('access_token');
            window.location.href = '/login';
        } else if (jqXHR.status === 403) {
            alert('You do not have permission to perform this action.');
        } else if (jqXHR.status === 500) {
            alert('Server error. Please try again later.');
        } else {
            alert('An error occurred: ' + jqXHR.statusText);
        }
    }

    get(endpoint) {
        return this.request(endpoint, 'GET');
    }

    delete(endpoint) {
        return this.request(endpoint, 'DELETE');
    }

    post(endpoint, data) {
        return this.request(endpoint, 'POST', data);
    }

    put(endpoint, data) {
        return this.request(endpoint, 'PUT', data);
    }

    patch(endpoint, data) {
        return this.request(endpoint, 'PATCH', data);
    }
    setToken(token) {
        this.token = token;
        localStorage.setItem('access_token', token);
    }
}
