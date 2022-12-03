<?php
class Backup extends CI_Controller{

	function __construct(){
		parent::__construct();
	}  
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Backup';
		    $data['pengaturan_open'] = 'menu-open';
		    $data['pengaturan_block'] = 'style="display: block;"';
		    $data['backup_active'] = 'class="active"';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('backup/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function download(){

		//load helpers
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');

		//load database
		$this->load->dbutil();

		//create format
		$db_format=array('format'=>'zip','filename'=>'backup.sql');

		$backup=& $this->dbutil->backup($db_format);

		// file name
		$dbname = 'backup-on-'.date('d-m-y H:i').'.zip';
		$save = 'assets/backup/'.$dbname;

		// write file
		write_file($save,$backup);

		// and force download
		force_download($dbname,$backup);
	}
}