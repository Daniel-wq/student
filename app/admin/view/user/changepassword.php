<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
	<?php include './view/header.php' ?>
    <div class="container">
        <div class="row">
			<?php include './view/left.php' ?>
            <div class="col-lg-9">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="">当前密码</label>
                        <input type="password" class="form-control" id="" placeholder="当前密码" name="password"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="">新密码</label>
                        <input type="password" class="form-control" id="" placeholder="新密码" name="NewPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="">确认密码</label>
                        <input type="password" class="form-control" id="" placeholder="确认密码" name="ConfirmPassword"
                               required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">确认</button>
                </form>
            </div>
        </div>


    </div>

	<?php include './view/footer.php' ?>

    </body>
</html>