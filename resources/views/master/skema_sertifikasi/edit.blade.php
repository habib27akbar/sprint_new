@extends('layouts.master')

@section('title','Skema Sertifikasi')
@section('css')

@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Skema Sertifikasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Skema Sertifikasi</a></li>
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
                <form action="{{ route('skema_sertifikasi.update', ['skema_sertifikasi' => $data['id']])  }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Kode Skema Sertifikasi</label>
                            <div class="col-sm-4">
                               <input type="text" name="kode_skema_sertifikasi" class="form-control" value="{{ $data['kode_skema_sertifikasi'] }}" required>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Nama Skema Sertifikasi</label>
                            <div class="col-sm-4">
                                <input type="text" name="nama_skema_sertifikasi" class="form-control" value="{{ $data['nama_skema_sertifikasi'] }}" required>
                            </div>
                        </div>

                    
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Kode No Order</label>
                            <div class="col-sm-4">
                                <input type="text" name="kode_no_order" class="form-control" value="{{ $data['kode_no_order'] }}" required>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Order</label>
                            <div class="col-sm-4">
                                <input type="text" name="order" class="form-control" value="{{ $data['order'] }}" required>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-4">
                                <select name="status" class="form-control" required>
                                  <option {{ $data['status'] == 'Aktif' ? 'selected':'' }} value="Aktif">Aktif</option>
                                  <option {{ $data['status'] == 'Non Aktif' ? 'selected':'' }} value="Non Aktif">Non Aktif</option>
                                </select>
                            </div>
                        </div>
                    
                        
                    </div>
                    <div class="card-footer">
                        <button id="btnSave" type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('skema_sertifikasi.index') }}" class="btn btn-default">Batal</a>
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
     
    </script>
  @endsection