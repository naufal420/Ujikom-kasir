 @extends('layouts.app')

 @section('content')
     <div class="card w-50 mx-auto" style="background-color: #F5F7F8">
         <div class="card-header">
             <h5 class="text-center card-title">Edit Product</h5>
         </div>
         <div class="card-body">
             <form class="" action="{{ url('product/' . $data->id_product) }}" method="POST">
                 @csrf
                 @method('PUT')
                 <div class="mb-3">
                     <label for="nama_product" class="form-label">Nama Product</label>
                     <input type="text" class="form-control border-secondary" id="nama_product" name="nama_product"
                         value="{{ $data->nama_product }}">
                 </div>
                 <div class="mb-3">
                     <label for="harga" class="form-label">Harga</label>
                     <input type="number" class="form-control border-secondary" id="harga" name="harga"
                         value="{{ $data->harga }}">
                 </div>

                 <div class="mb-3">
                     <label for="stock" class="form-label">Stock</label>
                     <input type="number" class="form-control border-secondary" id="stock" name="stock"
                         value="{{ $data->stock }}">
                 </div>

                 <div class="mb-3">
                     <select class="form-select border-secondary" aria-label="Default select example" name="id_kategori"
                         id="id_kategori">
                         <option disabled value>Pilih kategory</option>
                         @foreach ($kategori as $item)
                             <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                         @endforeach
                     </select>
                 </div>

                 <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
             </form>
         </div>
     </div>
 @endsection
