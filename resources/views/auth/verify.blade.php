
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px;
        }
        .content h1 {
            color: #333333;
            font-size: 24px;
        }
        .content p {
            color: #555555;
            font-size: 16px;
            line-height: 1.5;
        }
        .button {
            margin: auto;
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 10px;
            color: #777777;
            font-size: 14px;
        }
        .footer .contact {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="https://img.freepik.com/free-vector/hand-drawn-baphomet-illustration_23-2149833774.jpg?size=338&ext=jpg&ga=GA1.1.1700460183.1712620800&semt=ais" alt="Goat Logo">
        </div>
        <div class="content">
            <h1>Xác thực địa chỉ email</h1>
            <p>Kính chào <b>{{ $user->name }}</b></p>
            <p>Bạn vừa đăng kí thành công tài khoản trên hệ thống LilGoat.</p>
            <p><i>Bạn vui lòng bỏ qua email này nếu đây không phải là email của Quý khách.</i></p>
            <a href="{{ $url }}" class="button" style="color: #ffffff">Xác nhận</a>
            <p style="text-align: center">Trân trọng cảm ơn Quý khách đã tin tưởng sử dụng dịch vụ!</p>
        </div>
        <div class="footer">
            <p>Vui lòng liên hệ bộ phận chăm sóc khách hàng để được hỗ trợ</p>
            <div class="contact">
                <p>0395419293</p>
                <p>tranphongbackend@gmail.com</p>
            </div>
        </div>
    </div>
</body>
</html>


