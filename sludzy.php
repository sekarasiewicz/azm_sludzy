<?php
require_once(dirname(__FILE__) . '/features/classes/Servants.php');
require_once(dirname(__FILE__) . '/features/classes/Rank.php');
$servantsObj = new Servants();
$servantsObj->connect();
$servantsObj->fetch_servants();

$rankObj = new Rank();
$rankObj->connect();
$rankObj->fetch_rank();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="Description"
          content="Strona jednego z najstarszych polskich klanów Diablo. Zrzeszamy graczy serii Diablo od 2000 roku. Od 2012 roku nasza działalność skupia się na scenie Diablo 3!"/>
    <meta name="Keywords"
          content="Diablo, Diablo 3, Diablo3, Diablo III, Klan, Clan, AZM, Clan AZM, Klan AZM, Słudzy Azmodana, Azmodan, forum, PvP, d3cl, "/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <title>Słudzy Azmodana =AZM= klan Diablo 3</title>
    <script type='text/javascript' src='jquery-1.10.js'></script>
    <script src='nprogress.js'></script>
    <link rel="stylesheet" type="text/css" media="all" href="nprogress.css"/>
    <script>
        //        NProgress.start();
    </script>
</head>
<body>
<div id="tabela">

    <div id="logo">
        <? include('gora.php') ?>
    </div>
    <div id="lewo">
        <? include('lewo.php') ?>
    </div>


    <div id="srodek">
        <div id="srodek2">
            <div id="tekst">
                <p class="summary">
                    Ostatnia aktualizacja: <span class="glowing-text"><? print_r($servantsObj->last_added()) ?></span>
                    <br/>
                    Lista Sług Azmodana liczy sobie
                    <span class="glowing-text"><?php echo $servantsObj->count() ?></span> członków w tym:
                </p>
                <ul>
                    <?php
                    foreach ($servantsObj->ranks_count() as $rank_id => $count) {
                        ?>
                        <li><span
                                class="glowing-text"><?= $count ?></span> <?= $rankObj->find_rank_by_id($rank_id)->name ?>
                        </li>
                    <?php } ?>
                </ul>
                <?php
                foreach ($servantsObj->grouped_servants_by_rank() as $rank_id => $servants) {
                    $rank = $rankObj->find_rank_by_id($rank_id);
                    ?>
                    <div class="d2"></div>
                    <div class="dark-decor" style="color: <?= $rank->header_color ?>"><?= $rank->name ?></div>
                    <div class="d1"></div>
                    <?php
                    foreach ($servants as $servant) {
                        ?>
                        <div
                            style="line-height:20px;width:400px;background-image: url(<?=Helpers::avatar($servant)?>);background-repeat:no-repeat;background-position:22px 50%;background-size: 60px 60px;">
                            <div
                                style="background-image: url(http://azmklan.org/grafika/sludzy.png);width:399px;height:110px;margin:auto;text-align:left;">
                                <div style="width:100px;height:110px;float: left;"></div>
                                <div style="width:65px;float: left;margin-top: 20px">Nick:<br/>Paragon:<br/>Ranga:<br/>W
                                    AZM od:
                                </div>
                                <div style="width:100px;float: left;margin-top: 20px"><strong>
                                        <span class="glowing-text" style="color: <?= $rank->header_color ?>"><?= $servant->nick ?></span> <a
                                            href="http://eu.battle.net/d3/pl/profile/<?= $servant->battle_tag ?>/"
                                            target="_blank"
                                            title="<?= $servant->battle_tag ?>"><img src="http://azmklan.org/grafika/favicon.ico" height="13" alt="Profil"></a>
                                        <br />
                                        <span class="paragon" data-battletag="<?= $servant->battle_tag ?>">&nbsp;</span>
                                        <br />
                                        <?= $rank->short_name ?>
                                        <br/>
                                        <?= $servant->in_from ?>
                                    </strong></div>
                                <div style="width:55px;float: left;margin-top: 20px">Imię:<br/>Rocznik:<br/>Miasto:<br/>Status:
                                </div>
                                <div style="width:50px;float: left;margin-top: 20px"><strong>
                                        <?= $servant->name ?>
                                        <br/>
                                        <?= $servant->year_of_birth ?>
                                        <br/>
                                        <?= empty($servant->city) ? '&nbsp;' : $servant->city ?>
                                        <?= Helpers::servant_status($servant->status) ?>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
        <? include('stopka.php') ?>
    </div>
    <div id="prawo">
        <? include('prawo.php') ?>
    </div>
</div>


<? include('pasek.php') ?>
<script src='scripts/ajax.js'></script>
</body>
</html>
