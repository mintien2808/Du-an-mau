<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="login" method="post">
            <div class="col-md-6 col-md-offset-3 mt-5">
                <div class="alert alert-info text-center">
                    <strong>Trang đăng nhập</strong>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Tài khoản:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập..." required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu..." required>
                        </div>
                        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
                        <button type="submit" class="btn btn-primary btn-block" name="login">Đăng nhập</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
