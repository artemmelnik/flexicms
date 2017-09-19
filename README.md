# README #

This README would normally document whatever steps are necessary to get your application up and running.

### Get menu by id ###
```
<?php foreach (Menu::getItems(2) as $item): ?>
	<a href="#" class="item"><?= $item->name ?></a>
<?php endforeach; ?>
```