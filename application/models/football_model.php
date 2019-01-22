<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Football_model extends CI_Model {
	 
	//query otomatis dengan active record
	//mengambil semua data
	public function getAllData($table)
	{
		return $this->db->get($table);
	}

	public function get_id($id_admin){
		$query =$this->db->where('id_admin', $id_admin)
						->limit(1)
						->get('tb_admin');
      	
		if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		}
	}

	public function get_saldo($id_member){
		$query =$this->db->where('id_member', $id_member)
						->limit(1)
						->get('tb_member');
      	if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		
		}
	}

	public function stock_akhir($id_kelas, $id_jadwal){
		$query =$this->db->where('id_kelas', $id_kelas)
						->where('id_jadwal', $id_jadwal)
						->limit(1)
						->get('tb_jadwal_kelas');
      	if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		
		}
	}

	public function get_detail_kelas($id_kelas){
		$query =$this->db->where('id_kelas', $id_kelas)
						->limit(1)
						->get('tb_kelas');
      	if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		
		}
	}


	public function get_obj_jadwal($id_pemesanan){
		$query =$this->db->where('id_pemesanan', $id_pemesanan)
						->limit(1)
						->get('tb_pemesanan');
      	if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		
		}
	}


	public function get_last_pesan($id_member){
		$query =$this->db->where('id_member', $id_member)
						->limit(1)
						->order_by('id_pemesanan desc')
						->get('tb_pemesanan');
      	if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		
		}
	}

	public function get_id_op($id_operator){
		$query =$this->db->where('id_operator', $id_operator)
						->limit(1)
						->get('tb_operator');
      	
		if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		}
	}


	public function update_admin($data, $id_admin){
		$this->db->where('id_admin',$id_admin);
      	return $this->db->update('tb_admin', $data);
	}

	public function update_member($data, $id_member){
		$this->db->where('id_member',$id_member);
      	return $this->db->update('tb_member', $data);
	}

	public function update_operator($data, $id_operator){
		$this->db->where('id_operator',$id_operator);
      	return $this->db->update('tb_operator', $data);
	}

	public function update_eksekutif($data, $id_eksekutif){
		$this->db->where('id_eksekutif',$id_eksekutif);
      	return $this->db->update('tb_eksekutif', $data);
	}

	public function update_tim($data, $id_tim){
		$this->db->where('id_tim',$id_tim);
      	return $this->db->update('tb_tim', $data);
	}

	public function update_kelas($data, $id_kelas){
		$this->db->where('id_kelas',$id_kelas);
      	return $this->db->update('tb_kelas', $data);
	}

	public function update_jadwal_kls($data, $id_jadwal,$id_kelas){
		$this->db->where('id_jadwal',$id_jadwal);
		$this->db->where('id_kelas', $id_kelas);
      	return $this->db->update('tb_jadwal_kelas', $data);
	}

	public function update_jadwal($data, $id_jadwal){
		$this->db->where('id_jadwal',$id_jadwal);
      	return $this->db->update('tb_jadwal', $data);
	}

	public function update_pemesanan($data, $id_pemesanan){
		$this->db->where('id_pemesanan',$id_pemesanan);
      	return $this->db->update('tb_pemesanan', $data);
	}
	
	//mengambil semua data dengan limit - pagination
	public function getAllDataLimited($table,$offset,$limit)
	{
		return $this->db->get($table,$limit,$offset);
	}

	//mengambil semua data dengan limit - pagination
	public function getjadwallimited($offset,$limit)
	{
		return $this->db->query("SELECT * FROM `tb_jadwal` WHERE `tanggal` > CURRENT_DATE order by tanggal ASC limit ".$limit." offset ".$offset."" );	
	}
	
	
	//menghapus data dalam tabel
	function deleteData($table,$data)
	{
		$this->db->delete($table, $data);
	}

	function delete_pemesanan($id){
	$this->db->where('id_pemesanan', $id);
	$this->db->delete('tb_pemesanan');
	}
	

	//mengupdate data
	function updateData($table,$data,$field,$key)
	{
		$this->db->where($key,$field);
		$this->db->update($table,$data);
	}
	
	function updateDataMultiField($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	
	//memasukan data - insert
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}

	// fungsi search ada top up
	function search($search)
		{
     		$data = array();
	 		$this->db->select('rpl');
			$this->db->from('tbl_member');
     		$this->db->order_by('id_member desc');
			$array = array('nama' => $search ,'saldo'=>$search);
			
			
     		$Q = $this->db->or_like($array)
						->get('');
			
     		
			if ($Q->num_rows() > 0)
				{
       				foreach ($Q->result_array() as $row)
						{
         					$data[] = $row;
       					}
    			}
				
    		$Q->free_result();  
    		return $data; 
 		}


	//query login
	public function getLoginData($usr,$psw)
	{
		// $u = mysql_escape_string($usr);
		// $p = md5(mysql_real_escape_string($psw));

		//khusus PHP deprecated
		$u = $usr;
		$p = md5($psw);
		$q_cek_login = $this->db->get_where('tb_login', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				if($qck->stts=='operator')
				{
					$q_ambil_data = $this->db->get_where('tb_operator', array('id_operator' => $u));
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['username'] = $qad->id_operator;
						$sess_data['nama'] = $qad->nama;
						$sess_data['password'] = $qad->password;
						$sess_data['alamat'] = $qad->alamat;
						$sess_data['no_hp'] = $qad->no_hp;
						$sess_data['stts'] = 'operator';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'operator');
				}
				else if($qck->stts=='admin')
				{
					$q_ambil_data = $this->db->get_where('tb_admin', array('id_admin' => $u));
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['username'] = $qad->id_admin;
						$sess_data['nama'] = $qad->nama;
						$sess_data['password'] = $qad->password;
						$sess_data['alamat'] = $qad->alamat;
						$sess_data['no_hp'] = $qad->no_hp;
						$sess_data['stts'] = 'admin';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'admin');
				}
				else if($qck->stts=='member')
				{
					$q_ambil_data = $this->db->get_where('tb_member', array('id_member' => $u));
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['username'] = $qad->id_member;
						$sess_data['nama'] = $qad->nama;
						$sess_data['password'] = $qad->password;
						$sess_data['alamat'] = $qad->alamat;
						$sess_data['no_hp'] = $qad->no_hp;
						$sess_data['email'] = $qad->email;
						$sess_data['saldo'] = $qad->saldo;
						$sess_data['stts'] = 'member';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'member');
				}
				else if($qck->stts=='eksekutif')
				{
					$q_ambil_data = $this->db->get_where('tb_eksekutif', array('id_eksekutif' => $u));
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['username'] = $qad->id_eksekutif;
						$sess_data['password'] = $qad->password;
						$sess_data['nama'] = $qad->nama;
						$sess_data['alamat'] = $qad->alamat;
						$sess_data['no_hp'] = $qad->no_hp;
						$sess_data['stts'] = 'eksekutif';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'eksekutif');
				}

			}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}
	

	function cekID($id_member) {
		$q = $this->db->query("select * from tb_member where id_member='".$id_member."'");
		$hasil = 0;
		if($q->num_rows()>0)
		{
			$hasil = 1;
		}
		return $hasil;
	}

	function cekoperator($id_operator) {
		$q = $this->db->query("select * from tb_operator where id_operator='".$id_operator."'");
		$hasil = 0;
		if($q->num_rows()>0)
		{
			$hasil = 1;
		}
		return $hasil;
	}

	function cekeksekutif($id_eksekutif) {
		$q = $this->db->query("select * from tb_eksekutif where id_eksekutif='".$id_eksekutif."'");
		$hasil = 0;
		if($q->num_rows()>0)
		{
			$hasil = 1;
		}
		return $hasil;
	}


	function cektim($kode_tim) {
		$q = $this->db->query("select * from tb_tim where kode_tim='".$kode_tim."'");
		$hasil = 0;
		if($q->num_rows()>0)
		{
			$hasil = 1;
		}
		return $hasil;
	}

	function cekkelas($nama_kelas) {
		$q = $this->db->query("select * from tb_kelas where nama_kelas='".$nama_kelas."'");
		$hasil = 0;
		if($q->num_rows()>0)
		{
			$hasil = 1;
		}
		return $hasil;
	}


	function get_detailtopup($idmember){
		return $this->db->query("SELECT * FROM tb_topup WHERE id_member = '".$idmember."'");
	}

	function get_detailtopup_limit($idmember){
		return $this->db->query("SELECT * FROM tb_topup WHERE id_member = '".$idmember."' order by id_topup DESC limit 1");
	}
	
	function getDetailMember($id_member) {
		return $this->db->query("SELECT * FROM tb_member where id_member='".$id_member."'");
	}

	//query untuk mengambil detail operator
	function getDetailOperator($id_operator) {
		return $this->db->query("SELECT * FROM tb_operator where id_operator='".$id_operator."'");
	}

	//query untuk mengambil detail eksekutif
	function getDetaileksekutif($id_eksekutif) {
		return $this->db->query("SELECT * FROM tb_eksekutif where id_eksekutif='".$id_eksekutif."'");
	}

	//query untuk mengambil detail tim
	function getDetailTim($id_tim) {
		return $this->db->query("SELECT * FROM tb_tim where id_tim='".$id_tim."'");
	}

	//query untuk mengambil detail kelas
	function getDetailkelas($id_kelas) {
		return $this->db->query("SELECT * FROM tb_kelas where id_kelas='".$id_kelas."'");
	}

	//query untuk mengambil detail jadwal
	function getDetailjadwal($id_jadwal) {
		return $this->db->query("SELECT * FROM tb_jadwal where id_jadwal='".$id_jadwal."'");
	}

	//query untuk mengambil detail jadwal kelas
	function getDetailklsjadwal($id_jadwal) {
		return $this->db->query("SELECT * FROM tb_jadwal_kelas where id_jadwal='".$id_jadwal."'");
	}

	function get_total($id_pemesanan){
		$this->db->select('SUM(total_harga) as total');
		$this->db->where('id_pemesanan', $id_pemesanan);
		$this->db->from('tb_detail_pesan');
		return $this->db->get()->row()->total;
		
	}

		//ngambil id top up terakhir
	function getIdLastTopUp($id) {
		return $this->db->query("SELECT * FROM tb_topup where id_topup='".$id."'");
	}

	function getIdLastNota($id) {
		return $this->db->query("SELECT * FROM tb_nota where id_topup='".$id."'");
	}

	function get_pemesanan($id) {
		return $this->db->query("SELECT * FROM tb_pemesanan where id_pemesanan='".$id."'");
	}

	function get_det_pemesanan($id_pemesanan) {
		return $this->db->query("SELECT * FROM tb_detail_pesan where id_pemesanan='".$id_pemesanan."'");
	}


	public function select_guestbook($num, $offset){
		$query = $this->db->get('guestbook', $num, $offset); //get semua yang ada di tabel guestbook (fungsi select)
		return $query->result(); 
	}

	public function select_status($status){
		$query =$this->db->where('status', $status)
						->order_by('datetime', 'desc')
						->get('guestbook');
		return $query->result(); 
	}

	public function change_status($id_guest, $status){
		$this->db->where('id_guest',$id_guest);
      	return $this->db->update('guestbook', $status);
	}

	public function insert_guestbook(){
		$data=array('name'=> $this->input->post('name'),
					'email' => $this->input->post('email'),
					'comment' =>$this->input->post('comment'));

		return $this->db->insert('guestbook', $data);
	}

 
	public function delete_guestbook($id_guest){
		$this->db->where('guestbook.id_guest', $id_guest);
		return $this->db->delete('guestbook');
	}

	public function get_jadwal(){
		
		return $this->db->query('SELECT * FROM `tb_jadwal` WHERE tanggal > CURRENT_DATE');
	}

	}

/* End of file football_model.php */
/* Location: ./application/models/football_model.php */