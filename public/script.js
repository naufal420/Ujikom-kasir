$(document).on("click", "#btn-edit-product", function () {
    // Ambil data dari atribut data-*
    let nama = $(this).data("nama");
    let harga = $(this).data("harga");
    let stock = $(this).data("stock");

    // Isi input modal dengan data yang diambil
    $("#nama_product").val(nama);
    $("#harga").val(harga);
    $("#stock").val(stock);

    // Ubah judul modal jika diperlukan
    $("#exampleModalLabel").text("Edit Product");
});
