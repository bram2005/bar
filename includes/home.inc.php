<?php
$notificationObj = \possystem\modules\Notifications\Logic\Notifications::getInstance();
$notifications = $notificationObj->getAllByView();
$fmt = new NumberFormatter('nl_NL', NumberFormatter::CURRENCY);
//printr($_SESSION);
?>
<div class="col-12">
    <div class="content-box">
        <p class="content-box-title">Laatste updates</p>
        <?php
        if (empty($notifications['result'])) { ?>
            <p>Er zijn geen updates</p>
        <?php }
        foreach ($notifications['result'] as $notification) { ?>
            <div class="alert <?= $notification->priority_code ?>" role="alert">
                <span class="alert-title"><?= $notification->title ?></span><br/>
                <?= $notification->message ?>
            </div>
        <?php } ?>
    </div>
</div>
<div class="col-6">
    <div class="content-box">
        <p class="content-box-title">Bardienst</p>
        <table class="receipt">
            <tr>
                <th>Ingelogd als:</th>
                <td><?= $_SESSION['User']->name ?></td>
            </tr>
            <?php if (isset($_SESSION['BarService'])) { ?>
                <tr>
                    <th>Bardienst begonnen:</th>
                    <td><?= date("d-m-Y H:i:s", strtotime($_SESSION['BarService']->start_datetime)) ?></td>
                </tr>
                <?php if (isset($_SESSION['BarService']->end_datetime)) { ?>
                    <tr>
                        <th>Bardienst geeindigd:</th>
                        <td><?= date("d-m-Y H:i:s", strtotime($_SESSION['BarService']->end_datetime)) ?></td>
                    </tr>
                    <tr>
                        <th>Totale omzet:</th>
                        <td><?= $fmt->format($_SESSION['BarService']->total_revenue) ?></td>
                    </tr>
                <?php }
            } ?>
        </table>
        <form action="?page=StartAndStop" method="post">
            <div class="row">
                <?php if (!isset($_SESSION['BarService']) || $_SESSION['BarService']->end_datetime !== NULL) { ?>
                    <div class="col-6">
                        <input type="submit" name="start" class="service-btn service-start" value="Start bardienst"/>
                    </div>
                <?php } else { ?>
                    <div class="col-6">
                        <input type="submit" name="stop" class="service-btn service-stop" value="Stop bardienst"/>
                    </div>
                <?php } ?>
            </div>
        </form>
    </div>
    <?php if (isset($_SESSION['BarService']) && $_SESSION['BarService']->end_datetime === NULL) { ?>
        <div class="content-box">
            <p class="content-box-title">Opmerking</p>
            <p class="content-box-subtitle">
                <?= $_SESSION['BarService']->comments ?>
            </p>
            <div class="content-box-content">
                <form action="?page=Comment" method="post">
                    <div class="mb-3">
                        <textarea name="comment" class="form-control" rows="3" placeholder="Opmerking"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="submit" class="btn btn-success" value="Opslaan"/>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
</div>
<div class="col-6">
    <div class="content-box">
        <p class="content-box-title">Korte uitleg Bardienst</p>
        <p class="content-box-subtitle">Deze dingen dien je uit te voeren voor/tijdens of na je bardienst</p>
        <b>Voor de bardienst</b>
        <ul>
            <li>Bierviltjes op de bar leggen</li>
            <li>Koffie zetten</li>
            <li>Spoelbak vullen met water en klein beetje schoonmaakmiddel</li>
        </ul>

        <b>Na de bardienst</b>
        <ul>
            <li>Koelkasten bijvullen met voorraad uit magazijn</li>
            <li>Gebruikte viltjes bij oud papier gooien</li>
            <li>Alle elektrische apparaten uitzetten</li>
            <li>Bar + tafels schoonmaken met natte doek en droog maken</li>
            <li>Tap schoonmaken (Denk hierbij aan de ijzeren platen er uit te halen en eronder schoon te maken)</li>
            <li>Spoelborstel uitspoelen</li>
            <li>Tablet en pin automaat aan de lader leggen</li>
            <li>Lampen in kantine en omgeving uitzetten</li>
            <li>Alles op slot doen (Poortje bij bar, Keukendeur, Glazen deurtjes van kastjes)</li>
            <li>Sleutel terug in kluisje</li>
        </ul>
    </div>
</div>
