@extends('base')

@section('content')
    <div class="container">
        <h2>Register</h2>
        <a href="{{ url('/login') }}" class="btn btn-primary mb-3">Login</a>
        <form id="register-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <div id="register-message" class="alert" style="display: none;"></div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#register-form').on('submit', function (event) {
                event.preventDefault();

                const name = $('#name').val();
                const email = $('#email').val();
                const password = $('#password').val();
                const password_confirmation = $('#password_confirmation').val();

                window.ApiService.post('/auth/register', {
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation
                })
                    .then(response => {
                        window.location.href = '/dashboard';
                    })
                    .catch(error => {
                        let message = 'Registration failed. Please try again.';
                        if (error.status === 422) {
                            message = 'Validation failed. Please check your input.';
                        }
                        $('#register-message').addClass('alert-danger').text(message).show();
                    });
            });
        });
    </script>
@endsection
