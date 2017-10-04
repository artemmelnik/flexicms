<div class="ui secondary pointing menu">
    <?php foreach (Customize::getInstance()->getAdminSettingItems() as $key => $item): ?>
        <a class="item<?php if (\Engine\Helper\Common::isLinkActive($key)) echo ' active'; ?>" href="<?= $item['urlPath'] ?>">
            <?= $item['title'] ?>
        </a>
    <?php endforeach; ?>
</div>