<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>New Account Created</title>
</head>

<body>
    Hello, <strong>{{ $first_name }} {{ $last_name }}</strong>
    <p>A new account is created in TextTorrent with this email address.</p>
    <p>Your login details are:</p>
    <p>Email: {{ $email }}</p>
    <p>Password: {{ $password }}</p>
    <p>You can access the site by clicking on the link below:</p>
    <p><a href="{{ $url }}">{{ $url }}</a></p>
    <p>Thanks,</p>
    <p>TextTorrent Team</p>
</body>

</html>
