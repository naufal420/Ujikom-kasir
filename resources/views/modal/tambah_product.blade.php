<!-- Modal -->
<div class="modal fade" id="tambah_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7F8">
            <div class="modal-header justify-content-center">
                <h1 class="fs-5" id="exampleModalLabel">Tambah product</h1>
            </div>
            <div class="modal-body">
                <form action="{{ url('product') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_product" class="form-label">Nama Product</label>
                        <input type="text" class="form-control border-secondary" id="nama_product"
                            name="nama_product">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control border-secondary" id="harga" name="harga">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control border-secondary" id="stock" name="stock">
                    </div>
                    <div class="mb-3">
                        <select class="form-select border-secondary" aria-label="Default select example"
                            name="id_kategori" id="id_kategori">
                            <option disabled value>Pilih kategory</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer px-0 justify-content-start">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
