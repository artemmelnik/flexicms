<?php $this->theme->header(); ?>

    <main>
        <div class="ui container">
            <div class="ui grid">
                <div class="sixteen wide column">
                    <div class="col page-title">
                        <h2 class="ui header">
                            <?= $page->title ?>
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
                    <div>
                        <p>Update this page</p>
                        <button type="submit" class="ui primary button" onclick="page.update()">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php $this->theme->footer(); ?>