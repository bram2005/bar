<?php
$users = \possystem\modules\Users\Logic\Users::getInstance()->getAll();
$users = $users['result'];
$fmt = new NumberFormatter( 'nl_NL', NumberFormatter::CURRENCY);
$months = array(
    "January" => "Januari",
    "February" => "Februari",
    "March" => "Maart",
    "April" => "April",
    "May" => "Mei",
    "June" => "Juni",
    "July" => "Juli",
    "August" => "Augustus",
    "September" => "September",
    "October" => "Oktober",
    "November" => "November",
    "December" => "December"
);
foreach ($months as $month => $monthName) { ?>
    <div class='col-xl-12'>
        <div class='content-box'>
            <div class='content-box-title'><?= $monthName ?></div>
            <?php foreach ($users as $user) {
                $barservices = \possystem\modules\BarService\Logic\BarServices::getInstance()->getBarServiceByMonthAndUser($user->id,$month);
                if ($barservices['complete']) {
                    $barservices = $barservices['result']; ?>
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
<!--                    --><?php //foreach ($barservices as $barservice) {
//
//
//
//                        if (!empty($barservice->total_revenue) && $barservice->total_revenue != 0) {
//                            printr($barservice);
//                        }
//                    } ?>
                    </table>

                <?php }
            } ?>

        </div>
    </div>
<?php } ?>

