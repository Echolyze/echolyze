<?php
    //If user is not signed in refirect
    if(!$user->isSigned()) redirect("../login");
    echo '<script>console.log("auth is checked, good to go!");</script>';

    include 'app-includes/header.php';
    include 'app-includes/leftnav.php';
?>

<div class="content-wrapper">
    <section class="content-header content-header-pe">
        <h1 class="col-xs-6 omega">Account Management</h1>
    </section>
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
            <div id="" class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">User Details</h3>
                </div>
                <form method="post" action="<?php echo $base ?>/ps/update.php" data-success="<?php echo $base?>/account">
                <div class="box-body">
                    <div class="form-group">
                        <label>Username:</label>
                        <input disabled name="Username" type="text" value="<?php echo $user->Username?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>First Name:</label>
                        <input name="first_name" type="text" value="<?php echo $user->first_name?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Last Name:</label>
                        <input name="last_name" type="text" value="<?php echo $user->last_name?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email: </label>
                        <input name="Email" type="text" required value="<?php echo $user->Email?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Website: </label>
                        <input name="website" type="text" value="<?php echo $user->website?>" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                </form>
            </div>
            <div id="" class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Change Password</h3>
                </div>
                <form method="post" action="<?php echo $base?>/ps/change_password.php" data-success="<?php echo $base?>/account">
                <div class="box-body">
                    <div class="form-group">
                        <label>New Password:</label>
                        <input name="Password" type="password" class="form-control" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Confirm New Password:</label>
                        <input name="Password2" type="password" class="form-control" required>
                    </div>
                    <input name="c" type="hidden" value="<?php echo getVar("c")?>">

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>
</div>

<!-- <div class="row">
    <div class="col-xs-12">
        <div class="btn-group pull-right2">
            <a class="btn btn-primary" href="account/update">Update Information</a>
            <a class="btn btn-primary" href="account/update/password">Change Password</a>
        </div>
        <table class="table">
            <?php foreach ($user->toArray() as $name => $value): ?>
                <tr>
                    <th><?php echo $name ?></th>
                    <td><?php echo $value ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div> -->