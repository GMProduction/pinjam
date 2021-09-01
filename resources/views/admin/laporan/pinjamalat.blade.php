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
                                <option value="Di kembalikan">Di kembalikan</option>
                            </select>
                        </form>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#tambahsiswa">Cetak
                        </button>
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
                    Estimasi Kembali
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
                            {{$key + 1}}
                        </td>
                        <td>
                            {{date('d F Y', strtotime($g->tanggal_pinjam))}}
                        </td>
                        <td>
                            {{$g->tanggal_kembali ? date('d F Y', strtotime($g->tanggal_kembali)) : ''}}
                        </td>
                        <td>
                            {{$g->status == 5 ? date('d F Y', strtotime($g->updated_at)) : '-'}}
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
                                <a class="btn btn-primary btn-sm" onclick="konfirmasi(this)" data-status="5" data-id="{{$g->id}}" data-nama="{{$g->getBarang->nama_barang}}">Dikembalikan</a>
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


    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#statusCari').val('{{request('status')}}')

        })

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        $(document).on('change', '#statusCari', function () {
            document.getElementById('formCari').submit();
        })

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
