@extends('layouts.master')

@section('title','Proses Lain')
@section('css')

@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Proses Lain</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Proses Lain</a></li>
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
                <form action="{{ route('proses_lain.update', ['proses_lain' => $data['id']])  }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        
                         <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Tujuan Audit</label>
                            <div class="col-sm-4">
                               <select name="id_tujuan_audit" class="form-control select2">
                                <option value="">-</option>
                                @foreach ($tujuan_audit as $item)
                                    <option {{ $data['id_tujuan_audit'] == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->nama_tujuan_audit }}</option>
                                @endforeach
                                <option value=""></option>
                               </select>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Nama Proses Lain</label>
                            <div class="col-sm-4">
                                <input type="text" name="nama_proses" class="form-control" value="{{ $data['nama_proses'] }}" required>
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
                        <a href="{{ route('proses_lain.index') }}" class="btn btn-default">Batal</a>
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