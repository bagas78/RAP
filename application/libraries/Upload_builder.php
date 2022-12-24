 <?php
class Upload_builder{ 
  protected $to;
  function __construct(){
       $this->to = &get_instance();
  }
  function multiple($file,$path,$name){

    $count = count($file['name']);

    for($i = 0; $i < $count; $i++){ 

        //type file
        $typefile = explode('/', $file['type'][$i]);

        //replace Karakter name foto
        $filename = $file['name'][$i];

        //replace name foto
        $type = explode(".", $filename);
        $no = count($type) - 1;
        $new_name = md5($i.time()).'.'.$type[$no];

        $_FILES['file']['name']     = $new_name; 
        $_FILES['file']['type']     = $file['type'][$i]; 
        $_FILES['file']['tmp_name'] = $file['tmp_name'][$i]; 
        $_FILES['file']['error']    = $file['error'][$i]; 
        $_FILES['file']['size']     = $file['size'][$i]; 
         
        // File upload configuration  
        $config['upload_path']      = $path; 
        $config['allowed_types']    = 'jpg|jpeg|png|gif'; 
        $config['max_size']         = '2000'; 
        $config['overwrite']        = TRUE; 
         
        // Load and initialize upload library 
        $this->to->load->library('upload', $config); 
        $this->to->upload->initialize($config); 

        if ($this->to->upload->do_upload('file')) {
          
          @$send [$name.'_'.($i+1)] = $new_name;
        }
    }
    
    return @$send;
  }
  function single($file,$path,$name){

    //type file
    $typefile = explode('/', $file['type']);

    //replace Karakter name foto
    $filename = $file['name'];

    //replace name foto
    $type = explode(".", $filename);
    $no = count($type) - 1;
    $new_name = md5(time()).'.'.$type[$no];

    //config
    $config = array(
    'upload_path'     => $path,
    'allowed_types'   => "gif|jpg|png|jpeg",
    'overwrite'       => TRUE,
    'max_size'        => "2000",
    'file_name'       => $new_name,
    );

    //Load upload library
    $this->to->load->library('upload',$config);

    if ($this->to->upload->do_upload($name)) {
      $send = $new_name;
    }else{
      $send = 0;
    }

    return $send;
    
  }
}