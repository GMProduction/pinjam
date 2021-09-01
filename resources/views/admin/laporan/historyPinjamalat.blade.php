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
                <h5>History Peminjaman</h5>
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
                            {{$key + 1}}
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
        $(document).ready(function () {

        })


    </script>
    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>
@endsection
