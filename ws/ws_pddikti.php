<?php
class Ws_pddikti{
	protected $userfeeder;
	protected $passfeeder;
	protected $urlfeeder;

	function __construct($urlfeeder,$userfeeder,$passfeeder)
	{
		$this->url = $urlfeeder;
		$this->user = $userfeeder;
		$this->password = $passfeeder;
	}

	function prep_insert($act,$data)
	{
		return array(
			'act' => $act,
			'token' => $this->get_token(),
			'record' => $data
		);
	}

	function prep_update($act,$keys,$data)
	{
		return array(
			'act' => $act,
			'token' => $this->get_token(),
			'key' => $keys,
			'record' => $data
		);
	}

	
	function prep_dict($act,$keys)
	{
		return array(
			'act' => $act,
			'token' => $this->get_token(),
			'fungsi' => $keys
					);
	}

	function prep_delete($act,$keys)
	{
		return array(
			'act' => $act,
			'token' => $this->get_token(),
			'key' => $keys,
		);
	}

	function prep_get($act,$filter='',$limit=0,$offset=0)
	{
		return array(
			'act' => $act,
			'token' => $this->get_token(),
			'filter' => $filter,
			'limit' => $limit,
			'offset' => $offset,
		);
	}

	function get_token()
	{
		$data = array(
			'act' => 'GetToken',
			'username' => $this->user,
			'password' => $this->password,
			'id_smt' => "20202",
		);
		$res = $this->run($data);
		if($res[0])
		{
			if($res[1]['error_code'] == 0)
			{
				return $res[1]['data']['token'];
			}
			else
			{
				echo "Get token failed: ".$res[1]['error_desc'];die;
			}
		}
	}

	function get_token1($res)
	{
		$data = array(
			'act' => 'GetToken',
			'username' => $this->user,
			'password' => $this->password,
		);
		$res = $this->run($data);
		if($res[0])
		{
			if($res[1]['error_code'] == 0)
			{
				return $res[1]['data']['token'];
			}
			else
			{
				echo "Get token failed: ".$res[1]['error_desc'];die;
			}
		}
	}


	function view($data)
	{
		// echo "<pre class='code'>";
		// echo "<style>
		// 	.code{
		// 		font-family:'Courier New';
		// 		font-size:10px;
		// 	 color:blue;
		// 	}
		// </style>";
		print_r($data);
		// echo "</pre>\n";
	}

	function run($data=array())
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_POST,1);
		$headers[] = 'Content-Type: application/json';

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if($data)
		{
			$data = json_encode($data);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$result = curl_exec($ch);
		curl_close($ch);

		if($result)
		{
			$res = array(true,json_decode($result,true));
		}
		else
		{
			echo "CURL ERROR\n";
			die;
		}

		return $res;
	}
}
?>
