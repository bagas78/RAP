
<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->  
          <div class="box">
            <div class="box-body box-profile">
              <?php if (@$data['foto'] == ''): ?>
                <img class="img-thumbnail img-responsive" src="<?php echo base_url() ?>assets/gambar/user/no.jpg" alt="User profile picture" style="margin-bottom: 5%; border-radius: 100%;">
              <?php else: ?>
                <img class="img-thumbnail img-responsive" src="<?php echo base_url() ?>assets/gambar/user/<?php echo @$data['foto']; ?>" alt="User profile picture" style="margin-bottom: 5%; border-radius: 100%;">
              <?php endif ?> 

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item" style="margin-top: 7%;">
                  <label><?php switch ($level) {
                    case 1:
                      echo 'Email';
                      break;
                    case 2:
                      echo 'NIP';
                      break;
                    case 3:
                      echo 'NIS / NIM';
                      break;
                  } ?></label> 
                  <br/>
                  <span><?php echo @$data['nis']; ?></span>
                </li>
              </ul>

            </div> 
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
              <li><a href="#security" data-toggle="tab">Security</a></li>
            </ul>
            <div class="tab-content">
               <!-- /.tab-pane -->

              <div class="active tab-pane" id="settings" style="background: white;">
                <form method="post" action="<?php echo base_url() ?>profile/update/<?php echo $this->session->userdata('id'); ?>" class="form-horizontal" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" name="nama" class="form-control" value="<?php echo @$data['nama']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">TTL</label>

                    <div class="col-sm-10">
                      <input type="date" name="ttl" class="form-control" value="<?php echo @$data['ttl']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">No. Hp</label>

                    <div class="col-sm-10">
                      <input type="text" name="nohp" class="form-control" value="<?php echo @$data['nohp']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" name="email" class="form-control" value="<?php echo @$data['email']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>

                    <div class="col-sm-10">
                      <input type="text" name="alamat" class="form-control" value="<?php echo @$data['alamat']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Biodata</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="biodata"><?php echo @$data['biodata']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Foto</label>
                    <div class="col-sm-10">
                     <input type="file" class="form-control" name="foto" accept="image/*">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Submit <i class="fa fa-check"></i></button>
                      <button type="reset" class="btn btn-danger">Reset <i class="fa fa-times"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="security" style="background: white;">
               
                <form id="form" method="post" action="<?php echo base_url() ?>profile/update_password/<?php echo $this->session->userdata('id'); ?>" class="form-horizontal">

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Old Password</label>

                    <div class="col-sm-9">
                      <input type="password" id="oldpass" class="form-control" value="<?php echo @$data['password']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">New Password</label>

                    <div class="col-sm-9">
                      <input type="password" id="newpass" name="newpass" class="pass form-control" value="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Confirm Password</label>

                    <div class="col-sm-9">
                      <input type="password" id="confpass" name="confpass" class="pass form-control" value="">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <div class="checkbox">
                        <label>
                          <input id="view" type="checkbox" value="1" onclick="pass()"> View password
                        </label>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <a onclick="submit()" class="btn btn-success">Submit <i class="fa fa-check"></i></a>
                      <button type="reset" class="btn btn-danger">Reset <i class="fa fa-times"></i></button>
                    </div>
                  </div>
                </form>
                
                <script type="text/javascript">
                    function submit(){
                      var oldpass = $('#oldpass').val();
                      var newpass = $('#newpass').val();
                      var confpass = $('#confpass').val();

                      if (newpass == confpass) {
                         if (oldpass == newpass) {
                            alert('"password lama" dan "password baru" tidak boleh sama');
                         }
                         else{
                            $('#form').trigger('submit');
                         }
                      }
                      else{
                        alert('Periksa kembali inputan "password"');
                      }

                    }
                    function pass(){

                      if ($('#view').val() == 1) {
                        $('.pass').attr('type','text');
                        $('#view').val('0');
                      }
                      else{
                        $('.pass').attr('type','password');
                        $('#view').val('1');
                      }
                      
                    }
                  </script>

              </div>

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
     


  


    
      