<?php

class MySQL 
{
	function __construct($host, $user, $passwd, $db)
	{
		$this->host = $host;
		$this->user = $user;
		$this->passwd = $passwd;
		$this->db = $db;
		$this->error = '';
	}

	function connect()
	{
		$this->connection = @mysqli_connect($this->host, $this->user, $this->passwd, $this->db);
	
		if (!$this->connection)
		{
			$this->error = mysqli_connect_error();
			return false;
		}
		return true;
	}

	function getError()
	{
		return $this->error;
	}

	function checkError()
	{

		if ($this->connection->error)
		{
			$this->error = $this->connection->error;	
			return false;
		}

	}

	function select($what, $where, $condition, $values)
	{

		$sql = "SELECT $what FROM $where";
		
		if ($condition)
		{
			$sql.= " WHERE $condition"; 
		}

		if ($stmt = $this->connection->prepare($sql))
		{
			$stmt->bind_param(str_repeat('s', count($values)), ...$values);
			$stmt->execute();
			$result = $stmt->get_result();
			$rows = $result->fetch_all(MYSQLI_ASSOC);

			$stmt->close();
			return $rows;
		}
		return $this->checkError();
	}

	function insert($table, $values)
	{

		
		$fields = array();
		$data = array();
		
		foreach ($values as $key => $value)
		{
			$fields[] = $key."=?";
			$data[] = $value;
		}

		$sql = "INSERT INTO $table SET ".implode(',',$fields);
		
		if ($stmt = $this->connection->prepare($sql))
		{
			$stmt->bind_param(str_repeat('s', count($values)), ...$data);
			$stmt->execute();
			$insertId = $stmt->insert_id;
			$stmt->close();
			
			return $insertId;
		}
		return $this->checkError();
		
	}

	function updateById($table, $values, $id)
	{
		
		$fields = array();
		$data = array();
		
		foreach ($values as $key => $value)
		{
			$fields[] = $key."=?";
			$data[] = $value;
		}

		$data[] = $id;

		$sql = "UPDATE $table SET ".implode(',',$fields)." WHERE id=?";
		
		if ($stmt = $this->connection->prepare($sql))
		{
			$stmt->bind_param(str_repeat('s', count($values)+1), ...$data);
			$stmt->execute();
			$stmt->close();
			
			return true;
		}
		return $this->checkError();
	}

	function deleteById($table, $id)
	{
		if ($stmt = $this->connection->prepare("DELETE FROM $table WHERE id=?"))
		{
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->close();
			
			return true;
		}
		$this->checkError();
	}

	function delete($table, $condition, $values)
	{
		
		$sql = "DELETE FROM $table";
		
		if ($condition)
		{
			$sql.= " WHERE $condition"; 
		}

		if ($stmt = $this->connection->prepare($sql))
		{
			$stmt->bind_param(str_repeat('s', count($values)), ...$values);
			$stmt->execute();
			$rows = $stmt->affected_rows;
			$stmt->close();
			return $rows;
		}
		return $this->checkError();

	}

	function close()
	{
		mysqli_close($this->connection);
	}
}


$sql = new MySQL('localhost', 'test', 'kathruieJFEksd', 'seiteDB');

if (!$sql->connect())
{
	echo 'Failed to connect: '.$sql->getError();
	exit(1);
}
//$sql->delete('messages','id=?',['54']);
/*print_r($sql->select('*', 'images'));
print_r($sql->insert('user', ['vorname' => 'fwekf'], '15'));
print_r($sql->updateById('user', ['vorname' => 'nikefg'], '15'));
print_r($sql->deleteById('user', '15'));
print_r($sql->getError());*/

//$sql->close();


?>
