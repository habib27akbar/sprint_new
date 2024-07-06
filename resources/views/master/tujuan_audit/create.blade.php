@extends('layouts.master')

@section('title','Tujuan Audit')
@section('css')

@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tujuan Audit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Tujuan Audit</a></li>
              <li class="breadcrumb-item active">Create</li>
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
                <form action="{{ route('tujuan_audit.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        
                        
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Kode Tujuan Audit</label>
                            <div class="col-sm-4">
                               <input type="text" name="kode_audit" class="form-control" required>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Nama Tujuan Audit</label>
                            <div class="col-sm-4">
                                <input type="text" name="nama_tujuan_audit" class="form-control" required>
                            </div>
                        </div>

                    
                        <div class="form-group row">
                            

                            <label for="file" class="col-sm-2 col-form-label">Order</label>
                            <div class="col-sm-4">
                                <input type="text" name="order" class="form-control" required>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-4">
                                <select name="status" class="form-control" required>
                                  <option value="Aktif">Aktif</option>
                                  <option value="Non Aktif">Non Aktif</option>
                                </select>
                            </div>
                        </div>

                        
                        
                        
                    </div>
                    <div class="card-footer">
                        <button id="btnSave" type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('tujuan_audit.index') }}" class="btn btn-default">Batal</a>
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
      function checkKodeOrder(value) {
        //console.log(value);
        $.ajax({
            url: '{{url("cek-no-order")}}',
            method: 'GET',
            data:{   
                    kode_no_order: value,
                },
            success: function(data) {
                //console.log(data);
            }
        });
      }
    </script>
  @endsection