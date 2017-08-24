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
                    <li class="active"><a href="<?php echo u('index') ?>" role="tab" data-toggle="tab">学生列表</a>
                    </li>
                    <li><a href="<?php echo u('store') ?>" role="tab" data-toggle="tab">添加/编辑</a></li>
                </ul>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>profile</th>
                        <th>sex</th>
                        <th>birthday</th>
                        <th>grade</th>
                        <th>introduction</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $v): ?>
                        <tr>
                            <td><?php echo $v['sid'] ?></td>
                            <td><?php echo $v['sname'] ?></td>
                            <td>
                                <img width="50" src="<?php echo $v['profile'] ?>" alt="">
                            </td>
                            <td>
	                            <?php echo $v['sex'] ?>
                            </td>
                            <td>
	                            <?php echo $v['birthday'] ?>
                            </td>
                            <td>
	                            <?php echo $v['gname'] ?>
                            </td>
                            <td>
	                            <?php echo $v['introduction'] ?>
                            </td>
                            <td>
                                <a href="<?php echo u('update') . '&sid=' . $v['sid']?>" class="btn btn-primary btn-xs">编辑</a>
                                <a href="javascript:if(confirm('are you sure?')) location.href='<?php echo u('remove') . '&sid=' . $v['sid'] ?>';" class="btn btn-danger btn-xs">删除</a>
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