<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="register" method="post" enctype="multipart/form-data">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?= $_POST['username'] ?? '' ?>">
            <?= $errors['username'] ?? '' ?>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= $_POST['email'] ?? '' ?>">
            <?= $errors['email'] ?? '' ?>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?= $_POST['phone'] ?? '' ?>">
            <?= $errors['phone'] ?? '' ?>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password">
            <?= $errors['password'] ?? '' ?>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password">
            <?= $errors['confirm_password'] ?? '' ?>
        </div>
        <div>
            <label for="image">Profile Image:</label>
            <input type="file" name="image">
            <?= $errors['image'] ?? '' ?>
        </div>
        <?php if (isset($errors['exists'])) { echo "<p style='color:red;'>{$errors['exists']}</p>"; } ?>
        <button type="submit">Register</button>
    </form>
</body>
</html>
