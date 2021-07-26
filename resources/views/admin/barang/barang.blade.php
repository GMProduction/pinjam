@extends('admin.base')

@section('title')
    Data Barang
@endsection

@section('content')

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            swal("Berhasil!", "Berhasil Menambah data!", "success");
        </script>
    @endif

    <section class="m-2">


        <div class="table-container">


            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Barang</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#tambahbarang">Tambah Data
                </button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                <th>
                    #
                </th>
                <th>
                    Gambar
                </th>
                <th>
                    Nama Barang
                </th>
                <th>
                    Jumlah
                </th>

                <th>
                    Stock
                </th>

                <th>
                    Action
                </th>

                </thead>

                @forelse  ($barang as $key => $bar)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{$bar->nama_barang}}
                        </td>
                        <td>
                        {{$bar->qty}}
                        </td>
                        <td>
                            {{$bar->stok}}
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editbarang">Ubah
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada barang</td>
                    </tr>

                @endforelse

            </table>

        </div>



            <!-- Modal Tambah-->
            <div class="modal fade" id="tambahbarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="namabarang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="namaeditbarang" name="nama_barang">
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlahedit" name="qty">
                                </div>

                                <div class="mb-4"></div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>



    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {

        })

        function hapus(id, name) {
            swal({
                title: "Menghapus data?",
                text: "Apa kamu yakin, ingin menghapus data ?!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                       $.post('/admin/barang/'+id, function () {
                           swal("Berhasil Menghapus data!", {
                               icon: "success",
                           });
                       })
                    } else {
                        swal("Data belum terhapus");
                    }
                });
        }
    </script>

@endsection
