<!-- resources/views/auth/create-password.blade.php -->

<form method="POST" action="{{ route('password.create', $token) }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ $userId }}">
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" name="password_confirmation" required>
    <button type="submit">Create Password</button>
</form>



<h1>Forget Password Email</h1>

You can reset password from bellow link:
<a href="{{ route('reset.password.get', $token) }}">Reset Password</a>

