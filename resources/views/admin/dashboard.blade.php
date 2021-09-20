@extends('admin.base')
@section('title')
    Dashboard
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <h5 class="mb-3">Permintaan peminjaman barang</h5>

            <table class="table table-striped table-bordered ">
                <thead>
                <th>
                    #
                </th>
                <th>
                    Tanggal Pinjam
                </th>
                <th>Tanggal Kembali
                </th>
                <th>
                    Nama Barang
                </th>
                <th>
                    Jumlah Pinjam
                </th>

                <th>
                    Nama Siswa
                </th>

                <th>
                    Mapel
                </th>


                <th>
                    Action
                </th>

                </thead>

                @forelse($proses as $key => $g)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{date('d F Y', strtotime($g->tanggal_pinjam))}}
                        </td>
                        <td>
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
                                <a class="btn btn-primary btn-sm" onclick="konfirmasi(this)"  data-status="4" data-id="{{$g->id}}" data-nama="{{$g->getBarang->nama_barang}}">Diambil</a>
                            @elseif($g->status == 4)
                                <a class="btn btn-primary btn-sm" id="diambil" data-status="5" data-id="{{$g->id}}" data-nama="{{$g->getBarang->nama_barang}}">Dikembalikan</a>
                            @elseif($g->status == 1)
                                <label>Ditolak</label>
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

        </div>

        <div class="table-container">

            <h5 class="mb-3">Barang yang sedang di pinjam</h5>

            <table class="table table-striped table-bordered ">
                <thead>
                <th>
                    #
                </th>
                <th>
                    Tanggal Pinjam
                </th>
                <th>Tanggal Kembali
                </th>
                <th>
                    Nama Barang
                </th>
                <th>
                    Jumlah Pinjam
                </th>

                <th>
                    Nama Siswa
                </th>

                <th>
                    Mapel
                </th>

                <th>
                    Status
                </th>

                </thead>

                @forelse($pinjam as $key => $g)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{date('d F Y', strtotime($g->tanggal_pinjam))}}
                        </td>
                        <td style="{{$g->tanggal_kembali < now('Asia/Jakarta') ? 'color: red' : ''}}">
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
                            <input id="id" name="id" >
                            <input id="status" name="status" >
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

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

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
                            url: '/admin/laporanpinjaman',
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
    </script>
@endsection
