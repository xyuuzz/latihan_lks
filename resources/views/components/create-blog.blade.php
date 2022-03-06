<div>
    <div class="modal fade" id="fromModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="createBlog">
                        @csrf
                        <div class="form-group">
                            <label class="" for="title">Judul Blog</label>
                            <input required type="text" name="title" id="title" class="form-control">
                            <span class="title-error d-none text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="body">Deskripsi Blog</label>
                            <textarea required name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                            <span class="body-error d-none text-danger"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
                    <button onClick="ajax($('#createBlog'), '/blog', 'create')" type="button" class="ajax btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
