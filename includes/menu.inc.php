<?php

?>

<ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
    <?php if ($controller->CheckIfLoggedIn()) { ?>
    <li>
        <a href="/" class="nav-link text-secondary text-center">
            <i class="fa-solid fa-house"></i><br/>
            <?= $config->pageTitleHome ?>
        </a>
    </li>
    <li>
        <a href="/?page=Receipts" class="nav-link text-center">
            <i class="fa-solid fa-file-invoice"></i><br/>
            <?= $config->pageTitleReceipts ?>
        </a>
    </li>
    <li>
        <a href="/?page=BarService" class="nav-link text-center">
            <i class="fa-solid fa-bell-concierge"></i><br/>
            <?= $config->pageTitleBarService ?>
        </a>
    </li>
    <li>
        <a href="/?page=Admin" class="nav-link text-center">
            <i class="fa-solid fa-gears"></i><br/>
            <?= $config->pageTitleAdmin ?>
        </a>
    </li>
        <?php printr($_GET); ?>
    <?php if (strpos($_GET['page'], 'Admin') !== false) { ?>
        <li>
            <a href="/?page=Admin" class="nav-link text-center">
                <i class="fa-solid fa-gears"></i><br/>
                <?= $config->pageTitleAdmin ?>
            </a>
        </li>
        <li>
            <a href="/?page=Admin" class="nav-link text-center">
                <i class="fa-solid fa-gears"></i><br/>
                <?= $config->pageTitleAdmin ?>
            </a>
        </li>
        <li>
            <a href="/?page=Admin" class="nav-link text-center">
                <i class="fa-solid fa-gears"></i><br/>
                <?= $config->pageTitleAdmin ?>
            </a>
        </li>
        <li>
            <a href="/?page=Admin" class="nav-link text-center">
                <i class="fa-solid fa-gears"></i><br/>
                <?= $config->pageTitleAdmin ?>
            </a>
        </li>
        <?php } ?>
    <li>
        <a href="/?page=Logout" class="nav-link text-center">
            <i class="fa-solid fa-arrow-right-to-bracket"></i><br/>
            <?= $config->pageTitleLogout ?>
        </a>
    </li>
    <?php } ?>
    <li>
        <a href="/?page=Login" class="nav-link text-center">
            <i class="fa-solid fa-arrow-right-to-bracket"></i><br/>
            <?= $config->pageTitleLogin ?>
        </a>
    </li>
</ul>
