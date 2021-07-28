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
                <button type="button ms-auto" class="btn btn-primary btn-sm" onclick="addData()">Tambah Data
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
                            <a class="btn btn-success btn-sm" id="editData"  data-id="{{$bar->id}}" data-name="{{$bar->nama_barang}}" data-qty="{{$bar->qty}}">Ubah
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{$bar->id}}', ' {{$bar->nama_barang}}') ">hapus</button>
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
                                <input id="id" name="id" hidden>
                                <div class="mb-3">
                                    <label for="namabarang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="qty" name="qty">
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

        function addData() {
            $('#tambahbarang #id').val('');
            $('#tambahbarang #nama_barang').val('');
            $('#tambahbarang #qty').val('');
            $('#tambahbarang').modal('show');
        }

       $(document).on('click', '#editData', function () {
           $('#tambahbarang #id').val($(this).data('id'));
           $('#tambahbarang #nama_barang').val($(this).data('name'));
           $('#tambahbarang #qty').val($(this).data('qty'));
           $('#tambahbarang').modal('show');
       })


        function hapus(id, name) {
            swal({
                title: "Menghapus data?",
                text: "Apa kamu yakin, ingin menghapus data "+name+"!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let data = {
                            '_token': '{{csrf_token()}}',
                        };
                       $.post('/admin/barang/delete/'+id,data ,function () {
                           swal("Berhasil Menghapus data!", {
                               icon: "success",
                           }).then((dat) => {
                               window.location.reload();
                           });
                       })
                    } else {
                        swal("Data belum terhapus");
                    }
                });
        }
    </script>

@endsection
