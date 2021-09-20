@extends('admin.base')

@section('title')
    Data Laporan Pengembalian
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
                <h5>History Pengembalian</h5>
                <form id="formTanggal">
                    <div class="d-flex align-items-center">
                        <i class='bx bx-calendar me-2' style="font-size: 1.4rem"></i>
                        <div class="me-2">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control me-2" name="start" value="{{request('start')}}" required>
                                <div class="input-group-addon">to</div>
                                <input type="text" class="form-control ms-2" name="end" value="{{request('end')}}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mx-2">Cari</button>
                        <a class="btn btn-warning" id="cetak" target="_blank">Cetak</a>
                    </div>
                </form>
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
                    Nama Siswa
                </th>

                <th>
                    Mapel
                </th>
                <th>
                    Kondisi
                </th>

                </thead>

                @forelse($kembali as $key => $g)
                    <tr>
                        <td>
                            {{$pinjam->firstItem() + $key}}
                        </td>
                        <td>
                            {{date('d F Y', strtotime($g->tanggal_pinjam))}}
                        </td>
                        <td>
                            {{date('d F Y', strtotime($g->updated_at))}}
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
                            {{$g->kondisi_barang}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data pinjaman dikembalikan</td>
                    </tr>
                @endforelse
            </table>
            <div class="d-flex justify-content-end">
                {{$kembali->links()}}
            </div>
        </div>


    </section>

@endsection

@section('script')
    <script>
        $('.input-daterange input').each(function () {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });
        $(document).on('click','#cetak', function () {
            console.log('/cetaklaporan?'+$('#formTanggal').serialize());
            $(this).attr('href', '/cetaklaporan?'+$('#formTanggal').serialize());
        })
    </script>
@endsection
