<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller {


	public function _construct()
	{
		session_start();
	}


	public function index(){
		$data['title']='Football Ticket Online';
		$tmp['content']=$this->load->view('global/home',$data, TRUE);
		$this->load->view('global/layout',$tmp);
	}


	public function home()
	{
		$data['title']='Football Ticket Online';
		$tmp['content']=$this->load->view('global/home',$data, TRUE);
		$this->load->view('global/layout',$tmp);
	}

	public function about()
	{
		$data['title']='About Us';
		$tmp['content']=$this->load->view('global/about',$data, TRUE);
		$this->load->view('global/layout',$tmp);
	}

	public function guestbook()
	{
		$data['title']='Guestbook';
		$data['success']='';
		$status='1';
		$data['guest']=$this->football_model->select_status($status);
		$tmp['content']=$this->load->view('global/guestbook',$data, TRUE);
		$this->load->view('global/layout',$tmp);
	}


	public function success()
	{
		
		$this->load->view('global/success');
	}

	public function insert()
	{
		//insert author

		$this->form_validation->set_rules('name', 'Full Name','required');
		$this->form_validation->set_rules('email', 'E-Mail','required|valid_email');
		$this->form_validation->set_rules('comment', 'Message', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			
			$tmp['title']='Guestbook';
			$data['success']='';
			$status='1';
			$data['guest']=$this->football_model->select_status($status);
			$tmp['content']=$this->load->view('global/guestbook', $data, TRUE);
			$this->load->view('global/layout',$tmp);
		}
		else
		{
			$this->football_model->insert_guestbook();
			$tmp['title']='Guestbook';
			$data['success']='';
			$status='1';
			$data['guest']=$this->football_model->select_status($status);
			$tmp['content']=$this->load->view('global/guestbook', $data, TRUE);
			$this->load->view('global/layout',$tmp);
		}
	}

	public function schedule(){
		$data['title']='Schedule';
			/*pagination*/
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
			$tot_hal = $this->football_model->get_jadwal();
			$config['base_url'] = base_url() . 'web/schedule';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$data['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['full_tag_open'] = '<ul class="breadcrumb">';
        	$config['full_tag_close'] = '</ul>';
        	$config['first_link'] = false;
        	$config['last_link'] = false;
        	$config['first_tag_open'] = '<li>';
        	$config['first_tag_close'] = '</li>';
        	$config['prev_tag_open'] = '<li class="prev">';
        	$config['prev_tag_close'] = '</li>';
        	$config['next_tag_open'] = '<li>';
        	$config['next_tag_close'] = '</li>';
        	$config['last_tag_open'] = '<li>';
        	$config['last_tag_close'] = '</li>';
        	$config['cur_tag_open'] = '<li class="active"><a href="#">';
        	$config['cur_tag_close'] = '</a></li>';
        	$config['num_tag_open'] = '<li>';
        	$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data["paginator"] =$this->pagination->create_links();
			
			$data['data_jadwal'] = $this->football_model->getjadwallimited($offset,$limit);
			$data['data_tim']=$this->football_model->getAllData("tb_tim");
			$tmp['content']=$this->load->view('global/schedule',$data, TRUE);	
			$this->load->view('global/layout',$tmp);
			
		
	}

	public function operjadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='member')
		{	
			$id_jadwal=$this->uri->segment(3);
			redirect('/member/pemesanan/'.$id_jadwal.'');
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function stadium()
	{
		$data['title']='Stadium';
		$tmp['content']=$this->load->view('global/stadium',$data, TRUE);
		$this->load->view('global/layout',$tmp);
	}

	public function cek_registrasi()
	{           

		$simpan["id_member"] = $this->input->post("username");
		$simpan["password"] = $this->input->post("password");
		$simpan["nama"] = $this->input->post("name");
		$simpan["alamat"] = $this->input->post("alamat");
		$simpan["no_hp"] = $this->input->post("phone");
		$simpan["email"] = $this->input->post("email");
		$simpan2["username"] = $this->input->post("username");
		$simpan2["password"] = md5($this->input->post("password"));
		$simpan2["stts"] = "member";
		if($this->football_model->cekID($simpan["id_member"])==0)
				{
					$this->football_model->insertData('tb_member',$simpan);
					$this->football_model->insertData('tb_login',$simpan2);
					header('location:'.base_url().'web/success');		
				}
		else{
				$this->session->set_flashdata('save_member','Member dengan username tersebut sudah ada');
				header('location:'.base_url().'web/log/');
		}	
							
				
	}
                 
		
	//halaman login
	public function log()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{

			//buat atribut form
			$frm['username'] = array('name' => 'username',
				'id' => 'username',
				'type' => 'text',
				'value' => '',
				'class' => 'form-control',
				'placeholder' => 'Username'
			);
			$frm['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => '',
				'class' => 'form-control',
				'placeholder' => 'Password'
			);

			$frm['title']='Login & Register';
			$tmp['content']=$this->load->view('global/login',$frm);
	
		}
		else
		{
			$st = $this->session->userdata('stts');
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='operator')
			{
				header('location:'.base_url().'operator');
			}
			else if($st=='member')
			{
				header('location:'.base_url().'member');
			}
			else if($st=='eksekutif')
			{
				header('location:'.base_url().'eksekutif');
			}
		
		}
	}
	
	//mengambil data login
	public function login()
	{
		$u = $this->input->post('username');
		$p = $this->input->post('password');
		$this->football_model->getLoginData($u,$p);
	}
	
	//logout
	public function logout()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{

			header('location:'.base_url().'web/log');
		}
		else
		{
			
			$this->session->sess_destroy();
			header('location:'.base_url().'web/log');
			
		}
	}
}

/* End of file web.php */
/* Location: ./application/controllers/web.php */