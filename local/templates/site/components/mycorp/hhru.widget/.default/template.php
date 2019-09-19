<?php

use Bitrix\Main\Localization\Loc;
use Citfact\SiteCore\Core;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}?>
<? if ($arResult['PHONE_NUMBER']): ?>
    <div class="title-3">
        Телефон отдела кадров <br>
        <? foreach ($arResult['PHONE_NUMBER'] as $phone) : ?>
            <a class="link" href="tel:<?= $phone ?>"><?= $phone ?></a><br>
        <? endforeach; ?>
    </div>
    <br>
<? endif ?>
<div class="careers-list__container">
    <script
            class="hh-script"
            src="https://api.hh.ru/widgets/vacancies/employer?employer_id=<?=$arResult['EMPLOYER_ID'];?>&locale=RU&links_color=1f92d1&border_color=ffffff<?=$arResult['HH_AREAS'];?>" data-skip-moving="true">
    </script>
</div>
