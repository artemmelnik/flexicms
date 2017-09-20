<?php $this->theme->header(); ?>

    <main>
        <div class="ui container">
            <div class="ui grid">
                <div class="sixteen wide column">
                    <div class="col page-title">
                        <h2 class="ui header">
                            Menus
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
                <div class="four wide column">
                    <?php if(!empty($menus)): ?>
                        <div class="ui vertical pointing menu">
                            <?php foreach($menus as $menu): ?>
                                <a class="item<?php if ($menuId == $menu->id) echo ' active'; ?>" href="?menu_id=<?php echo $menu->id ?>">
                                    <?php echo $menu->name ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-items">
                            <p>You do not have any menu created</p>
                        </div>
                    <?php endif; ?>
                    <a href="javascript:void(0)" class="ui primary button btn-create-menu">
                        Add Menu
                    </a>
                </div>
                <div class="twelve wide column">
                    <?php if ($menuId !== null): ?>
                        <input type="hidden" id="sortMenuId" value="<?php echo $menuId ?>" />
                        <ol id="listItems" class="edit-menu">
                            <?php foreach($editMenu as $item) {
                                Theme::block('setting/menu_item', [
                                    'item' => $item
                                ]);
                            } ?>
                        </ol>
                        <button class="ui basic button" onclick="menu.addItem(<?php echo $menuId ?>)">
                            <i class="plus icon"></i>
                            Add menu item
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <div id="addMenu" class="ui dimmer modals page transition">
        <div class="ui standard test modal transition hidden">
            <div class="ui mini test modal transition">
                <div class="header">
                    Create menu
                </div>
                <div class="content">
                    <div class="ui form">
                        <div class="required field">
                            <label>Name menu</label>
                            <input type="text" placeholder="Name menu..." id="menuName">
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <div class="ui negative button">
                        Cancel
                    </div>
                    <div class="ui positive right labeled icon button" onclick="menu.add();">
                        Create
                        <i class="checkmark icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->theme->footer(); ?>