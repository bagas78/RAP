<?php
class Login extends CI_Controller{
 
  function __construct(){
    parent::__construct();
  }
  function index(){
    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_logo");
    $this->load->view('login',$data);
  }
  function auth(){
    $email = $this->input->post('email');
    $pass = md5($this->input->post('password'));

    $cek = $this->db->query("SELECT * FROM t_user WHERE user_email = '$email' AND user_password = '$pass' AND user_hapus = 0")->row_array();
   
        if (@$cek) {
           
              //create sesi
              $this->session->set_userdata('name',$cek['user_name']);
              $this->session->set_userdata('pass',$cek['user_password']);
              $this->session->set_userdata('foto',$cek['user_foto']);

              $this->session->set_userdata('id',$cek['user_id']);
              $this->session->set_userdata('login','1');
              $this->session->set_userdata('level',$cek['user_level']);

              switch ($cek['user_level']) {
                case '2':
                  // guru
                  $this->session->set_userdata('pelajaran',$cek['user_pelajaran']);
                  break;
                
                case '3':
                  // siswa

                  //get kelompok
                  $id = $cek['user_id'];
                  $kelompok = $this->db->query("SELECT * FROM t_kelompok WHERE concat(',',kelompok_siswa,',') LIKE '%,$id,%'")->row_array();
                  //

                  $this->session->set_userdata('kelompok',@$kelompok['kelompok_id']);
                  $this->session->set_userdata('kelas',$cek['user_kelas']);
                  break;
              }

              redirect(base_url('dashboard'));

      }else{
         $this->session->set_flashdata('gagal','Email / Password salah');
         redirect(base_url('login'));
      }
  }
  function logout(){
    session_destroy();
    redirect(base_url('login')); 
  }
}