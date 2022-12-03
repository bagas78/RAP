<?php
class Profile extends CI_Controller{
 
	function __construct(){ 
		parent::__construct(); 
	}
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$data['level'] = $this->session->userdata('level');
			$id = $this->session->userdata('id');

			$db = $this->db->query("SELECT * FROM t_user WHERE user_id = '$id'")->row_array();

			$data['data'] = array( 
									'nama' => $db['user_name'],
									'ttl' => $db['user_ttl'],
									'nohp' => $db['user_nohp'],
									'email' => $db['user_email'],
									'alamat' => $db['user_alamat'],
									'biodata' => $db['user_biodata'],
									'foto' => $db['user_foto'],
									'nis' => $db['user_email'],
									'password' => $db['user_password'], 
								);

			$data['profile'] = 'class="active"';
			$this->load->view('v_template_admin/admin_header',$data);
			$this->load->view('profile/index');
			$this->load->view('v_template_admin/admin_footer');

		}else{
			redirect(base_url('login'));
		}
	}
	function update($id){
		$level = $this->session->userdata('level');
		$nama = $_POST['nama'];

		if (@$_FILES['foto']['name']) {

			//type file
			$typefile = explode('/', $_FILES['foto']['type']);

			//replace Karakter name foto
			$filename = $_FILES['foto']['name'];

			//replace name foto
			$type = explode(".", $filename);
	    	$no = count($type) - 1;
	    	$new_name = md5(time()).'.'.$type[$no];
	    	/////////////////////

		 	//config uplod foto
			  $config = array(
			  'upload_path' 	=> './assets/gambar/user',
			  'allowed_types' 	=> "gif|jpg|png|jpeg",
			  'overwrite' 		=> TRUE,
			  'max_size' 		=> "2000",
			  'file_name'		=> $new_name,
			  );

	          //Load upload library
	          $this->load->library('upload',$config);

			if ($this->upload->do_upload('foto')) {

				$set = array(
								'user_name' => $nama,
								'user_ttl' => $_POST['ttl'],
								'user_nohp' => $_POST['nohp'],
								'user_email' => $_POST['email'],
								'user_alamat' => $_POST['alamat'],
								'user_biodata' => $_POST['biodata'],
								'user_foto' => $new_name,
								'user_tanggal' => date('Y-m-d'),
							);

				$this->db->set($set);
				$this->db->where('user_id',$id);
				$this->db->update('t_user');

				$this->session->set_flashdata('success','Data berhasil di perbaharui');

			} else {
				
				$this->session->set_flashdata('gagal','Data gagal di perbaharui');
			}

		}else{
			
			$set = array(
							'user_name' => $_POST['nama'],
							'user_ttl' => $_POST['ttl'],
							'user_nohp' => $_POST['nohp'],
							'user_email' => $_POST['email'],
							'user_alamat' => $_POST['alamat'],
							'user_biodata' => $_POST['biodata'],
							'user_tanggal' => date('Y-m-d'),
						);

			$this->db->set($set);
			$this->db->where('user_id',$id);
			$this->db->update('t_user');

			$this->session->set_flashdata('success','Data berhasil di perbaharui');
		}		

		redirect(base_url('profile'));
		
	}
	function update_password($id){
		$level = $this->session->userdata('level');

		$this->db->set('user_password' , md5($_POST['newpass']));
		$this->db->where('user_id',$id);
		$this->db->update('t_user');

		$this->session->set_flashdata('success','Data berhasil di perbaharui');

		redirect(base_url('profile'));
	}
	
} 