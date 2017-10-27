<?php $this->theme->header(); ?>

    <main>
        <div class="ui container">
            <div class="ui grid">
                <div class="sixteen wide column">
                    <div class="col page-title">
                        <h2 class="ui header">
                            <?= $page->title ?>
                            <div class="sub header grey">
                                <?php echo $baseUrl . '/page/' . \Engine\Helper\Text::transliteration($page->title) ?>
                            </div>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="ui grid">
                <div class="twelve wide column">
                    <form id="formPage" class="ui form">
                        <input type="hidden" name="page_id" id="formPageId" value="<?= $page->id ?>" />
                        <div class="field">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" id="formTitle" value="<?= $page->title ?>" placeholder="Title page...">
                        </div>
                        <div class="field">
                            <label>Content</label>
                            <textarea name="content" id="redactor"><?= $page->content ?></textarea>
                        </div>
                    </form>
                </div>
                <div class="four wide column">
                    <div class="ui segments">
                        <div class="ui blue segment">
                            <h4>Update</h4>
                        </div>
                        <div class="ui form segment">
                            <div class="field">
                                <label>Статус</label>
                                <select id="status" class="ui search dropdown">
                                    <option value="publish"<?php if ('publish' == $page->status) echo ' selected'; ?>>Опубликовано</option>
                                    <option value="draft"<?php if ('draft' == $page->status) echo ' selected'; ?>>В корзине</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui secondary segment">
                            <p>Update this page</p>
                            <button type="submit" class="ui primary button" onclick="page.update(this)">
                                Update
                            </button>
                        </div>
                    </div>

                    <div class="ui segments">
                        <div class="ui blue segment">
                            <h4>Setting</h4>
                        </div>
                        <div class="ui form segment">
                            <div class="field">
                                <label>Type page</label>
                                <select id="type" class="ui search dropdown">
                                    <option value="page">Basic</option>
                                    <?php foreach (getTypes('page') as $key => $type): ?>
                                        <option value="<?php echo $key ?>"<?php if ($key == $page->type) echo ' selected'; ?>>
                                            <?php echo $type ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php $this->theme->footer(); ?>