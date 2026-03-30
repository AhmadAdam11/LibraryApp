<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

    <h2>Register</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf

        <div>
            <label>Nama</label><br>
            <input type="text" name="name" required>
        </div>

        <br>

        <div>
            <label>Email</label><br>
            <input type="email" name="email" required>
        </div>

        <br>

        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>

        <br>

        <button type="submit">Register</button>
    </form>

    <br>
    <a href="/login">Sudah punya akun? Login</a>

</body>
</html>