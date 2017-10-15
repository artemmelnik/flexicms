<?php $this->theme->header(); ?>

    <main>
        <div class="ui container">
            <div class="ui grid">
                <div class="sixteen wide column">
                    <div class="col page-title">
                        <h2 class="ui header">
                            Plugins
                        </h2>
                    </div>
                </div>
            </div>

            <div class="ui grid">
                <div class="sixteen wide column">
                    <table class="ui compact celled definition table">
                        <thead class="full-width">
                        <tr>
                            <th></th>
                            <th>Plugin</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($plugins as $directory => $plugin): ?>
                            <tr class="top aligned">
                                <td class="collapsing">
                                    <div class="ui fitted toggle checkbox">
                                        <input type="checkbox" data-active="<?php echo $plugin['is_active'] ?>" onchange="plugin.activate(this, <?php echo $plugin['plugin_id'] ?>)"<?php if ($plugin['is_active']) echo ' checked'; ?>>
                                        <label></label>
                                    </div>
                                </td>
                                <td>
                                    <?= $plugin['name'] ?><br>
                                    <?php if ($plugin['is_install']): ?>
                                        <span class="disabled" style="color: #909090">
                                            Installed
                                        </span>
                                    <?php else: ?>
                                        <a href="javascript:void(0)" onclick="plugin.install(this, '<?php echo $directory ?>')">
                                            Install
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= $plugin['description'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot class="full-width">
                        <tr>
                            <th></th>
                            <th colspan="4">
                                <div class="ui right floated small primary labeled icon button">
                                    <i class="upload icon"></i> Add Plugin
                                </div>
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>

<?php $this->theme->footer(); ?>