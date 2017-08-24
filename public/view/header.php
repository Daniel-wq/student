<link rel="stylesheet" href="./static/bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius: 0">
	<div class="container">
		<a class="navbar-brand" href="">Student Manager</a>
		<ul class="nav navbar-nav" style="float: right;">
            <li class="active" >
                <a href="./index.php">首页</a>
            </li>

			<?php if(isset($_SESSION['user'])): ?>
	            <li  >
	                <a href="<?php echo u('admin/entry/index') ?>">后台</a>
	            </li>
        	<?php endif ?>
			
			<li>
                <!-- 如果用户登陆了 -->
				<?php if(isset($_SESSION['user'])): ?>
                    <a href="<?php echo u('admin/user/logout') ?>"><span style="color: red"><?php echo $_SESSION['user']['username'] ?></span>&nbsp;&nbsp;退出</a>
                <?php else: ?>
                    <a href="<?php echo u('admin/user/login') ?>">登陆</a>
                <?php endif ?>
			</li>
		</ul>

	</div>
</nav>