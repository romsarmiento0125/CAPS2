<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>
<style>
    .txt-space{
        letter-spacing: 1px;
    }
</style>
<body style="font-family: Arial, Helvetica, sans-serif;  letter-spacing: 1px;">
    <h3>Confirm your email address</h3>
    <div style=" letter-spacing: 1px;">Hi {{$details['name']}}, {{$details['message']}}:</div>
    <div style="font-size: 25px; margin: 10px 0px; font-weight:bold; letter-spacing: 1px;">{{$details['code']}}</div>
    <div style=" letter-spacing: 1px; margin-top:25px;">Regards,</div>
    <div style=" letter-spacing: 1px;">Erich Grocery Store</div>
</body>
</html>