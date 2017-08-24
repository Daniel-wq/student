<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<?php include './view/header.php' ?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="">首页</a></li>
        <li class="active">登录</li>
    </ol>
	<form method="post" action="">
		<div class="form-group">
			<label for="">username</label>
			<input type="text" class="form-control" id="" placeholder="username" name="username" required>
		</div>
		<div class="form-group">
			<label for="">Password</label>
			<input type="password" class="form-control" id="" placeholder="Password" name="password" required>
		</div>
        <div class="form-group">
            <label for="">captcha</label>
            <input type="text" class="form-control" id="" placeholder="captcha" name="captcha" required>
        </div>
        <div class="form-group">
            <img src="<?php echo u('captcha') . '&mt=' . microtime(true) ?>" onclick="this.src=this.src+'&='+Math.random()">
        </div>
		<div class="checkbox">
			<label>
				<input type="checkbox" name="autologin"> remember me
			</label>
		</div>
		<button type="submit" class="btn btn-primary btn-lg">login</button>
	</form>
</div>
	<?php include './view/footer.php' ?>


</body>
</html>