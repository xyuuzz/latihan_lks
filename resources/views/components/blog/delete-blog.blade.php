<form id="deleteForm">
    @method("DELETE")
    @csrf
</form>

<button type="button" class="btn btn-outline-danger" onClick="ajax($('#deleteForm'), '/blog/{{$blog->slug}}', 'delete')">Hapus</button>
