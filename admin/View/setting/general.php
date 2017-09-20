<?php $this->theme->header(); ?>

<main>
    <div class="ui container">
        <div class="ui grid">
            <div class="sixteen wide column">
                <div class="col page-title">
                    <h2 class="ui header">
                        Settings
                    </h2>
                </div>
            </div>
        </div>
        <div class="ui grid">
            <div class="sixteen wide column">
                <div class="setting-tabs">
                    <?php Theme::block('setting/tabs') ?>
                </div>
            </div>
        </div>

        <div class="ui grid">
            <div class="sixteen wide column">
                <form id="settingForm" class="ui form">
                    <?php foreach($settings as $setting):?>
                        <?php if($setting->key_field == 'language'): ?>
                            <div class="field">
                                <label>
                                    <?= $setting->name ?>
                                </label>
                                <select name="<?= $setting->key_field ?>" class="ui search dropdown">
                                    <?php foreach($languages as $language): ?>
                                        <option value="<?= $language->info->key ?>">
                                            <?= $language->info->title ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php else: ?>
                            <div class="field">
                                <label>
                                    <?= $setting->name ?>
                                </label>
                                <input type="text" name="<?= $setting->key_field ?>" value="<?= $setting->value ?>">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <button type="submit" class="ui primary button" onclick="setting.update(this); return false;">
                        Save changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->theme->footer(); ?>