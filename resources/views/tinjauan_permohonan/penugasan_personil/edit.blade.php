@extends('layouts.master')

@section('title','Penugasan Personil')
@section('css')

@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penugasan Personil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Penugasan Personil</a></li>
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
                <form action="{{ route('penugasan_personil.update', ['penugasan_personil' => $klien['id_permohonan']]) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                       @include('include.admin.alert')
                        @csrf
                        @method('PUT')
                        <h4 style="text-align: center;">{{ $klien['jenis_badan_usaha'].' '.$klien['nama_perusahaan'] }}</h4>
                        

                        

                        

                        
                           
                            <table id="tablePermohonan" class="table stripted-table">
                                <tr>
                                    <th>Action</th>
                                    <th>Nomor Order</th>
                                    <th>Tanggal Order</th>
                                    <th>Menu</th>
                                    <th>Tujuan</th>
                                    <th>Proses Lain</th>
                                    
                                </tr>
                                @foreach ($permohonan as $item)
                                    
                                    <tr>
                                        <td><input type="checkbox" name="pilihPermohonan[]" {{ $item->id_penugasan_personil?'checked':'' }} class="form-control" value="{{ $item->id }}"></td>
                                       
                                        <td>{{ $item->no_order }}</td>
                                        <td>
                                            @if ($item->tanggal_order)
                                                {{ TanggalHelper::get_dateInd($item->tanggal_order) }}
                                            @endif
                                            
                                        </td>
                                        <td>{{ $item->nama_skema_sertifikasi }}</td>
                                        <td>{{ $item->nama_tujuan_audit }}</td>
                                        <td>{{ $item->nama_proses }}</td>
                                    </tr>   
                                @endforeach
                            </table>
                        
                        
                        <br/><br/>
                        <div class="form-group row">
                            <label for="file" class="col-sm-3 col-form-label">Personil Tinjauan Permohonan</label>
                            <div class="col-sm-4">
                               <select name="id_personil" id="id_personil" class="form-control select2" required>
                                <option value="">-</option>
                               </select>
                            </div>
                            
                        </div>

                        <input type="hidden" id="id_personil_selected" value="{{ isset($data_penugasan) ?$data_penugasan[0]['id_personil']: '' }}">

                        
                        <hr style="border:1px solid blue;">

                        <div class="form-group row">
                            <label for="file" class="col-sm-6 col-form-label">Pemeriksaan Kelengkapan dan Kebenaran Dokumen permohonan</label>
                            <div class="col-sm-4">
                               <select name="pemeriksaan_kelengkapan_kebenaran_dokumen" id="pemeriksaan_kelengkapan_kebenaran_dokumen" class="form-control" required>
                                <option value="">-</option>
                                <option {{ isset($data_penugasan) && $data_penugasan[0]['pemeriksaan_kelengkapan_kebenaran_dokumen'] == 'Tidak Diperlukan' ? 'selected': '' }} value="Tidak Diperlukan">Tidak Diperlukan</option>
                                <option {{ isset($data_penugasan) && $data_penugasan[0]['pemeriksaan_kelengkapan_kebenaran_dokumen'] == 'Sesuai' ? 'selected': '' }} value="Sesuai">Sesuai</option>
                               </select>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-6 col-form-label">Pemeriksaan Kebenaran Persyaratan Tambahan (jika ada)</label>
                            <div class="col-sm-4">
                               <select name="pemeriksaan_kebenaran_persyaratan" id="pemeriksaan_kebenaran_persyaratan" class="form-control" required>
                                <option value="">-</option>
                                <option {{ isset($data_penugasan) && $data_penugasan[0]['pemeriksaan_kebenaran_persyaratan'] == 'Tidak Diperlukan' ? 'selected': '' }} value="Tidak Diperlukan">Tidak Diperlukan</option>
                                <option {{ isset($data_penugasan) && $data_penugasan[0]['pemeriksaan_kebenaran_persyaratan'] == 'Sesuai' ? 'selected': '' }} value="Sesuai">Sesuai</option>
                               </select>
                               </select>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-6 col-form-label">Kajian Permohonan, Rekomendasi Mandays dan Menyusun dokumen Permohonan</label>
                            <div class="col-sm-4">
                               <select name="kajian_permohonan" id="kajian_permohonan" class="form-control" required>
                                <option value="">-</option>
                                <option {{ isset($data_penugasan) && $data_penugasan[0]['kajian_permohonan'] == 'Tidak Diperlukan' ? 'selected': '' }} value="Tidak Diperlukan">Tidak Diperlukan</option>
                                <option {{ isset($data_penugasan) && $data_penugasan[0]['kajian_permohonan'] == 'Sesuai' ? 'selected': '' }} value="Sesuai">Sesuai</option>
                               </select>
                               </select>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-6 col-form-label">Audit Tahap 1 (Kecukupan)</label>
                            <div class="col-sm-4">
                               <select name="audit" id="audit" class="form-control" required>
                                <option value="">-</option>
                                <option {{ isset($data_penugasan) && $data_penugasan[0]['audit'] == 'Tidak Diperlukan' ? 'selected': '' }} value="Tidak Diperlukan">Tidak Diperlukan</option>
                                <option {{ isset($data_penugasan) && $data_penugasan[0]['audit'] == 'Sesuai' ? 'selected': '' }} value="Sesuai">Sesuai</option>
                               </select>
                               </select>
                            </div>
                            
                        </div>
                        
                       <hr style="border:1px solid blue;">
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor Disposisi</label>
                            <div class="col-sm-4">
                               <input type="text" name="no_disposisi" class="form-control" value="{{ isset($data_penugasan) ?$data_penugasan[0]['no_disposisi']: '' }}" required>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Tanggal Disposisi</label>
                            <div class="col-sm-4">
                               <input type="date" name="tgl_disposisi" class="form-control" value="{{ isset($data_penugasan) ?$data_penugasan[0]['tgl_disposisi']: date('Y-m-d') }}" required>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Pemberi Penugasan</label>
                            <div class="col-sm-4">
                                <select name="id_pejabat" id="id_pejabat" class="form-control" required>
                                    <option value="">-</option>
                                    @foreach ($pejabat as $item)
                                        <option {{ isset($data_penugasan) && $data_penugasan[0]['id_pejabat'] ==  $item->id ? 'selected': '' }} value="{{ $item->id }}">{{ $item->nama_pejabat }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        
                        
                    </div>
                    <div class="card-footer">
                        <button id="btnSave" type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('penugasan_personil.index') }}" class="btn btn-default">Batal</a>
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
     $(document).ready(function() {
        // Fetch data and populate select dropdown
         var selectedValue = document.getElementById('id_personil_selected').value;
          $.ajax({
              url: '{{url("get-mst-personil")}}',
              method: 'GET',
              success: function(data) {
                  $('#id_personil').empty().append('<option value="">-</option>');
                  $.each(data, function(key, value) {
                      $('#id_personil').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                  });
                  if (selectedValue) {
                    $('#id_personil').val(selectedValue).trigger('change');
                  }
                  
                  $('#id_personil').select2();
              }
          });
      });
    </script>
  @endsection