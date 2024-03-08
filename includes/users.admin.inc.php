<?php
$users = \possystem\modules\Users\Logic\Users::getInstance()->getAll();
if (isset($_GET['userID']) && $_GET['type'] === "delete") {
    $user = \possystem\modules\Users\Logic\Users::getInstance()->remove($_GET['userID']);
    echo "<script>window.location.href='?page=Admin/Users';</script>";
//    header("Refresh:0;url=?page=Admin/Users");
    die();
}

if (isset($_POST['submit'])) {
    if($_GET['type'] === "edit") {
        $updateName = \possystem\modules\Users\Logic\Users::getInstance()->changeName($_GET['userID'], $_POST['name']);
        $updateUsername = \possystem\modules\Users\Logic\Users::getInstance()->changeUsername($_GET['userID'], $_POST['username']);
        $updatePermissiegroup = \possystem\modules\Users\Logic\Users::getInstance()->changePermissionGroup($_GET['userID'], $_POST['permissiongroup']);
    }
    if (!empty($_POST['passwordnew']) && !empty($_POST['passwordnew2'])) {
        if ($_POST['passwordnew'] === $_POST['passwordnew2']) {
            if($_GET['type'] === "new") {
                $addUser = \possystem\modules\Users\Logic\Users::getInstance()->add($_POST['name'], $_POST['username'], $_POST['passwordnew'], $_POST['permissiongroup']);
            } else {
                $updatePassword = \possystem\modules\Users\Logic\Users::getInstance()->changePassword($_GET['userID'], $_POST['passwordnew']);
            }
        } else { ?>
            <div class="alert alert-danger" role="alert">
                <span class="alert-title">FOUT OPGETREDEN</span><br/>
                Wachtwoorden komen niet overeen.
            </div>
        <?php }
    }
    echo "<script>window.location.href='?page=Admin/Users';</script>";
//    header("Refresh:0;url=?page=Admin/Users");
    die();
}
?>
<div class="top-bar">
    <a class="no-link" href="?page=Admin/Users&type=new"><button class="addReceipt" data-bs-toggle="modal" data-bs-target="#addReceipt"><i class="fa-solid fa-plus-large"></i></button></a>
</div>
<div class="col-xl-6 col-md-6">
    <div class="content-box">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">UserID</th>
                    <th scope="col">Naam</th>
                    <th scope="col">Gebruikersnaam</th>
                    <th scope="col">Permission Groep</th>
                    <th scope="col">Percentage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users['result'] as $user) { ?>
                    <tr>
                        <th scope="row"><?=$user->id?></th>
                        <td><?=$user->name?></td>
                        <td><?=$user->username?></td>
                        <td><?=$user->permission_group_id?></td>
                        <td><?=$user->percentage*100?>%</td>
                        <td>
                            <a class="no-link" href="?page=Admin/Users&userID=<?=$user->id?>&type=edit">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <a class="no-link" href="?page=Admin/Users&userID=<?=$user->id?>&type=delete">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php if(isset($_GET['type']) && ($_GET['type'] === "edit" || $_GET['type'] === "new")) {
    $user = "";
    if ($_GET['type'] === "edit") {
        $user = \possystem\modules\Users\Logic\Users::getInstance()->getByID($_GET['userID']);
        $user = $user['result'];
    }

    $permissionGroups = \possystem\modules\PermissionGroups\Logic\Permissiongroups::getInstance()->getAll();
    $permissionGroups = $permissionGroups['result'];

    ?>
<div class="col-xl-6 col-md-6">
    <div class="content-box">
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Naam</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($user->name) ? $user->name : "" ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Gebruikersnaam</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= isset($user->username) ? $user->username : "" ?>">
            </div>
            <div class="mb-3">
                <label for="permissiongroup" class="form-label">Permissie groep</label>
                <select class="form-select" name="permissiongroup" id="permissiongroup">
                    <?php foreach ($permissionGroups as $permissionGroup) { ?>
                        <option value="<?=$permissionGroup->id?>" <?= !empty($user->permission_group_id) && $user->permission_group_id === $permissionGroup->id ? "selected" : "" ?>><?=$permissionGroup->group_name?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="passwordnew" class="form-label">Nieuw Wachtwoord (Laat leeg als je niet wil aanpassen)</label>
                <input type="password" class="form-control" id="passwordnew" name="passwordnew">
            </div>
            <div class="mb-3">
                <label for="passwordnew2" class="form-label">Herhaal nieuw Wachtwoord (Laat leeg als je niet wil aanpassen)</label>
                <input type="password" class="form-control" id="passwordnew2" name="passwordnew2">
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Opslaan">
            </div>
        </form>
    </div>
</div>
<?php } ?>

