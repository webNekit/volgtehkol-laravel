<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Ubuntu, sans-serif; background:#f6f6f6; padding:20px;">
<div style="max-width:600px;margin:auto;background:#fff;border-radius:12px;padding:24px;">
    <h2 style="margin-bottom:16px;color:#111">
        📩 Новое сообщение с сайта колледжа
    </h2>

    <p><strong>Имя:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>

    <hr style="margin:20px 0">

    <p style="white-space:pre-line">
        {{ $messageText }}
    </p>

    <hr style="margin:20px 0">

    <p style="font-size:12px;color:#777">
        Это письмо отправлено через форму обратной связи сайта.
    </p>
</div>
</body>
</html>
