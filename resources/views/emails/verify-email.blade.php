<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Account</title>
</head>
<body style="font-family: Arial; background:#f8f8f8;">

<div style="
max-width:600px;
margin:auto;
background:white;
padding:30px;
border-radius:10px;
">

    <div style="text-align:center;">

        <img
            src="https://dummyimage.com/200x80/008000/ffffff&text=EVENTIFY"
            alt="Eventify Logo"
        >

    </div>

    <h2 style="color:#008000;">
        Hello {{ $user->name }},
    </h2>

    <p>
        Welcome to Eventify.
    </p>

    <p>
        Please verify your account by clicking
        the button below.
    </p>

    <p style="text-align:center;">

        <a
            href="{{ $url }}"
            style="
                background:#008000;
                color:white;
                padding:12px 25px;
                text-decoration:none;
                border-radius:5px;
            "
        >
            Verify My Account
        </a>

    </p>

    <p>
        If you did not create this account,
        you may safely ignore this email.
    </p>

    <hr>

    <p style="color:#999; font-size:12px;">
        © {{ date('Y') }} Eventify.
        All rights reserved.
    </p>

</div>

</body>
</html>
