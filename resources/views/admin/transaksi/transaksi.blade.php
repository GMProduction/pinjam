@extends('admin.base')
@section('content')

    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-4 col-4">
                        <h6 class="h2 text-white d-inline-block mb-0">Data Transaksi</h6>
                        {{--                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">--}}
                        {{--                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">--}}
                        {{--                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>--}}
                        {{--                                <li class="breadcrumb-item"><a href="#">Data Transaksi</a></li>--}}
                        {{--                            </ol>--}}
                        {{--                        </nav>--}}
                    </div>

                    <div class="col-lg-8 col-8">
                        <form
{{--                            action="/admin/transaksi/cetak"--}}
                        >

                        <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="dariLelang" class="form-control-label text-white">Dari</label>
                                        <input class="form-control" type="date" id="dariLelang" name="awal">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sampaiLelang" class="form-control-label text-white">Sampai</label>
                                        <input class="form-control" type="date" id="sampaiLelang" name="akhir">
                                    </div>
                                </div>
                                <div class="col-lg-2 mt-auto mb-auto">
                                    <a type="submit" class="btn btn-md btn-neutral" id="tombolCetak">Cetak</a>
                                </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 d-flex justify-content-between" >
                        <h3 class="mb-0">Tabel Transaksi</h3>
                        <div class="d-flex">
                            <div class="form-group">
                                <label for="pilihStatus">Status</label>

                                <div class="d-flex">
                                <select class="form-control mr-2" id="pilihStatus" name="bahan">
                                    <option value="">Pilih status</option>
                                    <option value="">Semua</option>
                                    <option value="0">Menunggu</option>
                                    <option value="1">Proses</option>
                                    <option value="2">Selesai</option>
                                    <option value="3">Tolak</option>
                                </select>

                                    <a class="btn btn-primary" id="caridong">Cari</a>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table id="tabel" class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">#</th>
                                <th scope="col" class="sort" data-sort="budget">No. Transaksi</th>
                                <th scope="col" class="sort" data-sort="status">Tanggal</th>
                                <th scope="col" class="sort" data-sort="status">Pembayaran</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col" class="sort" data-sort="status">Total Harga</th>
                                <th scope="col" class="sort" data-sort="status">Action</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($transaksi as $p)
                                <tr>
                                    <td class="budget">{{$loop->index+1}}</td>
                                    <td class="budget">{{$p->no_transaksi}}</td>
                                    <td class="budget">{{$p->created_at}}</td>
                                    <td class="budget">{{$p->last_payment == null ? 'Belum ada' : ($p->last_payment == '0' ? 'Menunggu' : ($p->last_payment == '1' ? 'Diterima' : 'Ditolak')) }}</td>
                                    <td class="budget">{{$p->status == '0' ? 'Menunggu' : ($p->status == '1' ? 'Proses' : ($p->status == '2' ? 'Selesai' : 'Tolak'))}}</td>
                                    <td class="budget">Rp. {{number_format($p->nominal,0,',','.')}}</td>
                                    <td>
                                        <a href="/admin/transaksi/detailpesanan/{{$p->id}}" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#tabel').DataTable();
        });
    </script>

    <script>
        $("#caridong").click(function(){
            var status = $("#pilihStatus").val();
            if(status === ""){
                window.location = "/admin/transaksi";

            }else{
                window.location = "/admin/transaksi?status="+status;

            }
        });

        $("#tombolCetak").click(function(){
            var status = $("#pilihStatus").val();
            var statisString = "Semua";
            if(status == ""){
                statisString = "Semua";
            }else
            if(status == 0){
                statisString = "Menunggu";
            }else if(status == 1){
                statisString = "Proses";
            }else if(status == 2){
                statisString = "Selesai";
            }else if(status == 3){
                statisString = "Tolak";
            }else{
                statisString = "Semua";
            }
            var awal = $("#dariLelang").val();
            var ahkir = $("#sampaiLelang").val();
            if(awal == "" || ahkir == ""){
                alert("kamu harus memilih tanggal");
            }else{

                if(status === ""){
                    window.location = "/admin/transaksi/cetak?status=&awal="+awal+"&akhir="+ahkir+"&statusstring="+statisString;

                }else{
                    window.location = "/admin/transaksi/cetak?status="+status+"&awal="+awal+"&akhir="+ahkir+"&statusstring="+statisString ;

                }
            }

        });
    </script>
@endsection
