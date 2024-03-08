<?php

if($_GET['type'] === "changeNotificationView") {
    $notification = \possystem\modules\Notifications\Logic\Notifications::getInstance()->changeView($_GET['notificationID']);
    echo "<script>window.location.href='?page=Admin/Notification';</script>";
//    header("Location: ?page=Admin/Notifications");
    die();
}
if ($_GET['type'] !== "new") {
    $notification = \possystem\modules\Notifications\Logic\Notifications::getInstance()->getByID($_GET['notificationID']);
}
$prioritys = \possystem\modules\Prioritys\Logic\Prioritys::getInstance()->getAll();

if(isset($_POST['submit'])) {
    if ($_GET['type'] === "new") {
        $notification = \possystem\modules\Notifications\Logic\Notifications::getInstance()->add($_POST['title'], $_POST['message'], $_POST['priority']);
    } else {
        $notification = \possystem\modules\Notifications\Logic\Notifications::getInstance()->change($_GET['notificationID'], $_POST['title'], $_POST['message'], $_POST['priority']);
    }
    echo "<script>window.location.href='?page=Admin/Notifications';</script>";
//    header("Location: ?page=Admin/Notifications");
    die();
}

?>

<div class="col-md-6">
    <div class="content-box">
        <div class="content-box-title">Meldingen</div>
        <div class="content-box-content">
            <form method="post">
                <div class="mb-3">
                    <label for="title">Titel</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $notification['result']->title ?? "" ?>">
                </div>
                <div class="mb-3">
                    <label for="message">Bericht</label>
                    <textarea class="form-control" id="message" name="message" rows="3"><?=$notification['result']->message  ?? "" ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="priority">Prioriteit</label>
                    <select class="form-select" id="priority" name="priority">
                        <?php foreach($prioritys['result'] as $priority) { ?>
                            <option value="<?=$priority->id?>" <?php if(isset($notification['result']->priority_id) && $notification['result']->priority_id === $priority->id) { ?>selected<?php } ?>><?=$priority->name?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="submit" name="submit" class="btn btn-primary" value="Opslaan"/>
                </div>
            </form>
        </div>
    </div>
</div>
