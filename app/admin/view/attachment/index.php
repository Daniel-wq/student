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
				<!-- TAB NAVIGATION -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="" role="tab" data-toggle="tab">附件列表</a>
					</li>
				</ul>
				<table class="table table-hover">
					<thead>
					<tr>
						<th>id</th>
						<th>头像</th>
						<th>头像路径</th>
						<th>创建时间</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
                        <?php foreach($data as $v): ?>
                            <tr>
                                <td><?php echo $v['aid'] ?></td>
                                <td>
                                    <img width="50" src="<?php echo $v['path'] ?>" alt="">
                                </td>
                                <td><?php echo $v['path'] ?></td>
                                <td><?php echo date('y-m-d H:i:s',$v['createtime']) ?></td>
                                <td>
                                    <a href="javascript:if(confirm('Are you sure?')) location.href='<?php echo u('remove') . '&aid=' . $v['aid'] . '&path=' . $v['path'] ?>';" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
					</tbody>
				</table>

			</div>

		</div>

	</div>

	<?php include './view/footer.php' ?>

	</body>
</html>