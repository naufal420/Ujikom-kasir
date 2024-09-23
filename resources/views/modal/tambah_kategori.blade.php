<div class="modal fade" id="tambah_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7F8">
            <div class="modal-header justify-content-center">
                <h1 class="fs-5" id="exampleModalLabel">Tambah Kategory</h1>
            </div>
            <div class="modal-body">
                <form action="{{ url('kategori') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control border-secondary" id="nama kategori"
                            name="nama_kategori" required>
                    </div>
                    <div class="modal-footer px-0 justify-content-start">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
