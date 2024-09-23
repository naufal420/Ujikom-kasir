<div class="modal fade" id="tambah_kasir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7F8">
            <div class="modal-header justify-content-center">
                <h1 class="fs-5" id="exampleModalLabel">Tambah kasir</h1>
            </div>
            <div class="modal-body">
                <form action="{{ url('kasir') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control border-secondary" id="name" name="name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control border-secondary" id="email" name="email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password" class="form-control border-secondary" id="password" name="password"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No Telepon</label>
                        <input type="number" class="form-control border-secondary" id="no_telepon" name="no_telepon"
                            required>
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
