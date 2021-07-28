@extends('admin.base')

@section('title')
    Data Siswa
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
                <h5>Data Siswa</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" onclick="addData()">Tambah Data Siswa</button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        nama Siswa
                    </th>
                    <th>
                        Alamat
                    </th>

                    <th>
                        Tanggal Lahir
                    </th>


                    <th>
                        Kelas
                    </th>

                    <th>
                        No_hp
                    </th>

                    <th>
                        Action
                    </th>

                </thead>

                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        Erfin
                    </td>
                    <td>
                        Sukoharjo
                    </td>
                    <td>
                        23 Maret 1994
                    </td>
                    <td>
                        XII A
                    </td>

                    <td>
                        08787845457
                    </td>

                    <td>
                        <a type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editData">Ubah</a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                    </td>
                </tr>

            </table>

        </div>


            <div class="modal  fade" id="tambahsiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formRegister">
                                @csrf
                                <input name="id" id="id" value="">

                                <div class="mb-3">
                                    <label for="namasiswa" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>

                                <div class="mb-3">
                                    <label for="alamatsiswa" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat">
                                </div>

                                <div class="mb-3">
                                    <label for="ttlsiswa" class="form-label">Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal">
                                </div>

                                <div class="mb-3">
                                    <label for="kelassiswa" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas">
                                </div>

                                <div class="mb-3">
                                    <label for="nohpsiswa" class="form-label">No Hp</label>
                                    <input type="text" class="form-control" id="nohpsiswa">
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <div class="mb-3">
                                    <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>

                                <div class="mb-4"></div>
                                <a type="submit" class="btn btn-primary" onclick="register()">Simpan</a>
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
        $(document).ready(function() {

        })


        function addData() {
            $('#formRegister #id').val('');
            $('#formRegister #nama').val('');
            $('#formRegister #alamat').val('');
            $('#formRegister #tanggal').val('');
            $('#formRegister #username').val('');
            $('#formRegister #password').val('');
            $('#formRegister #password_confirmation').val('');
            $('#formRegister').modal('show');
        }

        $(document).on('click', '#editData', function () {
            $('#formRegister #id').val($(this).data('id'));
            $('#formRegister #nama').val($(this).data('name'));
            $('#formRegister #alamat').val($(this).data('alamat'));
            $('#formRegister #tanggal').val($(this).data('tanggal'));
            $('#formRegister #username').val($(this).data('username'));
            $('#formRegister #password').val('*****');
            $('#formRegister #password_confirmation').val('*****');
            $('#formRegister').modal('show');
        })

        function register() {
            var ket = 'menambah';
            if ($('#tambahguru #id').val() !== '') {
                ket = 'merubah';
            }
            swal({
                title: ket +" data?",
                text: "Apa kamu yakin ingin "+ket+" data ",
                icon: "info",
                buttons: true,
                primariMode: true,
            })
                .then((res) => {
                    if (res) {
                        $.ajax({
                            type: "POST",
                            url: '/register',
                            data: $('#formRegister').serialize(),
                            headers: {
                                'Accept': "application/json"
                            },
                            success: function (data, textStatus, xhr) {
                                if (xhr.status === 200) {
                                    swal("Berhasil "+ket+" data!", {
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
                text: "Apa kamu yakin, ingin menghapus data "+name+"?!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let data = {
                            '_token': '{{csrf_token()}}',
                        };
                        $.post('/admin/guru/delete/'+id,data ,function () {
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
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
@endsection
