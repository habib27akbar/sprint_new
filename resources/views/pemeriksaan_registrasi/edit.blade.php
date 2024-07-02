@extends('layouts.master')

@section('title','Pemeriksaan Sertifikasi')
@section('css')

@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pemeriksaan Registrasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pemeriksaan Registrasi</a></li>
              <li class="breadcrumb-item active">Updated</li>
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
                <form action="{{ route('pemeriksaan_regist.update', ['pemeriksaan_regist' => $data['id']]) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        
                        <center><h4>{{ $data['id_pelanggan'].' '.$data['nama_perusahaan'] }}</h4></center>
                        <br/>
                        <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="{{ $data['id_pelanggan'] }}">

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Tanggal Pengajuan</label>
                            <div class="col-sm-4">
                               <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" value="{{ $data['tanggal_pengajuan'] }}" class="form-control" required>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                            <div class="col-sm-4">
                               <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ $data['tanggal_selesai'] }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Catatan</label>
                            <div class="col-sm-10">
                               <input type="text" name="catatan" id="catatan" value="{{ $data['catatan'] }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-4">
                               <select name="status" class="form-control" required>
                                    <option value="">-</option>
                                    <option {{ $data['status'] == 'Diperlukan Perubahan' ? 'selected':'' }} value="Diperlukan Perubahan">Diperlukan Perubahan</option>
                                    <option {{ $data['status'] == 'Diterima' ? 'selected':'' }} value="Diterima">Diterima</option>
                               </select>
                            </div>
                        </div>

                       

                      
                    
                        
                        
                    </div>
                    <div class="card-footer">
                        <button id="btnSave" type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('pemeriksaan_regist.index') }}" class="btn btn-default">Batal</a>
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
    
  @endsection