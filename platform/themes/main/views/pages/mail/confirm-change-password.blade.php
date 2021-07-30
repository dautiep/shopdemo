<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Để Thay đổi mật khẩu khẩu, Vui lòng nhấn Vào link bên dưới</p>
    <a href="{{ route('guest.reset.password', $user->id) }}">Thay đổi mật khẩu</a>
</body>
</html>
