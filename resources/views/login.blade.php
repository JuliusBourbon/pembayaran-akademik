<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div>
        <h2>Login</h2>

        @if(session('error'))
            <div>{{ session('error') }}</div>
        @endif
        
        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>