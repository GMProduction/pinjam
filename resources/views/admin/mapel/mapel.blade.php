@extends('admin.base')

@section('title')
    Data Mapel
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
                <h5>Data Mapel</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" onclick="addData()">Tambah Data Mapel
                </button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                <th>
                    #
                </th>
                <th>
                    nama Mapel
                </th>
                <th>
                    Guru
                </th>

                <th>
                    Action
                </th>

                </thead>
                @forelse($mapel as $key => $d)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{$d->nama_mapel}}
                        </td>
                        <td>
                            {{$d->getGuru->nama}}
                        </td>

                        <td>
                            <button type="button" class="btn btn-success btn-sm" id="editData" data-id="{{$d->id}}" data-nama="{{$d->nama_mapel}}" data-guru="{{$d->getGuru->id}}">Ubah
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data mapel</td>
                    </tr>

                @endforelse
            </table>

        </div>


        <!-- Modal Tambah-->
        <div class="modal  fade" id="tambahmapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Mapel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formData" onsubmit="return save()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <div class="mb-3">
                                <label for="namamapel" class="form-label">Nama Mapel</label>
                                <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
                            </div>
                            <a>Pilih Guru</a>
                            <select class="form-select" aria-label="Default select example" name="id_guru" id="id_guru">
                                <option selected value="">Mata Pelajaran</option>
                                @foreach($guru as $g)
                                    <option value="{{$g->id}}">{{$g->nama}}</option>
                                @endforeach
                            </select>

                            <div class="mb-4"></div>
                            <button type="submit" class="btn btn-primary" onclick="">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Edit-->


    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {

        })

        function addData() {
            $('#formData #id').val('');
            $('#formData #nama_mapel').val('');
            $('#formData #id_guru').val('');
            $('#tambahmapel').modal('show');
        }

        $(document).on('click','#editData', function () {
            $('#formData #id').val($(this).data('id'));
            $('#formData #nama_mapel').val($(this).data('nama'));
            $('#formData #id_guru').val($(this).data('guru'));
            $('#tambahmapel').modal('show');
        })

        function save() {
            var ket = 'menambah';
            if ($('#formData #id').val() !== '') {
                ket = 'merubah';
            }
            swal({
                title: ket + " data?",
                text: "Apa kamu yakin ingin " + ket + " data ",
                icon: "info",
                buttons: true,
                primariMode: true,
            })
                .then((res) => {
                    if (res) {
                        $.ajax({
                            type: "POST",
                            url: '/admin/mapel',
                            data: $('#formData').serialize(),
                            headers: {
                                'Accept': "application/json"
                            },
                            success: function (data, textStatus, xhr) {
                                if (xhr.status === 200) {
                                    swal("Berhasil " + ket + " data!", {
                                        icon: "success",
                                    }).then((dat) => {
                                        window.location.reload();
                                    });
                                } else if(xhr.status === 204) {
                                    swal('Silahkan memilih data guru')
                                }else{
                                    swal(data['msg'])
                                }
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
