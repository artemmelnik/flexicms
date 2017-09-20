<?php $this->theme->header(); ?>

    <main>
        <div class="ui container">
            <div class="row">
                <div class="col page-title">
                    <h2 class="ui header">
                        Posts
                        <a href="/admin/posts/create/" class="ui primary button right floated item">
                            Create post
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
                <?php foreach($posts as $post): ?>
                    <tr>
                        <th scope="row">
                            <?= $post->id ?>
                        </th>
                        <td>
                            <a href="/admin/posts/edit/<?= $post->id ?>">
                                <?= $post->title ?>
                            </a>
                        </td>
                        <td>
                            <?= $post->date ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

<?php $this->theme->footer(); ?>