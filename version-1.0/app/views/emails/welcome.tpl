<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f4f4f4; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .footer { background: #f4f4f4; padding: 10px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Our Site!</h1>
        </div>
        <div class="content">
            <p>Hello {$username},</p>
            <p>Thank you for registering with us. We're excited to have you on board!</p>
            <p>Your registered email is: <strong>{$email}</strong></p>
            <p>If you have any questions, please don't hesitate to contact us.</p>
        </div>
        <div class="footer">
            <p>&copy; {$smarty.now|date_format:"%Y"} Our Site. All rights reserved.</p>
        </div>
    </div>
</body>
</html>