<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <script type="application/javascript" src="./static/js/jquery-2.1.0.js"></script>
	<?php include './view/header.php' ?>
    <div class="container">
        <div class="row">
			<?php include './view/left.php' ?>
            <div class="col-lg-9">
                <!-- TAB NAVIGATION -->
                <ul class="nav nav-tabs" role="tablist">
                    <li><a href="<?php echo u('index') ?>" role="tab" data-toggle="tab">学生列表</a></li>
                    <li class="active"><a href="<?php echo u('store') ?>" role="tab" data-toggle="tab">添加/编辑</a>
                    </li>
                </ul>
                <form action="" method="post" role="form" style="margin-top: 20px;" enctype="multipart/form-data">
                    <div class="form-group">
                        <select name="gid" class="form-control" required>
                            <option value="">请选择班级</option>
							<?php foreach($gradeData as $g): ?>
                                <option value="<?php echo $g['gid'] ?>" <?php if($g['gid'] == $oldData['gid']): ?>  selected <?php endif ?>  ><?php echo $g['gname'] ?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="sname" id="" placeholder="name"
                               value="<?php echo $oldData['sname'] ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="profileupload" class="form-control" >
                    <!--隐藏域-->
                        <input type="hidden" name="profile" value="<?php echo $oldData['profile'] ?>">
                        <a href="javascript:;" class="btn btn-xs btn-info" style="margin-top: 10px;" id="showAttachment">显示素材</a>
                        <a href="javascript:;" class="btn btn-xs btn-primary" style="margin-top: 10px;" id="hideAttachment">隐藏素材</a>
                        <div style="margin-top: 20px;display: block" id="attachmentBox">
                            <?php foreach ($attachmentData as $a): ?>
                                <img width="80" src="<?php echo $a['path'] ?>" <?php if($oldData['profile'] == $a['path']): ?> style="border: 2px solid red;"  <?php endif ?> >
                            <?php endforeach; ?>
                        </div>

                    </div>
                    <script>
                        $(function () {
                            //显示素材
                            $('#showAttachment').click(function () {
                                $('#attachmentBox').show(500);
                            })
                            //隐藏素材
                            $('#hideAttachment').click(function () {
                                $('#attachmentBox').hide(500);
                            })
                            $('#attachmentBox img').click(function () {
                                //点击素材有选中效果
                                $(this).css({'border':'2px solid red'}).siblings().css({'border':'none'});
                                //把选中的图片的地址传到隐藏域将来可以提交到$_POST最后存入数据库
                                $('input[name=profile]').val($(this).attr('src'));
                            })
                        })
                    </script>
                    <div class="form-group">
                        <div class="radio ">
                            <label class="radio-inline">
                                <input type="radio" name="sex" value="男" <?php if($oldData['sex'] == '男'): ?> checked <?php endif ?>  >
                                男
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" value="女" <?php if($oldData['sex'] == '女'): ?> checked <?php endif ?>  >
                                女
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="date" name="birthday" class="form-control" value="<?php echo $oldData['birthday'] ?>" required>
                    </div>

                    <div class="form-group">
                        <textarea name="introduction" placeholder="introduce yourself" cols="30" rows="6" class="form-control"><?php echo $oldData['introduction'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">save</button>
                </form>
            </div>

        </div>

    </div>
	<?php include './view/footer.php' ?>


    </body>
</html>