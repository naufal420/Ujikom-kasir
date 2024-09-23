<!-- Modal -->
<div class="modal fade" id="tambah_member" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7F8">
            <div class="modal-header justify-content-center">
                <h1 class="fs-5" id="exampleModalLabel">Tambah Member</h1>
            </div>
            <div class="modal-body">
                <form action="{{ url('member') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_member" class="form-label">Nama Member</label>
                        <input type="text" class="form-control border-secondary" id="nama_member" name="Nama_member"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="Alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control border-secondary" id="Alamat" name="Alamat"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="No telepon" class="form-label">No Telepon</label>
                        <input type="number" class="form-control border-secondary" id="No telepon" name="No_telepon"
                            required>
                    </div>
                    <div class="modal-footer px-0 justify-content-start">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
