<?php $this->theme->header(); ?>

    <main>
        <div class="ui container">
            <div class="row">
                <div class="col page-title">
                    <h2 class="ui header">
                        Pages
                        <a href="/admin/pages/create/" class="ui primary button right floated item">
                            Create page
                        </a>
                    </h2>
                </div>
            </div>

            <table class="ui very basic table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($pages as $page): ?>
                <tr>
                    <th scope="row">
                        <?= $page->id ?>
                    </th>
                    <td>
                        <a href="/admin/pages/edit/<?= $page->id ?>">
                            <?= $page->title ?>
                        </a>
                    </td>
                    <td>
                        <?= $page->date ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

<?php $this->theme->footer(); ?>