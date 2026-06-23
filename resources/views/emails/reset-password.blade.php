<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Reset Password</title>
	<style>
		body{font-family: Arial, Helvetica, sans-serif; background:#f6f6f6; margin:0; padding:20px}
		.card{max-width:600px;margin:30px auto;background:#fff;padding:20px;border-radius:6px;border:1px solid #e9e9e9}
		.btn{display:inline-block;padding:10px 16px;background:#1a73e8;color:#fff;text-decoration:none;border-radius:4px}
		.muted{color:#6b6b6b;font-size:13px}
	</style>
</head>
<body>
	<div class="card">
		<h2>Reset your password</h2>
		<p class="muted">Hello @if(isset($user)){{ $user->name }}@endif,</p>
		<p>You recently requested to reset your password for your account. Click the button below to reset it.</p>

		<p style="text-align:center;margin:24px 0">
			<a href="{{ $url ?? url("/password/reset/".($token ?? '')) }}" class="btn">Reset password</a>
		</p>

		<p class="muted">If the button above does not work, copy and paste the following link into your browser:</p>
		<p class="muted"><a href="{{ $url ?? url("/password/reset/".($token ?? '')) }}">{{ $url ?? url("/password/reset/".($token ?? '')) }}</a></p>

		<p class="muted">If you didn't request a password reset, you can safely ignore this email.</p>

		<p class="muted">Thanks,<br>The Eventify Team</p>
	</div>
</body>
</html>
