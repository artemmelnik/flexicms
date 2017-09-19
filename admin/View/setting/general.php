<?php $this->theme->header(); ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col page-title">
                <h3>Settings</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="setting-tabs">
                    <?php Theme::block('setting/tabs') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form id="settingForm">
                    <?php foreach($settings as $setting):?>
                        <?php if($setting->key_field == 'language'): ?>
                            <div class="form-group row">
                                <label for="formLangSite" class="col-2 col-form-label">
                                    <?= $setting->name ?>
                                </label>
                                <div class="col-10">
                                    <select class="form-control" name="<?= $setting->key_field ?>" id="formLangSite">
                                        <?php foreach($languages as $language): ?>
                                            <option value="<?= $language->info->key ?>">
                                                <?= $language->info->title ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="form-group row">
                                <label for="formNameSite" class="col-2 col-form-label">
                                    <?= $setting->name ?>
                                </label>
                                <div class="col-10">
                                    <input class="form-control" type="text" name="<?= $setting->key_field ?>" value="<?= $setting->value ?>" id="formNameSite">
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary" onclick="setting.update(); return false;">
                        Save changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->theme->footer(); ?>