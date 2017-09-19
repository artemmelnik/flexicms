<?php $this->theme->header(); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col page-title">
                    <h3>Menus</h3>
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
                <div class="col-4">
                    <h4 class="heading-setting-section">
                        List menu
                        <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#addMenu" data-whatever="@getbootstrap">
                            Add Menu
                        </a>
                    </h4>
                    <?php if(!empty($menus)): ?>
                        <div class="menu-list">
                            <ul class="nav flex-column">
                                <?php foreach($menus as $menu): ?>
                                    <li class="nav-item">
                                        <a class="nav-link<?php if ($menuId == $menu->id) echo ' active'; ?>" href="?menu_id=<?php echo $menu->id ?>">
                                            <?php echo $menu->name ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="empty-items">
                            <p>You do not have any menu created</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-8">
                    <?php if ($menuId !== null): ?>
                        <h4 class="heading-setting-section">
                            Edit menu
                        </h4>
                        <br>
                        <input type="hidden" id="sortMenuId" value="<?php echo $menuId ?>" />
                        <ol id="listItems" class="edit-menu">
                            <?php foreach($editMenu as $item) {
                                Theme::block('setting/menu_item', [
                                    'item' => $item
                                ]);
                            } ?>
                        </ol>
                        <button class="add-item-button" onclick="menu.addItem(<?php echo $menuId ?>)">
                            <i class="icon-plus icons"></i> Add menu item
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="addMenuLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuLabel">New menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="menuName" class="form-control-label">Name menu</label>
                            <input type="text" class="form-control" id="menuName">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="menu.add();">
                        Save menu
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $this->theme->footer(); ?>