<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eksekutif extends MY_Controller {

	//menampilkan home eksekutif
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='eksekutif')
			{	
			$id_eksekutif = $this->session->userdata('username');
			/*data layout */
			$data['title']="Eksekutif Home";
			$data['pointer']="index";
			$data['classicon']="ace-icon fa fa-home home-icon";
			$data['main_bread']="Home";
			$data['sub_bread']="Dashboard";
			$data['desc']="Overview";
			$data['data_eksekutif']=$this->football_model->getDetaileksekutif($id_eksekutif);


			$tmp['content']=$this->load->view('eksekutif/bg_home',$data, TRUE);	
			$this->load->view('eksekutif/layout_home',$tmp);
			
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
		if(!empty($cek) && $stts=='eksekutif')
		{	
			/*data layout */
			$id_eksekutif = $this->session->userdata('username');
			/*$this->form_validation->set_rules('nama', 'nama', 'required');*/

			$data['title']="Eksekutif Profil";
			$data['pointer']="profile";
			$data['classicon']="menu-icon fa fa-user";
			$data['main_bread']="Profile";
			$data['sub_bread']="View Profile";
			$data['desc']="Profile Information";
			/*$data['data_eksekutif']=$this->football_model->getAllData("tb_eksekutif");*/
			$data['data_eksekutif']=$this->football_model->getDetaileksekutif($id_eksekutif);

			$data['username'] = $this->session->userdata('username');
			$data['password'] = $this->session->userdata('password');
			$data['user'] = $this->session->userdata('stts');
			
			
			$tmp['content']=$this->load->view('eksekutif/profile',$data, TRUE);	
			$this->load->view('eksekutif/layout_home',$tmp);
	
			
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
		if(!empty($cek) && $stts=='eksekutif')
		{	

		$id_eksekutif = $this->session->userdata('username');
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
					//$data['data_eksekutif']=$this->football_model->getAllData("tb_eksekutif");
					$data['data_eksekutif']=$this->football_model->getDetaileksekutif($id_eksekutif);

					/*spesifik halaman */
					$data['error']='';
					$data['name_eksekutif']=$this->football_model->getDetaileksekutif($id_eksekutif);
					$tmp['content']=$this->load->view('eksekutif/edit_profile',$data, TRUE);	
					$this->load->view('eksekutif/layout_home',$tmp);
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
									

									$data['data_eksekutif']=$this->football_model->getDetaileksekutif($id_eksekutif);
									$data['error']=$this->upload->display_errors();
									$data['name_eksekutif'] = $this->football_model->get_id($id_eksekutif);
									$tmp['content']=$this->load->view('eksekutif/edit_profile',$data, TRUE);	
									$this->load->view('eksekutif/layout_home',$tmp);
									
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
								$where = array('username'=>$id_eksekutif);

									$this->football_model->updateDataMultiField("tb_login",$updatelog,$where);
								/*update tabel eksekutif */
									$this->db->where('id_eksekutif',$id_eksekutif);
     								$query = $this->db->get('tb_eksekutif');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
     								
									$this->football_model->update_eksekutif($data,$id_eksekutif);
									redirect('eksekutif/profile');
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
								$where = array('username'=>$id_eksekutif);

								$this->football_model->updateDataMultiField("tb_login",$updatelog,$where);
								$this->football_model->update_eksekutif($data,$id_eksekutif);
						redirect('eksekutif/profile');
					}

			}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

		//menampilkan home eksekutif
	public function report_topup()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='eksekutif')
			{	
			$id_eksekutif = $this->session->userdata('username');
			/*data layout */
			$data['title']="Laporan TopUp Saldo Member";
			$data['pointer']="report_topup";
			$data['classicon']="ace-icon fa fa-dollar";
			$data['main_bread']="Home";
			$data['sub_bread']="Dashboard";
			$data['desc']="Overview";
			$data['data_eksekutif']=$this->football_model->getDetaileksekutif($id_eksekutif);

			$data['topup']=$this->football_model->getAllData("tb_topup");
			$data['data_operator']=$this->football_model->getAllData("tb_operator");
			$data['data_member']=$this->football_model->getAllData("tb_member");
			$tmp['content']=$this->load->view('eksekutif/bg_rep_topup',$data, TRUE);	
			$this->load->view('eksekutif/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function report_pemesanan()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='eksekutif')
			{	
			$id_eksekutif = $this->session->userdata('username');
			/*data layout */
			$data['title']="Eksekutif Home";
			$data['pointer']="index";
			$data['classicon']="ace-icon fa fa-futbol-o";
			$data['main_bread']="Home";
			$data['sub_bread']="Dashboard";
			$data['desc']="Overview";
			$data['data_eksekutif']=$this->football_model->getDetaileksekutif($id_eksekutif);


			$data['report']=$this->football_model->getAllData("tb_pemesanan");
			$data['data_member']=$this->football_model->getAllData("tb_member");
			$data['data_tim']=$this->football_model->getAllData("tb_tim");
			


			$tmp['content']=$this->load->view('eksekutif/bg_rep_pesan',$data, TRUE);	
			$this->load->view('eksekutif/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


}

/* End of file eksekutif.php */
/* Location: ./application/controllers/eksekutif.php */