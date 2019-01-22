<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller 
{
	
	//menampilkan home member
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='member')
		{	
			$idmember = $this->session->userdata('username');
			/*data layout */
			$data['title']="Member Home";
			$data['pointer']="index";
			$data['classicon']="ace-icon fa fa-home home-icon";
			$data['main_bread']="Home";
			$data['sub_bread']="Dashboard";
			$data['desc']="Overview";
			$data['data_member']=$this->football_model->getDetailMember($idmember);
			$data['data_topup']=$this->football_model->get_detailtopup_limit($idmember);
			
			if(is_object($this->football_model->get_last_pesan($idmember))){
				$id=$this->football_model->get_last_pesan($idmember)->id_pemesanan;
				$jadwal=$this->football_model->get_obj_jadwal($id)->id_jadwal;
				$data['data_jadwal']=$this->football_model->getDetailjadwal($jadwal);
				
			}
			else{
				$data['data_jadwal']=array();
			}

			$data['data_tim']=$this->football_model->getAllData("tb_tim");



			$tmp['content']=$this->load->view('member/bg_home',$data, TRUE);	
			$this->load->view('member/layout_home',$tmp);
			
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
		if(!empty($cek) && $stts=='member')
		{	
			$idmember = $this->session->userdata('username');
			/*data layout */
			$data['title']="Member Profil";
			$data['pointer']="profile";
			$data['classicon']="menu-icon fa fa-user";
			$data['main_bread']="Profile";
			$data['sub_bread']="View Profile";
			$data['desc']="Profile Information";
			$data['data_member']=$this->football_model->getDetailMember($idmember);

			$data['username'] = $this->session->userdata('username');
			$data['password'] = $this->session->userdata('password');
			$data['user'] = $this->session->userdata('stts');
			
			
			$tmp['content']=$this->load->view('member/profile',$data, TRUE);	
			$this->load->view('member/layout_home',$tmp);
	
			
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
		if(!empty($cek) && $stts=='member')
		{	

		$id_member = $this->session->userdata('username');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		

		if ($this->form_validation->run() == FALSE)
			{
				$idmember = $this->session->userdata('username');
					/*data layout */
					$data['title']="Edit Profile";
					$data['pointer']="profile";
					$data['classicon']="menu-icon fa fa-user";
					$data['main_bread']="Profile";
					$data['sub_bread']="Edit Profile";
					$data['desc']="Edit your basic profile";
					$data['data_member']=$this->football_model->getDetailMember($id_member);

					/*spesifik halaman */
					$data['error']='';
					$data['name_member']=$this->football_model->get_id($id_member);
					$tmp['content']=$this->load->view('member/edit_profile',$data, TRUE);	
					$this->load->view('member/layout_home',$tmp);
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
									

									$data['data_member']=$this->football_model->getDetailMember($id_member);
									$data['error']=$this->upload->display_errors();
									$data['name_member'] = $this->football_model->get_id($id_member);
									$tmp['content']=$this->load->view('member/edit_profile',$data, TRUE);	
									$this->load->view('member/layout_home',$tmp);
									
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
									'email'			=> $this->input->post('email'),
								);

								
								/*ubah password untuk keperluan login */
								$updatelog["password"] = md5($this->input->post("password"));
								$where = array('username'=>$id_member);

									$this->football_model->updateDataMultiField("tb_login",$updatelog,$where);
								/*update tabel member */
									$this->db->where('id_member',$id_member);
     								$query = $this->db->get('tb_member');
     								$row = $query->row();

     								if(!empty($row)){
     								unlink("./uploads/$row->img");
     								}
     								
									$this->football_model->update_member($data,$id_member);
									redirect('member/profile');
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
							'email'			=> $this->input->post('email'),
						);
						/*ubah password untuk keperluan login */
								$updatelog["password"] = md5($this->input->post("password"));
								$where = array('username'=>$id_member);

								$this->football_model->updateDataMultiField("tb_login",$updatelog,$where);
								$this->football_model->update_member($data,$id_member);
						redirect('member/profile');
					}

			}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function pemesanan_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='member')
		{	
			$idmember = $this->session->userdata('username');
			
			$data['title']="Member Pemesanan";
			$data['pointer']="pemesanan_jadwal";
			$data['classicon']="ace-icon fa fa-home home-icon";
			$data['main_bread']="Pemesanan";
			$data['sub_bread']="Pesan";
			$data['desc']="Jadwal Pertandingan";
			$data['data_member']=$this->football_model->getDetailMember($idmember);
			$data['data_topup']=$this->football_model->get_detailtopup($idmember);
			$data['data_jadwal']=$this->football_model->getAllData('tb_jadwal');
			$data['data_tim']=$this->football_model->getAllData('tb_tim');

			/*pagination*/
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
			$tot_hal = $this->football_model->get_jadwal();
			$config['base_url'] = base_url() . 'member/pemesanan_jadwal';
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
			
			/*spesific in this page */

			$tmp['content']=$this->load->view('member/pemesanan_jadwal',$data, TRUE);
			
			$this->load->view('member/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function pemesanan()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='member')
		{	
			$idmember = $this->session->userdata('username');
			$idjadwal=$this->uri->segment(3);
			/*data layout */
			$data['title']="Member Pemesanan";
			$data['error']="";
			$data['pointer']="pemesanan_jadwal";
			$data['classicon']="ace-icon fa fa-home home-icon";
			$data['main_bread']="Pemesanan";
			$data['sub_bread']="Pesan";
			$data['desc']="Jadwal Pertandingan";
			$data['data_member']=$this->football_model->getDetailMember($idmember);
			$data['data_topup']=$this->football_model->get_detailtopup($idmember);
			$data['data_jadwal']=$this->football_model->getDetailjadwal($idjadwal);
			$data['data_kelas']=$this->football_model->getAllData('tb_kelas');
			$data['data_jd_kelas']=$this->football_model->getDetailklsjadwal($idjadwal);
			$data['data_tim']=$this->football_model->getAllData('tb_tim');
			$data['data_kelasjadwal']=$this->football_model->getDetailklsjadwal($idjadwal);

			
			$tmp['content']=$this->load->view('member/pemesanan',$data, TRUE);	
			$this->load->view('member/layout_home',$tmp);
			
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	public function simpan_pemesanan()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='member')
		{	

			$id_member = $this->session->userdata('username');
			$id_jadwal=$this->uri->segment(3);

			$kelas = $this->input->post('kelas');
			$harga= $this->input->post('harga_satuan');
			$jumlah= $this->input->post('jumlah');
			$detail = array();
			$jml_stock=array();

			$row_count = count($kelas);


			for ($i=0; $i < $row_count; $i++) { 
    		$jml_stock[]=array(
    			'jumlah' => $jumlah[$kelas[$i]],
    			'stock_akhir' => $this->football_model->stock_akhir($kelas[$i],$id_jadwal)->stock_akhir,
    			);
    		}


    		foreach ($jml_stock as $stock) {
    			if($stock['jumlah']>$stock['stock_akhir']){
    			$this->session->set_flashdata('error','Tiket Sold Out atau Pemesanan lebih dari Stock Tiket');
				header('location:'.base_url().'member/pemesanan/'.$id_jadwal.'');
				
    			}
    		}

    		foreach ($jml_stock as $stock) {
    			if($stock['jumlah']>10){
    			$this->session->set_flashdata('error','Maksimal Pembelian Tiket adalah 10 per Kelas');
				header('location:'.base_url().'member/pemesanan/'.$id_jadwal.'');
				
    			}
    		}



			$data= array (
							'id_member'			=> $id_member,
							'id_jadwal'		=> $id_jadwal,
						);

			$this->football_model->insertData('tb_pemesanan',$data);
			$id = $this->db->insert_id();

		

			for ($i=0; $i < $row_count; $i++) { 
    		$detail[] = array(
        		'id_pemesanan' => $id,
    		    'id_kelas' => $kelas[$i],
       			'jumlah' => $jumlah[$kelas[$i]],
      			'harga_satuan' => $harga[$i],
      			'total_harga' => $jumlah[$kelas[$i]]*$harga[$i],
    		);
    		}

    		foreach ($detail as $detail) {
					$this->football_model->insertData('tb_detail_pesan',$detail);
				}

			$saldo= $this->football_model->get_saldo($id_member)->saldo;
			$grand= $this->football_model->get_total($id);

			if($grand > $saldo){
				$data['error']='Maaf Saldo Tidak Cukup, Silahkan lakukan TopUp terlebih dahulu';
				$data['title']="Member Pemesanan";
				$data['pointer']="pemesanan_jadwal";
				$data['classicon']="ace-icon fa fa-home home-icon";
				$data['main_bread']="Pemesanan";
				$data['sub_bread']="Pesan";
				$data['desc']="Jadwal Pertandingan";
				$data['data_member']=$this->football_model->getDetailMember($id_member);
				$data['data_topup']=$this->football_model->get_detailtopup($id_member);
				$data['data_jadwal']=$this->football_model->getDetailjadwal($id_jadwal);
				$data['data_kelas']=$this->football_model->getAllData('tb_kelas');
				$data['data_jd_kelas']=$this->football_model->getDetailklsjadwal($id_jadwal);
				$data['data_tim']=$this->football_model->getAllData('tb_tim');
				$data['data_kelasjadwal']=$this->football_model->getDetailklsjadwal($id_jadwal);

				//hapus pemesanan
				$saldo= $this->football_model->delete_pemesanan($id);
			
				$tmp['content']=$this->load->view('member/pemesanan',$data, TRUE);	
				$this->load->view('member/layout_home',$tmp);
			}else{

			//update saldo member

				$update_saldo= array (
							'saldo' => $saldo-$grand,
						);

				$this->football_model->update_member($update_saldo, $id_member);


				$data= array (
						'grand_total'		=>$grand,
						);

			$this->football_model->update_pemesanan($data,$id);
			$kelas_jadwal=$this->football_model->getDetailklsjadwal($id_jadwal)->result_array();

			foreach ($kelas_jadwal as $kls) {

				$kls['stock_akhir'] = $kls['stock_akhir'] - $jumlah[$kls['id_kelas']];
				$kls['terjual'] = $kls['terjual'] + $jumlah[$kls['id_kelas']];

				$this->football_model->update_jadwal_kls($kls, $id_jadwal, $kls['id_kelas']);

				
			}

			//header('location:'.base_url().'member/pemesanan_jadwal');

			header('location:'.base_url().'member/invoice/'.$id.'');	
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
		if(!empty($cek) && $stts=='member')
		{	
			$id = $this->uri->segment(3);
			$id_member = $this->session->userdata('username');
				$data['title']="Invoice/ Nota";
				$data['pointer']="pemesanan_jadwal";
				$data['classicon']="fa fa-dollar";
				$data['main_bread']="Pemesanan";
				$data['sub_bread']="View Invoice / Nota";
				$data['desc']="Invoice Pemesanan";
				$data['data_member']=$this->football_model->getDetailMember($id_member);
	
				$jadwal=$this->football_model->get_obj_jadwal($id)->id_jadwal;


				$data['data_jadwal']=$this->football_model->getDetailjadwal($jadwal);
				$data['data_tim']=$this->football_model->getAllData("tb_tim");
				$data['data_kelas']=$this->football_model->getAllData("tb_kelas");
				$data['data_pemesanan']=$this->football_model->get_pemesanan($id);
				$data['detail_pesan']=$this->football_model->get_det_pemesanan($id);

				$tmp['content']=$this->load->view('member/bg_invoice',$data, TRUE);	
				$this->load->view('member/layout_home',$tmp);
		}
		else
		{
		
			header('location:'.base_url().'web/log');
		}
	}
	

}
	


/* End of file member.php */
/* Location: ./application/controllers/member.php */