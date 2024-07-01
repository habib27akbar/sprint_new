@extends('layouts.master')

@section('title','Perjanjian Sertifikasi')
@section('css')

@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perjanjian Sertifikasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Perjanjian Sertifikasi</a></li>
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
                <form action="{{ route('perjanjian_sertifikasi.update', ['perjanjian_sertifikasi' => $data['id']]) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        
                        
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Sertifikasi</label>
                            <div class="col-sm-10">
                               <select name="jenis_sertifikasi" class="form-control" required>
                                    <option value="">-</option>
                                    <option {{ $data['jenis_sertifikasi'] == 'Sertifikasi Produk' ? 'selected':'' }} value="Sertifikasi Produk">Sertifikasi Produk</option>
                                    <option {{ $data['jenis_sertifikasi'] == 'Sertifikasi Sistem Manajemen' ? 'selected':'' }} value="Sertifikasi Sistem Manajemen">Sertifikasi Sistem Manajemen</option>
                               </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Perjanjian Sertifikasi</label>
                            <div class="col-sm-4">
                                <input type="file" name="file" class="form-control" required>
                                <input type="hidden" name="file_old" value="{{ $data['perjanjian_sertifikasi_klien'] }}">
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor</label>
                            <div class="col-sm-10">
                                <input type="text" name="nomor" class="form-control" value="{{ $data['nomor'] }}" required>
                            </div>
                        </div>

                      
                    
                        
                        
                    </div>
                    <div class="card-footer">
                        <button id="btnSave" type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('perjanjian_sertifikasi.index') }}" class="btn btn-default">Batal</a>
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