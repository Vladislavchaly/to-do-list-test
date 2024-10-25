@extends('base')

@section('content')
    <div class="container">
        <h2>Login</h2>
        <a href="{{ url('/register') }}" class="btn btn-primary mb-3">Register</a>
        <form id="login-form">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#login-form').on('submit', function (event) {
                event.preventDefault();

                const email = $('#email').val();
                const password = $('#password').val();

                window.ApiService.post('/auth/login', {email: email, password: password})
                    .then(response => {
                        window.ApiService.setToken(response.token);
                        window.location.href = '/dashboard';
                    })
                    .catch(error => {
                        let message = 'Login failed. Please check your credentials.';
                        if (error.status === 401) {
                            message = 'Unauthorized. Invalid credentials.';
                        }
                        $('#login-message').addClass('alert-danger').text(message).show();
                    });
            });
        });
    </script>
@endsection