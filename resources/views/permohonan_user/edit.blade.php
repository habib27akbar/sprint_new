@extends('layouts.master')

@section('title','Permohonan')
@section('css')
    <style>
        #tableSNI thead th {
            top: 0;
            position: sticky;
            background-color: #666;
            color: #fff;
        }

        .col-id-no {
            left: 0;
            position: sticky;
            width: 3%
        }

        .col-second {
            left: 60px;
            position: sticky;
            width: 10%;

        }

        .col-third {
            left: 185px;
            position: sticky;
            width: 6%;

        }

        .col-fourth {
            left: 314px;
            position: sticky;

        }

        .col-fifth {
            left: 390px;
            position: sticky;

        }

        .fixed-header {
            z-index: 50;
        }

        .bg-abu {
            background-color: #f2f2f2;
        }
    </style>
@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permohonan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Permohonan</a></li>
              <li class="breadcrumb-item active">Update</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary"> 
                <form action="{{ route('permohonan_user.update', ['permohonan_user' => $data['id']]) }}" id="formPOST" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <h4 style="text-align: center">{{ $klien[0]['id_perusahaan'].' '.$klien[0]['nama_perusahaan'] }}</h4>
                        <input type="hidden" name="id_perusahaan" value="{{ $klien[0]['id_perusahaan'] }}">
                        <br/>
                       
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor Surat Permohonan</label>
                            <div class="col-sm-4">
                               <input type="text" name="no_surat_permohonan" class="form-control" placeholder="Nomor Surat Permohonan" value="{{ $data['no_surat_permohonan'] }}" required>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Tanggal Surat Permohonan</label>
                            <div class="col-sm-4">
                               <input type="date" name="tgl_surat_permohonan" class="form-control" value="{{ $data['tgl_surat_permohonan'] }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Menu</label>
                            <div class="col-sm-4">
                               <select name="menu" class="form-control" required>
                                <option value="">-</option>
                                @foreach ($skema as $item)
                                    <option {{ $data['menu'] == $item->kode_skema_sertifikasi?'selected':'' }} value="{{ $item->kode_skema_sertifikasi }}">{{ $item->nama_skema_sertifikasi }}</option>
                                @endforeach
                               </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Tujuan Audit</label>
                            <div class="col-sm-4">
                               <select name="tujuan_audit" class="form-control" required>
                                
                                @foreach ($tujuan_audit as $item)
                                    <option {{ $data['tujuan_audit'] == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->nama_tujuan_audit }}</option>
                                @endforeach
                               </select>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Proses Lain</label>
                            <div class="col-sm-4">
                               <select name="proses_lain" class="form-control select2" required>
                                <option value="-">-</option>
                                @foreach ($proses_lain as $item)
                                    <option {{ $data['proses_lain'] == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->nama_proses }}</option>
                                @endforeach
                               </select>
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor Sertifikat Referensi</label>
                            <div class="col-sm-10">
                               <select name="no_sertifikat_referensi" id="no_sertifikat_referensi" class="form-control" required>
                                <option value="">-</option>
                                @foreach ($mst_sertifikat as $item)
                                    <option {{ $data['no_sertifikat_referensi'] == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->no_sertifikat.' '.$item->menu.' '.$item->no_standar.' '.$item->judul_standar }}</option>
                                @endforeach
                               </select>
                            </div>


                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor Order</label>
                            <div class="col-sm-4">
                            <input type="text" name="no_order" id="no_order" value="{{ $data['no_order'] }}" class="form-control">
                            </div>


                        </div>
                        
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Tanggal Order</label>
                            <div class="col-sm-4">
                            <input type="date" name="tanggal_order" id="tanggal_order" value="{{ $data['tanggal_order'] }}" class="form-control">
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Tanggal Terima</label>
                            <div class="col-sm-4">
                            <input type="date" name="tanggal_terima" id="tanggal_terima" value="{{ $data['tanggal_terima'] }}" class="form-control">
                            </div>

                        </div>

                        

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Status Permohonan</label>
                            <div class="col-sm-4">
                                <select name="sts" class="form-control" required>
                                    <option value="">-</option>
                                    <option {{ $data['sts'] == 2 ? 'selected':'' }} value="2">Dilanjutkan</option>
                                    <option {{ $data['sts'] == 3 ? 'selected':'' }} value="3">Perlu Perbaikan</option>
                                    <option {{ $data['sts'] == 4 ? 'selected':'' }} value="4">Ditolak</option>
                                </select>
                            </div>

                            

                        </div>
                        

                        

                      
                        
                    </div>
                    <div class="card-footer">
                        <div id="btnSimpan">
                            <button id="btnSave" type="submit" value="simpan" class="btn btn-primary">Simpan</button>
                            
                            <a href="{{ route('permohonan_user.index') }}" class="btn btn-default">Kembali</a>
                        </div>

                        
                        
                    </div>
                </form>
            </div>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
  @endsection
  @section('js')
    <script>
        $('.select2').select2();

        
    </script>
  @endsection