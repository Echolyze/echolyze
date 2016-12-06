<html>
<html>
<head>
	<title><?php echo $pageTitle?> | Echolyze</title>

</head>
<body>

<?php if($user->isSigned()): ?>
<script>
const CURRENTUSER_ID = '<?php echo $user->ID?>';
console.log('currentUser_ID:' + CURRENTUSER_ID);
</script>
<!-- 						<a href="<?php echo $base?>/ps/logout.php" class="btn btn-default btn-xs navbar-btn">
							Logout (<?php echo $user->Username?>)
						</a> -->
					<?php else: ?>
<!-- 						<a href="<?php echo $base?>/login" class="btn btn-default btn-xs navbar-btn">
							LogIn
						</a> -->
					<?php endif; ?>

	<div id="content" class="">
