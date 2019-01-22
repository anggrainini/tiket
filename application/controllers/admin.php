<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
//CRUD Profile
	//menampilkan home admin
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			
			/*data layout */
			$data['title']="Admin Home";
			$data['pointer']="index";
			$data['classicon']="ace-icon fa fa-home home-icon";
			$data['main_bread']="Home";
			$data['sub_bread']="Dashboard";
			$data['desc']="Overview";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");


			$tmp['content']=$this->load->view('admin/bg_home',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	//menampilkan profile
	public function profile()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			/*data layout */
			$data['title']="Admin Profil";
			$data['pointer']="profile";
			$data['classicon']="menu-icon fa fa-user";
			$data['main_bread']="Profile";
			$data['sub_bread']="View Profile";
			$data['desc']="Profile Information";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['username'] = $this->session->userdata('username');
			$data['password'] = $this->session->userdata('password');
			$data['user'] = $this->session->userdata('stts');
			
			
			$tmp['content']=$this->load->view('admin/profile',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
	
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	//edit profile
	public function edit_profile()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	

		$id_admin = $this->session->userdata('username');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		

		if ($this->form_validation->run() == FALSE)
			{
					/*data layout */
					$data['title']="Edit Profile";
					$data['pointer']="profile";
					$data['classicon']="menu-icon fa fa-user";
					$data['main_bread']="Profile";
					$data['sub_bread']="Edit Profile";
					$data['desc']="Edit your basic profile";
					$data['data_admin']=$this->football_model->getAllData("tb_admin");

					/*spesifik halaman */
					$data['error']='';
					$data['name_admin']=$this->football_model->get_id($id_admin);
					$tmp['content']=$this->load->view('admin/edit_profile',$data, TRUE);	
					$this->load->view('admin/layout_home',$tmp);
			}
		else
			{
					if ( $_FILES['userfile']['name'] != ''){
						// form submit dengan gambar diisi
						// load uploading file library
						
						$config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'jpg|png';
						$config['max_size']	= '1000'; //MB
						$config['max_width']  = '3000';//pixels
						$config['max_height']  = '3000';//pixels


						$this->load->library('upload', $config);

								if ( ! $this->upload->do_upload())
								{
									/*data layout*/
									$data['title']="Edit Profile";
									$data['pointer']="profile";
									$data['classicon']="menu-icon fa fa-user";
									$data['main_bread']="Profile";
									$data['sub_bread']="Edit Profile";
									$data['desc']="Edit your basic profile";
									

									$data['data_admin']=$this->football_model->getAllData("tb_admin");
									$data['error']=$this->upload->display_errors();
									$data['name_admin'] = $this->football_model->get_id($id_admin);
									$tmp['content']=$this->load->view('admin/edit_profile',$data, TRUE);	
									$this->load->view('admin/layout_home',$tmp);
									
								} 
								else 
								{
									$gambar = $this->upload->data();
									$data= array (
									'password'		=> $this->input->post('password'),
									'nama'			=> $this->input->post('nama'),
									'img'			=> $gambar['file_name'],
									'alamat'		=> $this->input->post('alamat'),
									'no_hp'			=> $this->input->post('phone'),
								);

								
								/*ubah password untuk keperluan login */
								$updatelog["password"] = md5($this->input->post("password"));
								$where = array('username'=>$id_admin);

									$this->football_model->updateDataMultiField("tb_login",$updatelog,$where);
								/*update tabel admin */
									$this->db->where('id_admin',$id_admin);
     								$query = $this->db->get('tb_admin');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
     								
									$this->football_model->update_admin($data,$id_admin);
									redirect('admin/profile');
								} 
					}	
					else 
					{
						//form submit dengan gambar dikosongkan
						$data= array (
							'password'		=> $this->input->post('password'),
							'nama'			=> $this->input->post('nama'),
							'alamat'		=> $this->input->post('alamat'),
							'no_hp'			=> $this->input->post('phone'),
						);
						/*ubah password untuk keperluan login */
								$updatelog["password"] = md5($this->input->post("password"));
								$where = array('username'=>$id_admin);

								$this->football_model->updateDataMultiField("tb_login",$updatelog,$where);
								$this->football_model->update_admin($data,$id_admin);
						redirect('admin/profile');
					}

			}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

//CRUD Member
	public function member()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
				/*data layout */
			$data['title']="Member";
			$data['pointer']="member";
			$data['classicon']="fa fa-users";
			$data['main_bread']="Member";
			$data['sub_bread']="View Member";
			$data['desc']="Overview";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");


			/*pagination*/
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
			$tot_hal = $this->football_model->getAllData("tb_member");
			$config['base_url'] = base_url() . 'admin/member';
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
			
			$data['data_member'] = $this->football_model->getAllDataLimited('tb_member',$offset,$limit);
			/*spesific in this page */


			//$data['data_member']=$this->football_model->getAllData("tb_member");
			$tmp['content']=$this->load->view('admin/bg_member',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);


			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function tambah_member()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Add Member";
			$data['pointer']="member";
			$data['classicon']="fa fa-users";
			$data['main_bread']="Member";
			$data['sub_bread']="Add Member";
			$data['desc']="Tambahkan Member baru (di luar register)";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['error']='';
			$tmp['content']=$this->load->view('admin/tambah_member',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	public function edit_member()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Edit Member";
			$data['pointer']="member";
			$data['classicon']="fa fa-users";
			$data['main_bread']="Member";
			$data['sub_bread']="Edit Member";
			$data['desc']="Edit Member";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['member'] = $this->football_model->getDetailMember($this->uri->segment(3));
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_member',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	/*simpan member */
	public function simpan_member()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			
			$this->form_validation->set_rules('username', 'username', 'required');

			if ($this->form_validation->run() === FALSE)
			{

				$data['title']="Add Member";
				$data['pointer']="member";
				$data['classicon']="fa fa-users";
				$data['main_bread']="Member";
				$data['sub_bread']="Add Member";
				$data['desc']="Tambahkan Member baru (di luar register)";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");

				$data['member'] = $this->football_model->getDetailMember($this->uri->segment(3));
				$data['error']='';
				$tmp['content']=$this->load->view('admin/tambah_member',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
			}
			else
			{
				if ( $_FILES['userfile']['name'] != ''){
					// load uploading file library
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'jpg|png';
					$config['max_size']	= '1000'; //MB
					$config['max_width']  = '3000';//pixels
					$config['max_height']  = '3000';//pixels

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload()){	

						$data['title']="Add Member";
						$data['pointer']="member";
						$data['classicon']="fa fa-users";
						$data['main_bread']="Member";
						$data['sub_bread']="Add Member";
						$data['desc']="Tambahkan Member baru (di luar register)";
						$data['data_admin']=$this->football_model->getAllData("tb_admin");
						
						$data['error']=$this->upload->display_errors();
						$tmp['content']=$this->load->view('admin/tambah_member',$data, TRUE);	
						$this->load->view('admin/layout_home',$tmp);
					
					} 
					else 
					{
						//file berhasil diupload lalu lanjut ke query insert
						// eksekusi query Insert
						$gambar = $this->upload->data();
						$data= array (
							'id_member'			=> $this->input->post('username'),
							'password'			=> $this->input->post('password'),
							'nama'				=> $this->input->post('nama'),
							'img'				=> $gambar['file_name'],
							'alamat'			=> $this->input->post('alamat'),
							'no_hp'				=> $this->input->post('phone'),
							'email'				=> $this->input->post('email'),
							'saldo'				=> $this->input->post('saldo'),
						);
						$simpan["id_member"] = $this->input->post("username");	
						$simpan2["username"] = $this->input->post("username");
						$simpan2["password"] = md5($this->input->post("password"));
						$simpan2["stts"] = "member";
						
							if($this->football_model->cekID($simpan["id_member"])==0)
							{
								$this->football_model->insertData('tb_member',$data);
								$this->football_model->insertData('tb_login',$simpan2);	
								redirect ('admin/member');
							}
							else{

								$data['title']="Add Member";
								$data['pointer']="member";
								$data['classicon']="fa fa-users";
								$data['main_bread']="Member";
								$data['sub_bread']="Add Member";
								$data['desc']="Tambahkan Member baru (di luar register)";
								$data['data_admin']=$this->football_model->getAllData("tb_admin");
									
								$data['error']="Member sudah terdaftar";
								$tmp['content']=$this->load->view('admin/tambah_member',$data, TRUE);	
								$this->load->view('admin/layout_home',$tmp);

							}

						}
					}
				else{

					$data= array (
							'id_member'			=> $this->input->post('username'),
							'password'			=> $this->input->post('password'),
							'nama'				=> $this->input->post('nama'),
							'alamat'			=> $this->input->post('alamat'),
							'no_hp'				=> $this->input->post('phone'),
							'email'				=> $this->input->post('email'),
							'saldo'				=> $this->input->post('saldo'),
						);
						$simpan["id_member"] = $this->input->post("username");	
						$simpan2["username"] = $this->input->post("username");
						$simpan2["password"] = md5($this->input->post("password"));
						$simpan2["stts"] = "member";
						
						if($this->football_model->cekID($simpan["id_member"])==0)
						{
							$this->football_model->insertData('tb_member',$data);
							$this->football_model->insertData('tb_login',$simpan2);	
							redirect ('admin/member');
						}
								$data['title']="Add Member";
								$data['pointer']="member";
								$data['classicon']="fa fa-users";
								$data['main_bread']="Member";
								$data['sub_bread']="Add Member";
								$data['desc']="Tambahkan Member baru (di luar register)";
								$data['data_admin']=$this->football_model->getAllData("tb_admin");
									
								$data['error']="Member sudah terdaftar";
								$tmp['content']=$this->load->view('admin/tambah_member',$data, TRUE);	
								$this->load->view('admin/layout_home',$tmp);
					}
			}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	/*save member hasil edit */
	public function save_member()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	

			$this->form_validation->set_rules('username', 'username', 'required');
			$id_member = $this->input->post('username');
			
			if ($this->form_validation->run() === FALSE)
			{

			$data['title']="Edit Member";
			$data['pointer']="member";
			$data['classicon']="fa fa-users";
			$data['main_bread']="Member";
			$data['sub_bread']="Edit Member";
			$data['desc']="Edit Member";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");
			$data['member'] = $this->football_model->getDetailMember($id_member);
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_member',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			

			$data['error']='';
			$tmp['content']=$this->load->view('admin/tambah_member',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			}
			else
			{
			if ( $_FILES['userfile']['name'] != ''){
			// load uploading file library
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']	= '1000'; //MB
			$config['max_width']  = '3000';//pixels
			$config['max_height']  = '3000';//pixels

			$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
				{	
				$data['title']="Edit Member";
				$data['pointer']="member";
				$data['classicon']="fa fa-users";
				$data['main_bread']="Member";
				$data['sub_bread']="Edit Member";
				$data['desc']="Edit Member";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");
			
				$data['member'] = $this->football_model->getDetailMember($id_member);
				
					
				$data['error']=$this->upload->display_errors();
				$tmp['content']=$this->load->view('admin/edit_member',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
				} 
			else 
				{
				//file berhasil diupload lalu lanjut ke query insert
				// eksekusi query Insert
				$gambar = $this->upload->data();
				$data= array (
					'password'			=> $this->input->post('password'),
					'nama'				=> $this->input->post('nama'),
					'img'				=> $gambar['file_name'],
					'alamat'			=> $this->input->post('alamat'),
					'no_hp'				=> $this->input->post('phone'),
					'email'				=> $this->input->post('email'),
					'saldo'				=> $this->input->post('saldo'),
				);
				$simpan["id_member"] = $this->input->post("username");	
				$simpan2["password"] = md5($this->input->post("password"));
				
				$where = array('username'=>$id_member);
			

					$this->football_model->updateDataMultiField("tb_login",$simpan2,$where);
								/*update tabel admin */
									$this->db->where('id_member',$id_member);
     								$query = $this->db->get('tb_member');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
     								
					$this->football_model->update_member($data, $id_member);
					redirect('admin/member');

			}

		}
		else{

			$data= array (
				
					'password'			=> $this->input->post('password'),
					'nama'				=> $this->input->post('nama'),
					'alamat'			=> $this->input->post('alamat'),
					'no_hp'				=> $this->input->post('phone'),
					'email'				=> $this->input->post('email'),
					'saldo'				=> $this->input->post('saldo'),
				);

				$where = array('username'=>$id_member);
				$simpan2["password"] = md5($this->input->post("password"));
				
				
					$this->football_model->update_member($data, $id_member);
					$this->football_model->updateDataMultiField("tb_login",$simpan2,$where);
					redirect ('admin/member');
				

		}
		}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	public function hapus_member()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id_member = $this->uri->segment(3);

			$this->db->where('id_member',$id_member);
     								$query = $this->db->get('tb_member');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
			$hapus = array('id_member' => $id_member);
			$hapus2 = array('username' => $id_member);
			$this->football_model->deleteData('tb_member',$hapus);
			$this->football_model->deleteData('tb_login',$hapus2);
			header('location:'.base_url().'admin/member');
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

//CRUD Operator
	public function operator()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
				/*data layout */
			$data['title']="Operator";
			$data['pointer']="operator";
			$data['classicon']="fa fa-user-plus";
			$data['main_bread']="Operator";
			$data['sub_bread']="View Operator";
			$data['desc']="Overview";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");


			/*pagination*/
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
			$tot_hal = $this->football_model->getAllData("tb_operator");
			$config['base_url'] = base_url() . 'admin/operator';
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
			
			$data['data_operator'] = $this->football_model->getAllDataLimited('tb_operator',$offset,$limit);
			/*spesific in this page */


			
			$tmp['content']=$this->load->view('admin/bg_operator',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function tambah_operator()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Add Operator";
			$data['pointer']="operator";
			$data['classicon']="fa fa-user-plus";
			$data['main_bread']="Operator";
			$data['sub_bread']="Add Operator";
			$data['desc']="Fitur menambahkan operator";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['error']='';
			$tmp['content']=$this->load->view('admin/tambah_operator',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	/*simpan operator */
	public function simpan_operator()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			
			$this->form_validation->set_rules('username', 'username', 'required');

			if ($this->form_validation->run() === FALSE)
			{

				$data['title']="Add Operator";
				$data['pointer']="operator";
				$data['classicon']="fa fa-user-plus";
				$data['main_bread']="Operator";
				$data['sub_bread']="Add Operator";
				$data['desc']="Fitur menambahkan operator";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");
				$data['error']='';
				$tmp['content']=$this->load->view('admin/tambah_operator',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
			}
			else
			{
				if ( $_FILES['userfile']['name'] != ''){
					// load uploading file library
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'jpg|png';
					$config['max_size']	= '1000'; //MB
					$config['max_width']  = '3000';//pixels
					$config['max_height']  = '3000';//pixels

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload()){	

						$data['title']="Add Operator";
						$data['pointer']="operator";
						$data['classicon']="fa fa-user-plus";
						$data['main_bread']="Operator";
						$data['sub_bread']="Add Operator";
						$data['desc']="Fitur menambahkan operator";
						$data['data_admin']=$this->football_model->getAllData("tb_admin");

						$data['error']=$this->upload->display_errors();
						$tmp['content']=$this->load->view('admin/tambah_operator',$data, TRUE);	
						$this->load->view('admin/layout_home',$tmp);
					
					} 
					else 
					{
						//file berhasil diupload lalu lanjut ke query insert
						// eksekusi query Insert
						$gambar = $this->upload->data();
						$data= array (
							'id_operator'			=> $this->input->post('username'),
							'password'			=> $this->input->post('password'),
							'nama'				=> $this->input->post('nama'),
							'img'				=> $gambar['file_name'],
							'alamat'			=> $this->input->post('alamat'),
							'no_hp'				=> $this->input->post('phone'),
						);
						$simpan["id_operator"] = $this->input->post("username");	
						$simpan2["username"] = $this->input->post("username");
						$simpan2["password"] = md5($this->input->post("password"));
						$simpan2["stts"] = "operator";
						
							if($this->football_model->cekoperator($simpan["id_operator"])==0)
							{
								$this->football_model->insertData('tb_operator',$data);
								$this->football_model->insertData('tb_login',$simpan2);	
								redirect ('admin/operator');
							}
							else{

								$data['title']="Add Operator";
								$data['pointer']="operator";
								$data['classicon']="fa fa-user-plus";
								$data['main_bread']="Operator";
								$data['sub_bread']="Add Operator";
								$data['desc']="Fitur menambahkan operator";
								$data['data_admin']=$this->football_model->getAllData("tb_admin");
									
								$data['error']="Operator sudah terdaftar";
								$tmp['content']=$this->load->view('admin/tambah_operator',$data, TRUE);	
								$this->load->view('admin/layout_home',$tmp);

							}

						}
					}
				else{

					$data= array (
							'id_operator'			=> $this->input->post('username'),
							'password'			=> $this->input->post('password'),
							'nama'				=> $this->input->post('nama'),
							'alamat'			=> $this->input->post('alamat'),
							'no_hp'				=> $this->input->post('phone'),
						);
						$simpan["id_operator"] = $this->input->post("username");	
						$simpan2["username"] = $this->input->post("username");
						$simpan2["password"] = md5($this->input->post("password"));
						$simpan2["stts"] = "operator";
						
						if($this->football_model->cekoperator($simpan["id_operator"])==0)
						{
							$this->football_model->insertData('tb_operator',$data);
							$this->football_model->insertData('tb_login',$simpan2);	
							redirect ('admin/operator');
						}

								$data['title']="Add Operator";
								$data['pointer']="operator";
								$data['classicon']="fa fa-user-plus";
								$data['main_bread']="Operator";
								$data['sub_bread']="Add Operator";
								$data['desc']="Fitur menambahkan operator";
								$data['data_admin']=$this->football_model->getAllData("tb_admin");
									
								$data['error']="Operator sudah terdaftar";
								$tmp['content']=$this->load->view('admin/tambah_operator',$data, TRUE);	
								$this->load->view('admin/layout_home',$tmp);


					}
			}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	public function hapus_operator()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id_operator = $this->uri->segment(3);

			$this->db->where('id_operator',$id_operator);
     								$query = $this->db->get('tb_operator');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
			$hapus = array('id_operator' => $id_operator);
			$hapus2 = array('username' => $id_operator);
			$this->football_model->deleteData('tb_operator',$hapus);
			$this->football_model->deleteData('tb_login',$hapus2);
			header('location:'.base_url().'admin/operator');
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function edit_operator()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Edit operator";
			$data['pointer']="operator";
			$data['classicon']="fa fa-user-plus";
			$data['main_bread']="Operator";
			$data['sub_bread']="Edit operator";
			$data['desc']="Edit operator";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['operator'] = $this->football_model->getDetailOperator($this->uri->segment(3));
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_operator',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

		/*save operator hasil edit */
	public function save_operator()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	

			$this->form_validation->set_rules('username', 'username', 'required');
			$id_operator = $this->input->post('username');
			
			if ($this->form_validation->run() === FALSE)
			{

			$data['title']="Edit operator";
			$data['pointer']="operator";
			$data['classicon']="fa fa-user-plus";
			$data['main_bread']="operator";
			$data['sub_bread']="Edit operator";
			$data['desc']="Edit operator";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['operator'] = $this->football_model->getDetailOperator($id_operator);
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_operator',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
			}
			else
			{
			if ( $_FILES['userfile']['name'] != ''){
			// load uploading file library
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']	= '1000'; //MB
			$config['max_width']  = '3000';//pixels
			$config['max_height']  = '3000';//pixels

			$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
				{	
				$data['title']="Edit operator";
				$data['pointer']="operator";
				$data['classicon']="fa fa-user-plus";
				$data['main_bread']="operator";
				$data['sub_bread']="Edit operator";
				$data['desc']="Edit operator";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");
			
				$data['operator'] = $this->football_model->getDetailOperator($id_operator);
				
					
				$data['error']=$this->upload->display_errors();
				$tmp['content']=$this->load->view('admin/edit_operator',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
				} 
			else 
				{
				//file berhasil diupload lalu lanjut ke query insert
				// eksekusi query Insert
				$gambar = $this->upload->data();
				$data= array (
					'password'			=> $this->input->post('password'),
					'nama'				=> $this->input->post('nama'),
					'img'				=> $gambar['file_name'],
					'alamat'			=> $this->input->post('alamat'),
					'no_hp'				=> $this->input->post('phone'),
				);
				$simpan["id_operator"] = $this->input->post("username");	
				$simpan2["password"] = md5($this->input->post("password"));
				
				$where = array('username'=>$id_operator);
			

					$this->football_model->updateDataMultiField("tb_login",$simpan2,$where);
								/*update tabel admin */
									$this->db->where('id_operator',$id_operator);
     								$query = $this->db->get('tb_operator');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
     								
					$this->football_model->update_operator($data, $id_operator);
					redirect('admin/operator');

			}

		}
		else{

			$data= array (	
					'password'			=> $this->input->post('password'),
					'nama'				=> $this->input->post('nama'),
					'alamat'			=> $this->input->post('alamat'),
					'no_hp'				=> $this->input->post('phone'),
				);

				$where = array('username'=>$id_operator);
				$simpan2["password"] = md5($this->input->post("password"));
				
				$this->football_model->update_operator($data, $id_operator);
				$this->football_model->updateDataMultiField("tb_login",$simpan2,$where);
				redirect ('admin/operator');
				

		}
		}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

//CRUD eksekutif
	public function eksekutif()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			/*data layout */
			$data['title']="Eksekutif";
			$data['pointer']="eksekutif";
			$data['classicon']="fa fa-user-secret";
			$data['main_bread']="Eksekutif";
			$data['sub_bread']="View eksekutif";
			$data['desc']="Overview";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");


			/*pagination*/
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
			$tot_hal = $this->football_model->getAllData("tb_eksekutif");
			$config['base_url'] = base_url() . 'admin/eksekutif';
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
			
			$data['data_eksekutif'] = $this->football_model->getAllDataLimited('tb_eksekutif',$offset,$limit);
			/*spesific in this page */


			$tmp['content']=$this->load->view('admin/bg_eksekutif',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	public function tambah_eksekutif()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Add eksekutif";
			$data['pointer']="eksekutif";
			$data['classicon']="fa fa-user-secret";
			$data['main_bread']="Eksekutif";
			$data['sub_bread']="Add eksekutif";
			$data['desc']="Fitur menambahkan eksekutif";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['error']='';
			$tmp['content']=$this->load->view('admin/tambah_eksekutif',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	/*simpan eksekutif */
	public function simpan_eksekutif()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			
			$this->form_validation->set_rules('username', 'username', 'required');

			if ($this->form_validation->run() === FALSE)
			{

				$data['title']="Add eksekutif";
				$data['pointer']="eksekutif";
				$data['classicon']="fa fa-user-secret";
				$data['main_bread']="Eksekutif";
				$data['sub_bread']="Add eksekutif";
				$data['desc']="Fitur menambahkan eksekutif";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");
				$data['error']='';
				$tmp['content']=$this->load->view('admin/tambah_eksekutif',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
			}
			else
			{
				if ( $_FILES['userfile']['name'] != ''){
					// load uploading file library
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'jpg|png';
					$config['max_size']	= '1000'; //MB
					$config['max_width']  = '3000';//pixels
					$config['max_height']  = '3000';//pixels

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload()){	

						$data['title']="Add eksekutif";
						$data['pointer']="eksekutif";
						$data['classicon']="fa fa-user-secret";
						$data['main_bread']="Eksekutif";
						$data['sub_bread']="Add eksekutif";
						$data['desc']="Fitur menambahkan eksekutif";
						$data['data_admin']=$this->football_model->getAllData("tb_admin");

						$data['error']=$this->upload->display_errors();
						$tmp['content']=$this->load->view('admin/tambah_eksekutif',$data, TRUE);	
						$this->load->view('admin/layout_home',$tmp);
					
					} 
					else 
					{
						//file berhasil diupload lalu lanjut ke query insert
						// eksekusi query Insert
						$gambar = $this->upload->data();
						$data= array (
							'id_eksekutif'		=> $this->input->post('username'),
							'password'			=> $this->input->post('password'),
							'nama'				=> $this->input->post('nama'),
							'img'				=> $gambar['file_name'],
							'alamat'			=> $this->input->post('alamat'),
							'no_hp'				=> $this->input->post('phone'),
						);
						$simpan["id_eksekutif"] = $this->input->post("username");	
						$simpan2["username"] = $this->input->post("username");
						$simpan2["password"] = md5($this->input->post("password"));
						$simpan2["stts"] = "eksekutif";
						
							if($this->football_model->cekeksekutif($simpan["id_eksekutif"])==0)
							{
								$this->football_model->insertData('tb_eksekutif',$data);
								$this->football_model->insertData('tb_login',$simpan2);	
								redirect ('admin/eksekutif');
							}
							else{

								$data['title']="Add eksekutif";
								$data['pointer']="eksekutif";
								$data['classicon']="fa fa-user-secret";
								$data['main_bread']="Eksekutif";
								$data['sub_bread']="Add eksekutif";
								$data['desc']="Fitur menambahkan eksekutif";
								$data['data_admin']=$this->football_model->getAllData("tb_admin");
									
								$data['error']="Eksekutif sudah terdaftar";
								$tmp['content']=$this->load->view('admin/tambah_eksekutif',$data, TRUE);	
								$this->load->view('admin/layout_home',$tmp);

							}

						}
					}
				else{

					$data= array (
							'id_eksekutif'		=> $this->input->post('username'),
							'password'			=> $this->input->post('password'),
							'nama'				=> $this->input->post('nama'),
							'alamat'			=> $this->input->post('alamat'),
							'no_hp'				=> $this->input->post('phone'),
						);
						$simpan["id_eksekutif"] = $this->input->post("username");	
						$simpan2["username"] = $this->input->post("username");
						$simpan2["password"] = md5($this->input->post("password"));
						$simpan2["stts"] = "eksekutif";
						
						if($this->football_model->cekeksekutif($simpan["id_eksekutif"])==0)
						{
							$this->football_model->insertData('tb_eksekutif',$data);
							$this->football_model->insertData('tb_login',$simpan2);	
							redirect ('admin/eksekutif');
						}

								$data['title']="Add eksekutif";
								$data['pointer']="eksekutif";
								$data['classicon']="fa fa-user-secret";
								$data['main_bread']="Eksekutif";
								$data['sub_bread']="Add eksekutif";
								$data['desc']="Fitur menambahkan eksekutif";
								$data['data_admin']=$this->football_model->getAllData("tb_admin");
									
								$data['error']="Eksekutif sudah terdaftar";
								$tmp['content']=$this->load->view('admin/tambah_eksekutif',$data, TRUE);	
								$this->load->view('admin/layout_home',$tmp);


					}
			}
		}
		else
		{
		
			header('location:'.base_url().'web/log');
		}
	}


	public function hapus_eksekutif()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id_eksekutif = $this->uri->segment(3);

			$this->db->where('id_eksekutif',$id_eksekutif);
     								$query = $this->db->get('tb_eksekutif');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}

			$hapus = array('id_eksekutif' => $id_eksekutif);
			$hapus2 = array('username' => $id_eksekutif);
			$this->football_model->deleteData('tb_eksekutif',$hapus);
			$this->football_model->deleteData('tb_login',$hapus2);
			header('location:'.base_url().'admin/eksekutif');
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function edit_eksekutif()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Edit eksekutif";
			$data['pointer']="eksekutif";
			$data['classicon']="fa fa-user-secret";
			$data['main_bread']="Eksekutif";
			$data['sub_bread']="Edit eksekutif";
			$data['desc']="Edit eksekutif";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['eksekutif'] = $this->football_model->getDetaileksekutif($this->uri->segment(3));
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_eksekutif',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

		/*save eksekutif hasil edit */
	public function save_eksekutif()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	

			$this->form_validation->set_rules('username', 'username', 'required');
			$id_eksekutif = $this->input->post('username');
			
			if ($this->form_validation->run() === FALSE)
			{

			$data['title']="Edit eksekutif";
			$data['pointer']="eksekutif";
			$data['classicon']="fa fa-user-secret";
			$data['main_bread']="Eksekutif";
			$data['sub_bread']="Edit eksekutif";
			$data['desc']="Edit eksekutif";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['eksekutif'] = $this->football_model->getDetaileksekutif($id_eksekutif);
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_eksekutif',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
			}
			else
			{
			if ( $_FILES['userfile']['name'] != ''){
			// load uploading file library
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']	= '1000'; //MB
			$config['max_width']  = '3000';//pixels
			$config['max_height']  = '3000';//pixels

			$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
				{	
				$data['title']="Edit eksekutif";
				$data['pointer']="eksekutif";
				$data['classicon']="fa fa-user-secret";
				$data['main_bread']="Eksekutif";
				$data['sub_bread']="Edit eksekutif";
				$data['desc']="Edit eksekutif";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");
			
				$data['eksekutif'] = $this->football_model->getDetaileksekutif($id_eksekutif);
				
					
				$data['error']=$this->upload->display_errors();
				$tmp['content']=$this->load->view('admin/edit_eksekutif',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
				} 
			else 
				{
				//file berhasil diupload lalu lanjut ke query insert
				// eksekusi query Insert
				$gambar = $this->upload->data();
				$data= array (
					'password'			=> $this->input->post('password'),
					'nama'				=> $this->input->post('nama'),
					'img'				=> $gambar['file_name'],
					'alamat'			=> $this->input->post('alamat'),
					'no_hp'				=> $this->input->post('phone'),
				);
				$simpan["id_eksekutif"] = $this->input->post("username");	
				$simpan2["password"] = md5($this->input->post("password"));
				
				$where = array('username'=>$id_eksekutif);
			

					$this->football_model->updateDataMultiField("tb_login",$simpan2,$where);
								/*update tabel admin */
									$this->db->where('id_eksekutif',$id_eksekutif);
     								$query = $this->db->get('tb_eksekutif');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
     								
					$this->football_model->update_eksekutif($data, $id_eksekutif);
					redirect('admin/eksekutif');

			}

		}
		else{

			$data= array (	
					'password'			=> $this->input->post('password'),
					'nama'				=> $this->input->post('nama'),
					'alamat'			=> $this->input->post('alamat'),
					'no_hp'				=> $this->input->post('phone'),
				);

				$where = array('username'=>$id_eksekutif);
				$simpan2["password"] = md5($this->input->post("password"));
				
				$this->football_model->update_eksekutif($data, $id_eksekutif);
				$this->football_model->updateDataMultiField("tb_login",$simpan2,$where);
				redirect ('admin/eksekutif');
				

		}
		}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

//CRUD Tim
	public function tim()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			/*data layout */
			$data['title']="Tim";
			$data['pointer']="tim";
			$data['classicon']="fa fa-futbol-o";
			$data['main_bread']="Tim";
			$data['sub_bread']="View Tim";
			$data['desc']="Overview";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");


			/*pagination*/
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
			$tot_hal = $this->football_model->getAllData("tb_tim");
			$config['base_url'] = base_url() . 'admin/tim';
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
			
			$data['data_tim'] = $this->football_model->getAllDataLimited('tb_tim',$offset,$limit);
			/*spesific in this page */


			$tmp['content']=$this->load->view('admin/bg_tim',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function tambah_tim()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Add Tim";
			$data['pointer']="tim";
			$data['classicon']="fa fa-futbol-o";
			$data['main_bread']="Tim";
			$data['sub_bread']="Add Tim";
			$data['desc']="Fitur menambahkan tim pemain";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['error']='';
			$tmp['content']=$this->load->view('admin/tambah_tim',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

		/*simpan tim */
	public function simpan_tim()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			
			$this->form_validation->set_rules('kode_tim', 'kode_tim', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$data['title']="Tim";
				$data['pointer']="tim";
				$data['classicon']="fa fa-futbol-o";
				$data['main_bread']="Tim";
				$data['sub_bread']="View Tim";
				$data['desc']="Overview";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");

	
				$data['error']='';
				$tmp['content']=$this->load->view('admin/tambah_tim',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
			}
			else
			{
				if ( $_FILES['userfile']['name'] != ''){
					// load uploading file library
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'jpg|png';
					$config['max_size']	= '1000'; //MB
					$config['max_width']  = '3000';//pixels
					$config['max_height']  = '3000';//pixels

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload()){	

						$data['title']="Tim";
						$data['pointer']="tim";
						$data['classicon']="fa fa-futbol-o";
						$data['main_bread']="Tim";
						$data['sub_bread']="View Tim";
						$data['desc']="Overview";
						$data['data_admin']=$this->football_model->getAllData("tb_admin");

						$data['error']=$this->upload->display_errors();
						$tmp['content']=$this->load->view('admin/tambah_tim',$data, TRUE);	
						$this->load->view('admin/layout_home',$tmp);
					
					} 
					else 
					{
						//file berhasil diupload lalu lanjut ke query insert
						// eksekusi query Insert
						$gambar = $this->upload->data();
						$data= array (
							'kode_tim'		=> $this->input->post('kode_tim'),
							'nama_tim'		=> $this->input->post('nama_tim'),
							'asal_tim'		=> $this->input->post('asal_tim'),
							'img'			=> $gambar['file_name'],
						);
						$simpan["kode_tim"] = $this->input->post("kode_tim");	
						
							if($this->football_model->cektim($simpan["kode_tim"])==0)
							{
								$this->football_model->insertData('tb_tim',$data);
								redirect ('admin/tim');
							}
							else{

								$data['title']="Tim";
								$data['pointer']="tim";
								$data['classicon']="fa fa-futbol-o";
								$data['main_bread']="Tim";
								$data['sub_bread']="View Tim";
								$data['desc']="Overview";
								$data['data_admin']=$this->football_model->getAllData("tb_admin");

							
								$data['error']="Kode Tim Sudah Ada";
								$tmp['content']=$this->load->view('admin/tambah_tim',$data, TRUE);	
								$this->load->view('admin/layout_home',$tmp);

							}

						}
					}
				else{

					$data= array (
							'kode_tim'		=> $this->input->post('kode_tim'),
							'nama_tim'		=> $this->input->post('nama_tim'),
							'asal_tim'		=> $this->input->post('asal_tim'),
						);

						$simpan["kode_tim"] = $this->input->post("kode_tim");	
						
						if($this->football_model->cektim($simpan["kode_tim"])==0)
						{
							$this->football_model->insertData('tb_tim',$data);
							
							redirect ('admin/tim');
						}

							$data['title']="Tim";
							$data['pointer']="tim";
							$data['classicon']="fa fa-futbol-o";
							$data['main_bread']="Tim";
							$data['sub_bread']="View Tim";
							$data['desc']="Overview";
							$data['data_admin']=$this->football_model->getAllData("tb_admin");

							
							$data['error']="Kode Tim Sudah Ada";
							$tmp['content']=$this->load->view('admin/tambah_tim',$data, TRUE);	
							$this->load->view('admin/layout_home',$tmp);


					}
			}
		}
		else
		{
		
			header('location:'.base_url().'web/log');
		}
	}

	public function hapus_tim()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id_tim = $this->uri->segment(3);

			$this->db->where('id_tim',$id_tim);
     								$query = $this->db->get('tb_tim');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
			$hapus = array('id_tim' => $id_tim);
			
			$this->football_model->deleteData('tb_tim',$hapus);
			header('location:'.base_url().'admin/tim');
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function edit_tim()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Edit Tim";
			$data['pointer']="tim";
			$data['classicon']="fa fa-futbol-o";
			$data['main_bread']="Tim";
			$data['sub_bread']="Edit tim";
			$data['desc']="Edit Tim yang bermain";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['tim'] = $this->football_model->getDetailTim($this->uri->segment(3));
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_tim',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function save_tim()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	

			$this->form_validation->set_rules('kode_tim', 'kode_tim', 'required');
			$id_tim =$this->input->post('id_tim');
			
			if ($this->form_validation->run() === FALSE)
			{
			$data['title']="Edit Tim";
			$data['pointer']="tim";
			$data['classicon']="fa fa-futbol-o";
			$data['main_bread']="Tim";
			$data['sub_bread']="Edit tim";
			$data['desc']="Edit Tim";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['tim'] = $this->football_model->getDetailtim($id_tim);
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_tim',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
			}
			else
			{
			if ( $_FILES['userfile']['name'] != ''){
			// load uploading file library
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']	= '1000'; //MB
			$config['max_width']  = '3000';//pixels
			$config['max_height']  = '3000';//pixels

			$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
				{	
				$data['title']="Edit Tim";
				$data['pointer']="tim";
				$data['classicon']="fa fa-futbol-o";
				$data['main_bread']="tim";
				$data['sub_bread']="Edit Tim";
				$data['desc']="Edit tim";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");
			
				$data['tim'] = $this->football_model->getDetailtim($id_tim);
				
					
				$data['error']=$this->upload->display_errors();
				$tmp['content']=$this->load->view('admin/edit_tim',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
				} 
			else 
				{
				//file berhasil diupload lalu lanjut ke query insert
				// eksekusi query Insert
				$gambar = $this->upload->data();
				$data= array (
					'kode_tim'		=> $this->input->post('kode_tim'),
					'nama_tim'		=> $this->input->post('nama_tim'),
					'asal_tim'		=> $this->input->post('asal_tim'),
					'img'			=> $gambar['file_name'],
				);
								/*update tabel  tim */
									$this->db->where('id_tim',$id_tim);
     								$query = $this->db->get('tb_tim');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
     								
					$this->football_model->update_tim($data, $id_tim);
					redirect('admin/tim');

			}

		}
		else{

			$data= array (	
					'kode_tim'		=> $this->input->post('kode_tim'),
					'nama_tim'		=> $this->input->post('nama_tim'),
					'asal_tim'		=> $this->input->post('asal_tim'),
				);

				$this->football_model->update_tim($data, $id_tim);
				redirect ('admin/tim');
				

		}
		}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

//CRUD kelas
	public function kelas()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			/*data layout */
			$data['title']="Kelas";
			$data['pointer']="kelas";
			$data['classicon']="fa fa-wheelchair";
			$data['main_bread']="Kelas";
			$data['sub_bread']="View kelas";
			$data['desc']="Overview";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");


			/*pagination*/
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
			$tot_hal = $this->football_model->getAllData("tb_kelas");
			$config['base_url'] = base_url() . 'admin/kelas';
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
			
			$data['data_kelas'] = $this->football_model->getAllDataLimited('tb_kelas',$offset,$limit);
			/*spesific in this page */


			$tmp['content']=$this->load->view('admin/bg_kelas',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function tambah_kelas()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Add kelas";
			$data['pointer']="kelas";
			$data['classicon']="fa fa-wheelchair";
			$data['main_bread']="Kelas";
			$data['sub_bread']="Add kelas";
			$data['desc']="Fitur menambahkan kelas ";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['error']='';
			$tmp['content']=$this->load->view('admin/tambah_kelas',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	/*simpan kelas */
	public function simpan_kelas()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			
			$this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$data['title']="kelas";
				$data['pointer']="kelas";
				$data['classicon']="fa fa-wheelchair";
				$data['main_bread']="Kelas";
				$data['sub_bread']="View kelas";
				$data['desc']="Overview";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");

	
				$data['error']='';
				$tmp['content']=$this->load->view('admin/tambah_kelas',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
			}
			else
			{
				
					$data= array (
							'nama_kelas' => $this->input->post('nama_kelas'),
							'max_kuota' => $this->input->post('max_kuota'),
							'def_harga' => $this->input->post('def_harga'),

						);

						$simpan["nama_kelas"] = $this->input->post("nama_kelas");	
						
						if($this->football_model->cekkelas($simpan["nama_kelas"])==0)
						{
							$this->football_model->insertData('tb_kelas',$data);
							
							redirect ('admin/kelas');
						}
						else{

							$data['title']="Kelas";
							$data['pointer']="kelas";
							$data['classicon']="fa fa-wheelchair";
							$data['main_bread']="Kelas";
							$data['sub_bread']="View kelas";
							$data['desc']="Overview";
							$data['data_admin']=$this->football_model->getAllData("tb_admin");

							
							$data['error']="Nama kelas Sudah Ada";
							$tmp['content']=$this->load->view('admin/tambah_kelas',$data, TRUE);	
							$this->load->view('admin/layout_home',$tmp);


						}
			
			}
		}
		else
		{
		
			header('location:'.base_url().'web/log');
		}
	}

	public function hapus_kelas()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id_kelas = $this->uri->segment(3);
     							
			$hapus = array('id_kelas' => $id_kelas);
			
			$this->football_model->deleteData('tb_kelas',$hapus);
			header('location:'.base_url().'admin/kelas');
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function edit_kelas()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$data['title']="Edit kelas";
			$data['pointer']="kelas";
			$data['classicon']="fa fa-wheelchair";
			$data['main_bread']="Kelas";
			$data['sub_bread']="Edit kelas";
			$data['desc']="Edit kelas";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['kelas'] = $this->football_model->getDetailkelas($this->uri->segment(3));
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_kelas',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function save_kelas()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	

			$this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'required');
			$id_kelas =$this->input->post('id_kelas');
			
			if ($this->form_validation->run() === FALSE)
			{
			$data['title']="Edit kelas";
			$data['pointer']="kelas";
			$data['classicon']="fa fa-wheelchair";
			$data['main_bread']="Kelas";
			$data['sub_bread']="Edit kelas";
			$data['desc']="Edit kelas";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

			$data['kelas'] = $this->football_model->getDetailkelas($id_kelas);
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_kelas',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			}
			else
			{
			
			$data= array (	
					'nama_kelas'		=> $this->input->post('nama_kelas'),
					'max_kuota'			=> $this->input->post('max_kuota'),
					'def_harga'			=> $this->input->post('def_harga'),
				);

				$this->football_model->update_kelas($data, $id_kelas);
				redirect ('admin/kelas');
				

			}
		
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

//CRUD jadwal
	public function jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			/*data layout */
			$data['title']="Jadwal";
			$data['pointer']="jadwal";
			$data['classicon']="fa fa-calendar";
			$data['main_bread']="Jadwal";
			$data['sub_bread']="View Jadwal";
			$data['desc']="Overview";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");


			/*pagination*/
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
			$tot_hal = $this->football_model->getAllData("tb_jadwal");
			$config['base_url'] = base_url() . 'admin/jadwal';
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
			
			$data['data_jadwal'] = $this->football_model->getAllDataLimited('tb_jadwal',$offset,$limit);
			$data['data_tim']=$this->football_model->getAllData("tb_tim");
			
			/*spesific in this page */


			$tmp['content']=$this->load->view('admin/bg_jadwal',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	/*simpan kelas */
	public function tambah_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			
			$this->form_validation->set_rules('tim1', 'tim1', 'required');
			$this->form_validation->set_rules('tim2', 'tim2', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$data['data_tim']=$this->football_model->getAllData("tb_tim");
				$data['title']="Jadwal";
				$data['pointer']="jadwal";
				$data['classicon']="fa fa-calendar";
				$data['main_bread']="Jadwal";
				$data['sub_bread']="Tambah Jadwal";
				$data['desc']="Overview";
				$data['data_admin']=$this->football_model->getAllData("tb_admin");

	
				$data['error']='';
				$tmp['content']=$this->load->view('admin/tambah_jadwal',$data, TRUE);	
				$this->load->view('admin/layout_home',$tmp);
				
			}
			else
			{
				
					$data= array (
							'id_tim1' => $this->input->post('tim1'),
							'id_tim2' => $this->input->post('tim2'),
							'tanggal' => $this->input->post('tanggal'),
							'jam' => $this->input->post('jam'),


						);

							$this->football_model->insertData('tb_jadwal',$data);
							
							redirect ('admin/jadwal');
			
			}
		}
		else
		{
		
			header('location:'.base_url().'web/log');
		}
	}

	public function edit_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$id_jadwal=$this->uri->segment(3);

			$data['title']="Edit Jadwal";
			$data['pointer']="jadwal";
			$data['classicon']="fa fa-calendar";
			$data['main_bread']="Jadwal";
			$data['sub_bread']="Edit Jadwal";
			$data['desc']="Edit jadwal";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");
			$data['data_tim']=$this->football_model->getAllData("tb_tim");

			$data['jadwal'] = $this->football_model->getDetailjadwal($id_jadwal);
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_jadwal',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	public function save_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	

			$this->form_validation->set_rules('tim1', 'tim1', 'required');

			$this->form_validation->set_rules('tim2', 'tim2', 'required');

			$id_jadwal=$this->input->post('id_jadwal');
			
			if ($this->form_validation->run() === FALSE)
			{
			$data['title']="Edit Jadwal";
			$data['pointer']="jadwal";
			$data['classicon']="fa fa-calendar";
			$data['main_bread']="Jadwal";
			$data['sub_bread']="Edit Jadwal";
			$data['desc']="Edit jadwal";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");
			$data['data_tim']=$this->football_model->getAllData("tb_tim");

			$data['jadwal'] = $this->football_model->getDetailjadwal($id_jadwal);
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_jadwal',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			}
			else
			{
			
			$data= array (
							'id_tim1' => $this->input->post('tim1'),
							'id_tim2' => $this->input->post('tim2'),
							'tanggal' => $this->input->post('tanggal'),
							'jam' => $this->input->post('jam'),


						);

				$this->football_model->update_jadwal($data, $id_jadwal);
				redirect ('admin/jadwal');
				

			}
		
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function hapus_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id_jadwal = $this->uri->segment(3);
     							
			$hapus = array('id_jadwal' => $id_jadwal);
			
			$this->football_model->deleteData('tb_jadwal',$hapus);
			header('location:'.base_url().'admin/jadwal');
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	public function detail_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	

			
			$this->session->set_userdata('id_jadwal',$this->uri->segment(3));
			$id_jadwal = $this->session->userdata('id_jadwal');

			$data['title']="Tambah Kelas Jadwal";
			$data['pointer']="jadwal";
			$data['classicon']="fa fa-calendar";
			$data['main_bread']="Jadwal";
			$data['sub_bread']="Tambah Kelas Jadwal";
			$data['desc']="Tambah Kuota Kelas Masing Jadwal";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");
			$data['data_kelas']=$this->football_model->getAllData("tb_kelas");

			$data['det_kelas'] = $this->football_model->getDetailklsjadwal($id_jadwal);
			$data['error']='';
			$tmp['content']=$this->load->view('admin/edit_kelas_harga',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	public function tambah_jadwal_kls()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$id_jadwal = $this->session->userdata('id_jadwal');
			$this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
			

			if ($this->form_validation->run() === FALSE)
			{
			
			$data['title']="Add Jadwal kelas";
			$data['pointer']="detail_jadwal";
			$data['classicon']="fa fa-calendar";
			$data['main_bread']="Detail Jadwal";
			$data['sub_bread']="Add Jadwal Kelas";
			$data['desc']="Fitur menambahkan kelas untuk masing - masing Jadwal ";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");
			$data['data_kelas']=$this->football_model->getAllData("tb_kelas");

			$data['error']='';
			$tmp['content']=$this->load->view('admin/tambah_jadwal_kls',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);

		

			
			}
			else{
			$id_kelas=$this->input->post('id_kelas');
			$def_stock=$this->football_model->get_detail_kelas($id_kelas)->max_kuota;
			$def_harga=$this->football_model->get_detail_kelas($id_kelas)->def_harga;

					$data= array (
				
							'id_jadwal' => $id_jadwal,
							'id_kelas' => $id_kelas,
							'stock_awal' => $def_stock,
							'harga' => $def_harga,
							'stock_akhir' => $def_stock,
						);

							$this->football_model->insertData('tb_jadwal_kelas',$data);
							
							redirect ('admin/detail_jadwal/'.$id_jadwal);
			}
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	public function hapus_jadwal_kelas()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id_jadwal_kls= $this->uri->segment(3);
     							
			$hapus = array('id_jadwal_kls' => $id_jadwal_kls);
			
			$this->football_model->deleteData('tb_jadwal_kelas',$hapus);
			header('location:'.base_url().'admin/jadwal');
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


	public function guestbook($id_guest=NULL)
	{
		/*data layout */
			$data['title']="Guestbook View";
			$data['pointer']="guestbook";
			$data['classicon']="ace-icon fa fa-home home-icon";
			$data['main_bread']="Guestbook";
			$data['sub_bread']="Setting Guestbook";
			$data['desc']="Hide / Show Guestbook";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");

		$jml = $this->db->get('guestbook');
		// Pengaturan pagination

		$config['base_url'] = base_url().'admin/guestbook/';
		$config['total_rows'] = $jml->num_rows();
		$config['per_page'] = '5';
		$config['uri_segment']='4';

		//inisialisasi config
		 $this->pagination->initialize($config);

		 //buat pagination
		 $data['halaman']= $this->pagination->create_links();

		$data['title']='Guestbook';
		$data['title_box']='Guestbook';
		$data['gbook_list']=$this->football_model->select_guestbook($config['per_page'], $this->uri->segment(4));
		$tmp['content']=$this->load->view('admin/bg_guestbook', $data, TRUE);
		$this->load->view('admin/layout_home',$tmp);

	}

	public function show($id_guest)
	{
		$data='1';
		$status = array(
               'status' => $data);

		$this->football_model->change_status($id_guest, $status);
				redirect('admin/guestbook/');

	}

	public function hide($id_guest)
	{
		$data='0';
		$status = array(
               'status' => $data);
		

		$this->football_model->change_status($id_guest, $status);
				redirect('admin/guestbook/');
	}

	public function delete($id_guest)
	{
		$this->football_model->delete_guestbook($id_guest);
		redirect('admin/guestbook/');

	}

	public function report_pemesanan()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
			{	
			$id_eksekutif = $this->session->userdata('username');
			/*data layout */
			$data['title']="Report Pemesanan";
			$data['pointer']="report_pemesanan";
			$data['classicon']="ace-icon fa fa-line-chart";
			$data['main_bread']="Pemesanan";
			$data['sub_bread']="Report Pemesanan";
			$data['desc']="Overview Pemesanan";
			$data['data_admin']=$this->football_model->getAllData("tb_admin");


			$data['report']=$this->football_model->getAllData("tb_pemesanan");
			$data['data_member']=$this->football_model->getAllData("tb_member");
			$data['data_tim']=$this->football_model->getAllData("tb_tim");
			
			$tmp['content']=$this->load->view('admin/bg_rep_pesan',$data, TRUE);	
			$this->load->view('admin/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


}
	


/* End of file admin.php */
/* Location: ./application/controllers/admin.php */