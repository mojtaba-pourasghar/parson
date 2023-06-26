<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$user['name']}}</h2>
<br/>
Your registered email-id is {{$user['email']}}
<br>
Register code : <a href="{{ route('user.email_confirmation',$user['email_confirmation'])}}"> {{ route('user.email_confirmation',$user['email_confirmation'])}}</a>
</body>

</html>
