<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operator extends MY_Controller {
	
	//menampilkan home operator
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='operator')
			{	
			$id_operator = $this->session->userdata('username');
			/*data layout */
			$data['title']="Operator Home";
			$data['pointer']="index";
			$data['classicon']="ace-icon fa fa-home home-icon";
			$data['main_bread']="Home";
			$data['sub_bread']="Dashboard";
			$data['desc']="Overview";
			$data['data_operator']=$this->football_model->getDetailOperator($id_operator);


			$tmp['content']=$this->load->view('operator/bg_home',$data, TRUE);	
			$this->load->view('operator/layout_home',$tmp);
			
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
		if(!empty($cek) && $stts=='operator')
		{	
			/*data layout */
			$id_operator = $this->session->userdata('username');
			/*$this->form_validation->set_rules('nama', 'nama', 'required');*/

			$data['title']="Operator Profil";
			$data['pointer']="profile";
			$data['classicon']="menu-icon fa fa-user";
			$data['main_bread']="Profile";
			$data['sub_bread']="View Profile";
			$data['desc']="Profile Information";
			/*$data['data_operator']=$this->football_model->getAllData("tb_operator");*/
			$data['data_operator']=$this->football_model->getDetailOperator($id_operator);

			$data['username'] = $this->session->userdata('username');
			$data['password'] = $this->session->userdata('password');
			$data['user'] = $this->session->userdata('stts');
			
			
			$tmp['content']=$this->load->view('operator/profile',$data, TRUE);	
			$this->load->view('operator/layout_home',$tmp);
	
			
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
		if(!empty($cek) && $stts=='operator')
		{	

		$id_operator = $this->session->userdata('username');
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
					//$data['data_operator']=$this->football_model->getAllData("tb_operator");
					$data['data_operator']=$this->football_model->getDetailOperator($id_operator);

					/*spesifik halaman */
					$data['error']='';
					$data['name_operator']=$this->football_model->getDetailOperator($id_operator);
					$tmp['content']=$this->load->view('operator/edit_profile',$data, TRUE);	
					$this->load->view('operator/layout_home',$tmp);
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
									

									$data['data_operator']=$this->football_model->getDetailOperator($id_operator);
									$data['error']=$this->upload->display_errors();
									$data['name_operator'] = $this->football_model->get_id($id_operator);
									$tmp['content']=$this->load->view('operator/edit_profile',$data, TRUE);	
									$this->load->view('operator/layout_home',$tmp);
									
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
								$where = array('username'=>$id_operator);

									$this->football_model->updateDataMultiField("tb_login",$updatelog,$where);
								/*update tabel operator */
									$this->db->where('id_operator',$id_operator);
     								$query = $this->db->get('tb_operator');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
     								
									$this->football_model->update_operator($data,$id_operator);
									redirect('operator/profile');
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
								$where = array('username'=>$id_operator);

								$this->football_model->updateDataMultiField("tb_login",$updatelog,$where);
								$this->football_model->update_operator($data,$id_operator);
						redirect('operator/profile');
					}

			}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	// search member for topup
	public function topup()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='operator')
		{	
			
			$id_operator = $this->session->userdata('username');

				$data['data_member']=$this->football_model->getAllData("tb_member");
				$data['title']="Top Up";
				$data['pointer']="topup";
				$data['classicon']="fa fa-dollar";
				$data['main_bread']="Top Up";
				$data['sub_bread']="Insert TopUp";
				$data['desc']="Form Topup untuk menambah Saldo Member";
				$data['data_operator']=$this->football_model->getDetailOperator($id_operator);

	
				$data['error']='';
				$tmp['content']=$this->load->view('operator/form_topup',$data, TRUE);	
				$this->load->view('operator/layout_home',$tmp);
		}
		else
		{
		
			header('location:'.base_url().'web/log');
		}
	}

	public function next_topup()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='operator')
		{	

			$this->form_validation->set_rules('ID-Member', 'ID-Member', 'required');
			$this->form_validation->set_rules('topup', 'topup', 'required');
			$id_operator = $this->session->userdata('username');
			if ($this->form_validation->run() == FALSE)
			{
				$data['data_member']=$this->football_model->getAllData("tb_member");
				$data['title']="Top Up";
				$data['pointer']="topup";
				$data['classicon']="fa fa-dollar";
				$data['main_bread']="Top Up";
				$data['sub_bread']="Insert TopUp";
				$data['desc']="Form Topup untuk menambah Saldo Member";
				$data['data_operator']=$this->football_model->getDetailOperator($id_operator);

	
				$data['error']='Data Belum Terisi Semua';
				$tmp['content']=$this->load->view('operator/form_topup',$data, TRUE);	
				$this->load->view('operator/layout_home',$tmp);

			}
			else{
				$id_member=$this->input->post("ID-Member");
				$nilai_topup=$this->input->post("topup");
				
				$saldo_awal= $this->football_model->get_saldo($id_member)->saldo;
				$saldo_akhir=$saldo_awal+$nilai_topup;

				$data= array (
							'id_member'			=> $id_member,
							'id_operator'		=> $id_operator,
							'jumlah_topup'		=> $nilai_topup,
						);

				$this->football_model->insertData('tb_topup',$data);
				$id = $this->db->insert_id();

				$data2= array (
							'id_topup'			=> $id,
							'saldo_sebelum'		=> $saldo_awal,
							'saldo_akhir'       => $saldo_akhir,
						);

				$this->football_model->insertData('tb_nota',$data2);

				$data3= array (
							'saldo' => $saldo_akhir,
						);

				$this->football_model->update_member($data3, $id_member);
				redirect('operator/invoice/'.$id.'');

			}
		}
		else
		{
		
			header('location:'.base_url().'web/log');
		}
	}


	public function invoice()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='operator')
		{	
			$id = $this->uri->segment(3);
			$id_operator = $this->session->userdata('username');
				$data['title']="Invoice/ Nota";
				$data['pointer']="topup";
				$data['classicon']="fa fa-dollar";
				$data['main_bread']="Top Up";
				$data['sub_bread']="View Invoice / Nota";
				$data['desc']="Invoice Topup";
				$data['data_operator']=$this->football_model->getDetailOperator($id_operator);

				$data['data_topupnota']=$this->football_model->getIdLastNota($id);
				$data['data_nota']=$this->football_model->getAllData("tb_nota");

				$data['data_topup']=$this->football_model->getIdLastTopUp($id);
				$data['data_member']=$this->football_model->getAllData("tb_member");

				$tmp['content']=$this->load->view('operator/bg_invoice',$data, TRUE);	
				$this->load->view('operator/layout_home',$tmp);
		}
		else
		{
		
			header('location:'.base_url().'web/log');
		}
	}

	}

/* End of file operator.php */
/* Location: ./application/controllers/operator.php */