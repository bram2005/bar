<?php
$notfifications = \possystem\modules\Notifications\Logic\Notifications::getInstance()->getAll();
$notfifications = $notfifications['result'];

?>

<div class="top-bar">
    <a class="no-link" href="?page=Admin/Notification&type=new"><button class="addReceipt" data-bs-toggle="modal" data-bs-target="#addReceipt"><i class="fa-solid fa-plus-large"></i></button></a>
</div>

<div class="col-12">
    <div class="content-box">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Aangemaakt op</th>
                    <th scope="col">Titel</th>
                    <th scope="col">Bericht</th>
                    <th scope="col">Prioriteit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($notfifications as $notification) {
                    $priority = \possystem\modules\Prioritys\Logic\Prioritys::getInstance()->getByID($notification->priority_id);
                    ?>
                    <tr>
                        <th scope="row"><?=$notification->datetime?></th>
                        <td><?= $notification->title ?></td>
                        <td><?= $notification->message ?></td>
                        <td><?= $priority['result']->name ?></td>
                        <td>
                            <?php
                            if ($notification->view) {
                                ?>
                                <a class="no-link" href="?page=Admin/Notification&notificationID=<?=$notification->id?>&type=changeNotificationView"><i class="fa-solid fa-eye-slash"></i></a>
                                <?php
                            } else {
                                ?>
                                <a class="no-link" href="?page=Admin/Notification&notificationID=<?=$notification->id?>&type=changeNotificationView"><i class="fa-solid fa-eye"></i></a>
                                <?php
                            }
                            ?>
                            <a class="no-link" href="?page=Admin/Notification&notificationID=<?=$notification->id?>&type=edit">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
