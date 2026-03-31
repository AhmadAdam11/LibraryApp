<!DOCTYPE html>
<html>
<head>
    <title>Aktivasi Akun</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f9fafb; display:flex; align-items:center; justify-content:center; height:100vh; margin:0;">

    <div style="background:white; padding:30px 40px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.05); text-align:center; max-width:400px; width:100%;">
        
        <h2 style="margin-bottom:10px; color:#1f2937;">
            Account Activation
        </h2>

        <p style="color:#6b7280; font-size:14px; margin-bottom:25px;">
            Your account is almost ready! Click the button below to activate your account and start using it.<strong>Perpus App</strong>.
        </p>

        <a href="{{ url('/activate/'.$token) }}"
           style="display:inline-block; background:#475569; color:white; padding:12px 24px; border-radius:999px; text-decoration:none; font-weight:bold;">
            Activate Now
        </a>

        <p style="margin-top:25px; font-size:12px; color:#9ca3af;">
            If you don't feel like signing up, just ignore this email.
        </p>

    </div>

</body>
</html>