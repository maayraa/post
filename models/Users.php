<?php
require_once 'DbConnect.php';

class Users
{
    public $table = 'users';
    static public function findUser($item, $value)
    {
		if($item != null){
			$stmt = DbConnect::connect()->prepare(
				"SELECT * FROM users WHERE $item = :$item"
			);
			
			$stmt->bindParam(':'.$item, $value, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		}else{
				$stmt = DbConnect::connect()->prepare(
					'SELECT * FROM users'
				);
				$stmt->execute();
				return $stmt->fetchAll();
		}
       
		$stmt -> close();
		$stmt = null;
    }

    static public function addUser($datos)
	{
		$stmt = DbConnect::connect()->prepare(
			'INSERT INTO users (name, user, pass, profile, avatar, status, lt_login)
			VALUES (:name, :user, :password, :profile, :avatar, 1, "0000-00-00")'
		);
		$stmt->bindParam(':name', $datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(':user', $datos['usuario'], PDO::PARAM_STR);
		$stmt->bindParam(':password', $datos['password'], PDO::PARAM_STR);
		$stmt->bindParam(':profile', $datos['perfil'], PDO::PARAM_INT);
		$stmt->bindParam(':avatar', $datos['ruta'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return true;
		} else {
			print_r($stmt->errorInfo()); die();
			return false;
		}
		$stmt->close();
		$stmt = null;
	}
	/* Editar Usuario*/
	static public function editUser($datos)
	{
		$stmt = DbConnect::connect()->prepare(
			'UPDATE users SET name = :name, pass = :password, profile = :profile, avatar = :avatar WHERE user = :user'
		);
		$stmt->bindParam(':name', $datos['name'], PDO::PARAM_STR);
		$stmt->bindParam(':password', $datos['password'], PDO::PARAM_STR);
		$stmt->bindParam(':profile', $datos['profile'], PDO::PARAM_INT);
		$stmt->bindParam(':avatar', $datos['ruta'], PDO::PARAM_STR);
		$stmt->bindParam(':user', $datos['user'], PDO::PARAM_STR);
		
		if($stmt -> execute()){
			return true;
		}else{
			return false;
		}
		$stmt -> close();
		$stmt = null;
	}

	/** 
         * Actiualizar Usuario
        */
        static public function ActUser($item1, $value1, $item2, $value2)
        {
			$stmt = DbConnect::connect()->prepare("UPDATE users SET $item1 = :value WHERE $item2 = :id_user");
			
             $stmt->bindParam(':value', $value1, PDO::PARAM_STR);
             $stmt->bindParam(':id_user', $value2, PDO::PARAM_STR);
             if ($stmt->execute()) {
	    		return true;
	    	} else {
	    		print_r($stmt->errorInfo()); die();
	    		return false;
            }
             $stmt->close();
             $stmt = null;
        }
    }
