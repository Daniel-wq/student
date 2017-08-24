<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
    <style>
        table td{
            color: #5e5e5e;
        }
    </style>
	<?php include './view/header.php' ?>
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="./index.php">首页</a></li>
			<li class="active"><?php echo $data['sname'] ?></li>
		</ol>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo $data['sname'] ?></h3>
			</div>
			<div class="panel-body" style="padding: 20px">
				<table class="table table-hover">
					<tr>
						<th width="150">Profile:</th>
						<td>
                            <img width="80" src="<?php echo $data['profile']?>">
						</td>
					</tr>
					<tr>
						<th>Sex:</th>
						<td>
                            <?php echo $data['sex'] ?>
						</td>
					</tr>
					<tr>
						<th>Birthday:</th>
						<td>
                            <?php echo $data['birthday'] ?>
						</td>
					</tr>
					<tr>
						<th>Grade</th>
						<td>
                            <?php echo $data['grade']['gname'] ?>
                        </td>
					</tr>

					<tr>
						<th>Introduction:</th>
						<td>
                            <?php echo $data['introduction'] ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<?php include './view/footer.php' ?>

	</body>
</html>