<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin tài khoản</title>
</head>
<body>
    <h4>Xin chào {{ $model->full_name }}, thông tin tài khoản của bạn là</h4>
    <h5>Tài khoản: {{ $model->email }}</h5>
    <h5>Mật khẩu: {{ $password }}</h5>
    <h5>Bạn có thể thay đổi mật khẩu tại <a href="">đây</a></h5>
</body>
</html>
