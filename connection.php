<?php
  define('HOST', 'localhost');
  define('USERNAME', 'root');
  define('PASSWORD', '');
  define('DATABASE', 'market');

	/**
	 * update, insert, delete
	 */
  function execute($sql) {
		// create connection to database
		$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
		//(gửi câu lệnh đến máy chủ)
		mysqli_query($conn, $sql);
		//close connection
		mysqli_close($conn);
	}
	
	/**
	 * su dung cho lenh select => tra ve ket qua danh sach
	 */
	function executeResult($sql) {
		$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
		$result = mysqli_query($conn, $sql);
		$list      = [];
		while ($row = mysqli_fetch_array($result, 1)) {
			$list[] = $row;
		}
		mysqli_close($conn);
		return $list;
	}
	
	/**
	 * doi voi csdl ma ta chi lay ra 1 doi tuong duy nhat
	 */
	function executeSingleResult($sql) {
		$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
		$result = mysqli_query($conn, $sql);
		$object = mysqli_fetch_array($result, 1);
	
		mysqli_close($conn);
		return $object;
	}
	
	// Trả lại số hàng của bảng
	function executeTotalRowsResult($sql){
		$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
		$result = mysqli_query($conn, $sql);
		$totalRows = mysqli_num_rows($result);
	
		mysqli_close($conn);
		return $totalRows;
	}

	function identityFirst(){
		$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
		$identity = mysqli_insert_id($conn);
		
		mysqli_close($conn);
		return $identity;
	}

?>
