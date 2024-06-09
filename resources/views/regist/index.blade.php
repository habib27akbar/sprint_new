@extends('layouts.regist')

@section('title','Registration')

@section('content')  
  
    {{-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-6" style="margin-left:auto; margin-right:auto;">
            <h1>{{ strtoupper(request()->segment(1)) }}</h1>
          </div>
          
        </div>
      </div>
    </section> --}}

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" style="margin-top: 50px">
          <div class="col-10" style="margin-left:auto; margin-right:auto;">
            <div class="card">
                
              {{-- <div class="card-header">
                <h4>{{ strtoupper(request()->segment(1)) }}</h4>
              </div> --}}
              
              <div class="card-body">
                
               @include('include.admin.alert')
                <form class="form-horizontal">
                    <div class="card-body">
                        
                        <h5>Akun Pelanggan</h5>
                        <hr style="border:1px solid blue;">
                        <div class="form-group row">
                            <label for="id_perusahaan" class="col-sm-3 col-form-label">ID Perusahaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" onclick="checkID()" id="id_perusahaan" placeholder="ID Perusahaan" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Jenis Badan Usaha</label>
                            <div class="col-sm-9">
                                <select name="jenis_badan_usaha" class="form-control" required>
                                    <option value="">--</option>
                                    <option value="UD">UD</option>
                                    <option value="Fa">Fa</option>
                                    <option value="CV">CV</option>
                                    <option value="Koperasi">Koperasi</option>
                                    <option value="PJ">PJ</option>
                                    <option value="Perum">Perum</option>
                                    <option value="PT">PT</option>
                                    <option value="Yayasan">Yayasan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_perusahaan" class="col-sm-3 col-form-label">Nama Perusahaan Produsen</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_perusahaan" placeholder="Nama Perusahaan Produsen" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ln_dn" class="col-sm-3 col-form-label">Jenis Produsen</label>
                            <div class="col-sm-9">
                                <select name="ln_dn" class="form-control" required>
                                    <option value="">--</option>
                                    <option value="LN">Luar Negeri</option>
                                    <option value="DN">Dalam Negeri</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <h5>Identitas Admin</h5>
                        <hr style="border:1px solid blue;">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" placeholder="Nama" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Posisi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="posisi" placeholder="Posisi" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Perusahaan</label>
                            <div class="col-sm-4">
                                <select name="jenis_badan_usaha" class="form-control" required>
                                    <option value="">--</option>
                                    <option value="Produsen">Produsen</option>
                                    <option value="Penanggung Jawab">Penanggung Jawab</option>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Email Admin</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" id="posisi" placeholder="Email" required>
                            </div>
                        </div>
                        <br/>
                        <h5>Registrasi User</h5>
                        <hr style="border:1px solid blue;">

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="username" placeholder="Username" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input id="inputPassword" type="password" name="password" autocomplete="on" class="form-control" placeholder="Password" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i onclick="myFunction()" id="iconPassword" class="fas fa-eye"></i>
                                            <!-- <span class="fas fa-lock"></span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <div class="col-2">
                                 <img src="{{ captcha_src() }}" alt="captcha" class="captcha-img" data-refresh-config="default">
                                 <i style="margin-left: 10px;" id="refresh-captcha" class="fas fa-sync-alt"></i>
                                 
                            </div>
                            
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="posisi" placeholder="Captcha" required>
                            </div>
                        </div>

                        <br/>
                        <h5>Status Registrasi</h5>
                        <hr style="border:1px solid blue;">
                        <table class="table stripted-table">
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                            
                        </table>

                       
                    
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                        
                    </div>
                    <!-- /.card-footer -->
                </form>

                 <div class="modal fade" id="modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"></h4>
                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> --}}
                            </div>
                            <div class="modal-body">
                               Silahkan menghubungi customer service kami via WhatsApp Halo BSPJI Jakarta 
                               <a href="https://api.whatsapp.com/send?phone=+6289517300975&text=Saya%20Ingin%20Mengetahui%20ID%20Pelanggan%20Saya" target="_blank">0895-1730-0975</a> 
                               untuk mengetahui ID Pelanggan Anda
                            </div>
                            <div class="modal-footer justify-content-between">
                                
                                <button type="button" data-dismiss="modal" onclick="confirmWA()" class="btn btn-primary">Sudah Whatsapp</button>
                            </div>
                        </div>
                    <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              

              </div>
            </div>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  @endsection
  @section('js')
  
    <script>
        function checkID() {
           //localStorage.setItem('modalShown', 'false');
           if (!localStorage.getItem('confirmWA')) {
                // Show the modal
                //var myModal = new bootstrap.Modal(document.getElementById('modal'));
                var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                    backdrop: 'static',
                    keyboard: false
                });
                myModal.show();

                // Set the modalShown flag in local storage
                //localStorage.setItem('modalShown', 'false');
            }
        }
        function confirmWA() {
            localStorage.setItem('confirmWA', 'true');
        }

        function myFunction() {
            var x = document.getElementById("inputPassword");
            var z = document.getElementById("iconPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

            if (z.className === "fas fa-eye") {
                z.className = "fas fa-eye-slash";
            } else {
                z.className = "fas fa-eye";
            }
        }

        document.getElementById('refresh-captcha').onclick = function(e) {
            e.preventDefault();
            var captchaImage = document.querySelector('.captcha-img');
            captchaImage.src = 'http://localhost/sprint_new/captcha?rnd=' + Math.random();
        };
    </script>
  @endsection