<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*

 사용자 인증 모델

*/
class Auth_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	//아이디 비빌번호 체크
	function login($auth)
	{
		$sql2 = "SELECT * from users where username= '" . $auth['username'] ."'";
		$query2 = $this->db->query($sql2);
		$result= $query2->row();
		$hash = $result->password;

		if(password_verify($auth['password'], $hash))
		{
			// 맞는 데이터가 있다면 해당 내용 반환
			return $result;
		}
		else
		{
			// 맞는 데이터가 없을 경우
			return FALSE;
		}
	}



}