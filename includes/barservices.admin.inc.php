<?php
$barservices = \possystem\modules\BarService\Logic\BarServices::getInstance()->getAll();
$barservices = $barservices['result'];
$fmt = new NumberFormatter( 'nl_NL', NumberFormatter::CURRENCY );
foreach ($barservices as $barservice) {
    if (!empty($barservice->total_revenue) && $barservice->total_revenue != 0) {
//        printr($barservice);
    }
}
?>

<div class='col-xl-12'>
    <div class='content-box'>
        <div class='content-box-title'>Bardiensten</div>
        <table class="table table-striped">
            <tr>
                <th>Gebruiker</th>
                <th>Start datum</th>
                <th>Eind datum</th>
                <th>Omzet</th>
                <th>Fooien</th>
                <th>Opmerkingen</th>
                <th></th>
            </tr>
            <?php foreach ($barservices as $barservice) {
                if (!empty($barservice->total_revenue) && $barservice->total_revenue != 0) {
                    $user = \possystem\modules\Users\Logic\Users::getInstance()->getByID($barservice->user_id);
                    $user = $user['result']; ?>
                    <tr>
                        <td><?= $user->name ?></td>
                        <td><?= date("d-m-Y H:i", strtotime($barservice->start_datetime)) ?></td>
                        <td><?= date("d-m-Y H:i", strtotime($barservice->end_datetime)) ?></td>
                        <td><?= $fmt->format($barservice->total_revenue) ?></td>
                        <td><?= $fmt->format($barservice->total_tips) ?></td>
                        <td><?= $barservice->comments ?></td>
                        <td><a class="no-link" href="/?page=Admin/Barservice&barserviceID=<?= $barservice->id?>"><i class="fa-solid fa-eye"></i></a></td>
                    </tr>
                <?php }
            } ?>
        </table>
    </div>
</div>
