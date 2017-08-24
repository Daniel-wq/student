<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <?php include './view/header.php'; ?>
    <div class="container">

        <table class="table table-hover">
            <thead>
            <tr>
                <th>id</th>
                <th>头像</th>
                <th>姓名</th>
                <th>性别</th>
                <th>出生日期</th>
                <th>班级</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $v): ?>
            <tr>
                <td><?php echo $v['sid']?></td>
                <td>
                    <img width="60" src="<?php echo $v['profile']?>" with="80" alt="">
                </td>
                <td><?php echo $v['sname']?></td>
                <td><?php echo $v['sex']?></td>
                <td><?php echo $v['birthday']?></td>
                <td><?php echo $v['gname']?></td>
                <td>
                    <a href="<?php echo u('show') . '&sid=' . $v['sid']?>">查看</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <?php include './view/footer.php' ?>

    </body>
</html>