@extends('admin.base')

@section('title')
    Data Laporan Peminjaman
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
                <h5>Data Laporan Peminjaman</h5>
                <div style="width: 300px">
                    <a>Status</a>
                    <div class="d-flex">
                        <form id="formCari">
                            <select class="form-select me-2" aria-label="Default select example" id="statusCari" name="status">
                                <option value="">Semua</option>
                                <option value="Menunggu Staff">Menunggu Staff</option>
                                <option value="Menunggu Guru">Menunggu Guru</option>
                                <option value="Menunggu Siswa Ambil">Menunggu Siswa Ambil</option>
                                <option value="Di pinjam">Di pinjam</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                <th>
                    #
                </th>
                <th>
                    Tanggal Pinjam
                </th>
                <th>
                    Tanggal Kembali
                </th>
                <th>
                    Nama Barang
                </th>
                <th>
                    Qty
                </th>

                <th>
                    Siswa
                </th>

                <th>
                    Mapel
                </th>


                <th>
                    Action
                </th>

                </thead>

                @forelse($pinjam as $key => $g)
                    <tr>
                        <td>
                            {{$pinjam->firstItem() + $key}}
                        </td>
                        <td>
                            {{date('d F Y', strtotime($g->tanggal_pinjam))}}
                        </td>
                        <td style="{{$g->tanggal_kembali < now('Asia/Jakarta') ? ' color: red' : ''}}">
                            {{$g->tanggal_kembali ? date('d F Y', strtotime($g->tanggal_kembali)) : ''}}
                        </td>
                        <td>
                            {{$g->getBarang->nama_barang}}
                        </td>
                        <td>
                            {{$g->qty}}
                        </td>
                        <td>
                            {{$g->getSiswa->nama}}
                        </td>
                        <td>
                            {{$g->getMapel->nama_mapel}}
                        </td>

                        <td>
                            @if($g->status == 0)
                                <a class="btn btn-primary btn-sm" onclick="konfirmasi(this)" data-status="2" data-id="{{$g->id}}" data-nama="{{$g->getBarang->nama_barang}}">Terima</a>
                                <a class="btn btn-danger btn-sm" onclick="konfirmasi(this)" data-status="1" data-id="{{$g->id}}" data-nama="{{$g->getBarang->nama_barang}}">Tolak</a>
                            @elseif($g->status == 3)
                                <a class="btn btn-primary btn-sm" onclick="konfirmasi(this)" data-status="4" data-id="{{$g->id}}" data-nama="{{$g->getBarang->nama_barang}}">Diambil</a>
                            @elseif($g->status == 4)
                                <a class="btn btn-primary btn-sm" id="kembali" data-status="5" data-id="{{$g->id}}" data-nama="{{$g->getBarang->nama_barang}}">Dikembalikan</a>
                            @elseif($g->status == 1)
                                <label>Ditolak Staf</label>
                            @elseif($g->status == 11)
                                <label>Ditolak Guru</label>
                            @elseif($g->status == 2)
                                <label>Menunggu konfirmasi guru</label>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data pinjaman</td>
                    </tr>
                @endforelse
            </table>
            <div class="d-flex justify-content-end">
                {{$pinjam->links()}}
            </div>
        </div>

        <div class="modal fade" id="barandiambil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form" onsubmit="return konfirmasiKembali()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <input id="status" name="status" hidden>
                            <div class="mb-3">
                                <label for="namabarang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="namabarang" name="namabarang">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Kondisi Barang</label>
                                <textarea class="form-control" id="keterangan" name="kondisi_barang"></textarea>
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
        $(document).on('click', '#kembali', function () {
            var id = $(this).data('id')
            var nama = $(this).data('nama')
            var status = $(this).data('status')

            $('#barandiambil #id').val(id)
            $('#barandiambil #namabarang').val(nama)
            $('#barandiambil #status').val(status)
            $('#barandiambil').modal('show')
        })

        $(document).ready(function () {
            $('#statusCari').val('{{request('status')}}')

        })

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        $(document).on('change', '#statusCari', function () {
            document.getElementById('formCari').submit();
        })

        function konfirmasiKembali() {
            swal({
                title: "Pengembalian Pinjaman ?",
                text: "Apa kamu yakin ingin kembalikan peminjaman barang " + $('#barandiambil #namabarang') + "? ",
                icon: "info",
                buttons: true,
                primariMode: true,
            })
                .then((res) => {
                    if (res) {
                        $.ajax({
                            type: "POST",
                            url: '/admin/laporanpinjaman',
                            data: $('#form').serialize(),
                            headers: {
                                'Accept': "application/json"
                            },
                            success: function (data, textStatus, xhr) {
                                if (xhr.status === 200) {
                                    swal("Pinjaman berhasil dikembalikan ", {
                                        icon: "success",
                                    }).then((dat) => {
                                        window.location.reload();
                                    });
                                } else {
                                    swal(data['msg'])
                                }
                                console.log()
                            },
                            complete: function (xhr, textStatus) {
                                console.log(xhr.status);
                                console.log(textStatus);
                            },
                            error: function (error, xhr, textStatus) {
                                console.log("LOG ERROR", error.responseJSON.errors);
                                console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                                console.log(xhr.status);
                                console.log(textStatus);
                                swal(error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0])
                            }
                        })
                    }
                });
            return false;
        }

        function konfirmasi(data) {
            var nama = $(data).data('nama');
            var status = $(data).data('status');
            var id = $(data).data('id');

            var txtStatus = 'terima';
            if (status === 1) {
                txtStatus = 'tolak'
            } else if (status === 4) {
                txtStatus = 'diambil'
            } else if (status === 5) {
                txtStatus = 'dikembalikan'
            }

            let dataSend = {
                '_token': '{{csrf_token()}}',
                'id': id,
                'status': status
            };

            swal({
                title: capitalizeFirstLetter(txtStatus) + " Pinjaman?",
                text: "Apa kamu yakin ingin " + txtStatus + " peminjaman barang " + nama + "? ",
                icon: "info",
                buttons: true,
                primariMode: true,
            })
                .then((res) => {
                    if (res) {
                        $.ajax({
                            type: "POST",
                            data: dataSend,
                            headers: {
                                'Accept': "application/json"
                            },
                            success: function (data, textStatus, xhr) {
                                if (xhr.status === 200) {
                                    swal("Pinjaman berhasil " + txtStatus + " data!", {
                                        icon: "success",
                                    }).then((dat) => {
                                        window.location.reload();
                                    });
                                } else {
                                    swal(data['msg'])
                                }
                                console.log()
                            },
                            complete: function (xhr, textStatus) {
                                console.log(xhr.status);
                                console.log(textStatus);
                            },
                            error: function (error, xhr, textStatus) {
                                console.log("LOG ERROR", error.responseJSON.errors);
                                console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                                console.log(xhr.status);
                                console.log(textStatus);
                                swal(error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0])
                            }
                        })
                    }
                });
        }

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
                        swal("Berhasil Menghapus data!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data belum terhapus");
                    }
                });
        }
    </script>
    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>
@endsection
