<html>
<html>
<head>
	<title><?php echo $pageTitle?> | uFlex</title>

</head>
<body>

						<?php if($user->isSigned()): ?>
<!-- 						<a href="<?php echo $base?>/ps/logout.php" class="btn btn-default btn-xs navbar-btn">
							Logout (<?php echo $user->Username?>)
						</a> -->
					<?php else: ?>
<!-- 						<a href="<?php echo $base?>/login" class="btn btn-default btn-xs navbar-btn">
							LogIn
						</a> -->
					<?php endif; ?>

	<div id="content" class="">
