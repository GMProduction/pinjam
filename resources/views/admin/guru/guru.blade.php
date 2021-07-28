@extends('admin.base')

@section('title')
    Data Guru
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
                <h5>Data Guru</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" onclick="addData()">Tambah Data Guru
                </button>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                <th>
                    #
                </th>
                <th>
                    nama Guru
                </th>
                <th>
                    Alamat
                </th>

                <th>
                    TTL
                </th>

                <th>
                    Action
                </th>

                </thead>
                @forelse($guru as $key => $g)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{$g->getGuru->nama}}
                        </td>
                        <td>
                            {{$g->getGuru->alamat ?? '-'}}
                        </td>
                        <td>
                            {{$g->getGuru->tanggal ?? '-'}}
                        <td>
                            <a class="btn btn-success btn-sm" id="editData"  data-id="{{$g->id}}" data-name="{{$g->getGuru->nama}}" data-alamat="{{$g->getGuru->alamat}}" data-tanggal="{{$g->getGuru->tanggal}}" data-username="{{$g->username}}">Ubah
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{$g->id}}', ' {{$g->getGuru->nama}}') ">hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data guru</td>
                    </tr>

                @endforelse
            </table>

        </div>


        <!-- Modal Tambah-->
        <div class="modal  fade" id="tambahguru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Guru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formRegister">
                            @csrf
                            <input name="roles" value="guru">
                            <input name="id" id="id" value="">
                            <div class="mb-3">
                                <label for="namaguru" class="form-label">Nama Guru</label>
                                <input type="text" class="form-control" id="nama" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="alamatguru" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>

                            <div class="mb-3">
                                <label for="ttlguru" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>


                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="konfirmasi" name="password_confirmation" required>
                            </div>

                            <div class="mb-4"></div>
                            <a type="submit" id="saveRegister" class="btn btn-primary" onclick="register()">Simpan</a>
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
            $('#tambahguru #id').val('');
            $('#tambahguru #nama').val('');
            $('#tambahguru #alamat').val('');
            $('#tambahguru #tanggal').val('');
            $('#tambahguru #username').val('');
            $('#tambahguru #password').val('');
            $('#tambahguru #password_confirmation').val('');
            $('#tambahguru').modal('show');
        }

        $(document).on('click', '#editData', function () {
            $('#tambahguru #id').val($(this).data('id'));
            $('#tambahguru #nama').val($(this).data('name'));
            $('#tambahguru #alamat').val($(this).data('alamat'));
            $('#tambahguru #tanggal').val($(this).data('tanggal'));
            $('#tambahguru #username').val($(this).data('username'));
            $('#tambahguru #password').val('');
            $('#tambahguru #password_confirmation').val('');
            $('#tambahguru').modal('show');
        })

        function register() {
            $.ajax({
                type: "POST",
                url: '/register',
                data: $('#formRegister').serialize(),
                headers: {
                    'Accept': "application/json"
                },
                success: function (data, textStatus, xhr) {
                    if (xhr.status === 200) {
                        window.location.reload();

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
