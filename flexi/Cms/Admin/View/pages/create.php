<main>
    <div class="ui container">
        <div class="ui grid">
            <div class="sixteen wide column">
                <div class="col page-title">
                    <h2 class="ui header">
                        Create page
                    </h2>
                </div>
            </div>
        </div>
        <div class="ui grid">
            <div class="twelve wide column">
                <form id="formPage" class="ui form">
                    <div class="field">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" id="formTitle" placeholder="Title page...">
                    </div>
                    <div class="field">
                        <label>Content</label>
                        <textarea name="content" id="redactor"></textarea>
                    </div>
                </form>
            </div>
            <div class="four wide column">
                <div>
                    <p>Publish this page</p>
                    <button type="submit" class="ui primary button" onclick="page.add()">
                        Publish
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>