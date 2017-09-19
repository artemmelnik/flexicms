<li class="menu-item-<?= $item->id ?>" data-id="<?= $item->id ?>">
    <i class="icon-pencil icons"></i> <input type="text" value="<?= $item->name ?>">
    <i class="icon-link icons"></i> <input type="text" value="<?= $item->link ?>">
    <div class="menu-item-event">
        <button class="button-remove" onclick="menu.removeItem(<?= $item->id ?>)">
            <i class="icon-trash icons"></i>
        </button>
        <i class="icon-cursor-move icons"></i>
    </div>
</li>