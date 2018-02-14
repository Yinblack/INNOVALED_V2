<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
  			$this->load->model('Persona_m');
	}

	public function Login(){
		$user = $this->security->xss_clean(strip_tags($this->input->post('User')));
		$pass = $this->security->xss_clean(strip_tags($this->input->post('Pass')));
		$result = $this->Persona_m->login($user, $pass);
		$this->CheckSession();
	}

	public function LogOut(){
		$this->session->sess_destroy();
		redirect(base_url('Home'));
	}
	public function CheckSession(){
        if ($this->session->userdata('Logged')===true) {
            $msg='success';
        }else{
        	$msg='error';
        }
        print_r($msg);
	}

	public function updateProfile(){
		if (isset($_POST['Nombre'])) { $Nombre=$_POST['Nombre']; }else{ $Nombre=''; }
		if (isset($_POST['Usuario'])) { $Usuario=$_POST['Usuario']; }else{ $Usuario=''; }
		if (isset($_POST['password1'])) { $password=$_POST['password1']; }else{ $password=''; }
		if (isset($_POST['IdUsuario'])) { $IdUsuario=$_POST['IdUsuario']; }else{ $IdUsuario=''; }
		$dataProfile = array(
			'Nombre'  => $Nombre,
			'Usuario' => $Usuario
		);
		if ($password!='') {
			$pass=$this->hashPass($password);
			$dataProfile['password']=$pass;
		}
		if ($this->Persona_m->updateProfile($dataProfile, $IdUsuario)) {
			echo "success";
			return true;
		}else{
			echo "error";
			return false;
		}
	}

	public function hashPass($pass){
		$opciones = [
		    'cost' => 12,
		];
		$newPass = password_hash($pass, PASSWORD_BCRYPT, $opciones);
		return $newPass;
	}

	public function addUsuario(){

		if (isset($_POST['Nombre'])) { $Nombre=$_POST['Nombre']; }else{ $Nombre=''; }
		if (isset($_POST['ApePaterno'])) { $ApePaterno=$_POST['ApePaterno']; }else{ $ApePaterno=''; }
		if (isset($_POST['ApeMaterno'])) { $ApeMaterno=$_POST['ApeMaterno']; }else{ $ApeMaterno=''; }
		if (isset($_POST['Telefono'])) { $Telefono=$_POST['Telefono']; }else{ $Telefono=''; }
		if (isset($_POST['Celular'])) { $Celular=$_POST['Celular']; }else{ $Celular=''; }
		if (isset($_POST['TelefonoRec'])) { $TelefonoRec=$_POST['TelefonoRec']; }else{ $TelefonoRec=''; }
		if (isset($_POST['Email'])) { $Email=$_POST['Email']; }else{ $Email=''; }
		if (isset($_POST['Web'])) { $Web=$_POST['Web']; }else{ $Web=''; }
		if (isset($_POST['Direccion'])) { $Direccion=$_POST['Direccion']; }else{ $Direccion=''; }
		if (isset($_POST['Colonia'])) { $Colonia=$_POST['Colonia']; }else{ $Colonia=''; }
		if (isset($_POST['Estado'])) { $Estado=$_POST['Estado']; }else{ $Estado=''; }
		if (isset($_POST['Municipio'])) { $Municipio=$_POST['Municipio']; }else{ $Municipio=''; }
		if (isset($_POST['Cp'])) { $Cp=$_POST['Cp']; }else{ $Cp=''; }
		if (isset($_POST['Usuario'])) { $Usuario=$_POST['Usuario']; }else{ $Usuario=''; }
		if (isset($_POST['Contrasena'])) { $Contrasena=$_POST['Contrasena']; }else{ $Contrasena=''; }
		if (isset($_POST['TipoUser'])) { $TipoUser=$_POST['TipoUser']; }else{ $TipoUser='Cliente'; }
		
		if (isset($_POST['IdGoogle'])) {
				if (isset($_POST['ImageGoogle'])) { $ImageGoogle=$_POST['ImageGoogle']; }else{ $ImageGoogle=''; }
				$dataNombre = array(
					'Nombres'    => $Nombre,
					'ApePaterno' => $ApePaterno,
					'ApeMaterno' => $ApeMaterno
				);
				$IdNombre=$this->Persona_m->addNombre($dataNombre);
				if ($IdNombre) {
					$success1=true;
				}

				$dataContacto = array(
					'Direccion'   => $Direccion,
					'Colonia'     => $Colonia,
					'Municipio'   => $Municipio,
					'Estado'      => $Estado,
					'Cp'          => $Cp,
					'Telefono'    => $Telefono,
					'Celular'     => $Celular,
					'TelefonoRec' => $TelefonoRec,
					'Email'       => $Email,
					'EmailGoogle' => $Email,
					'IdGoogle'    => $_POST['IdGoogle'],
					'Web'         => $Web
				);
				$IdContacto=$this->Persona_m->addContacto($dataContacto);
				if ($IdContacto) {
					$success2=true;
				}

				$dataPersona = array(
					'IdNombre'   => $IdNombre,
					'IdContacto'     => $IdContacto
				);
				$IdPersona=$this->Persona_m->addPersona($dataPersona);
				if ($IdPersona) {
					$success3=true;
				}

				$dataUsuario = array(
					'IdPersona'   => $IdPersona,
					'Usuario'     => $Usuario,
					'Contrasena'   => '',
					'Nivel'      => $TipoUser
				);
				$IdUsuario=$this->Persona_m->addUsuario($dataUsuario);
				if ($IdUsuario) {
					$success4=true;
				}

				$file = 'profile_pic.jpg';
				$filesm = 'sm_profile_pic.jpg';
				$dir="assets/img/Users/".$IdPersona."/";
				if (!file_exists($dir)) {
					mkdir($dir, 0777);
				}
				copy($ImageGoogle, $dir.$file);
				copy($ImageGoogle, $dir.$filesm);
				
				if ($success1==true && $success2==true && $success3==true && $success4==true) {
        		    $is_logged_in = $this->session->userdata('Logged');
        		    if(isset($is_logged_in) || $is_logged_in===true)
        		    {
						$this->addUsuarioLog($IdUsuario,'Create');
        		    }
					echo "success";
				}else{
					echo "error";
				}

		}else{

			if ($IdNombre=$this->Persona_m->checkEmail($Email)) {
				$opciones = [
				    'cost' => 12,
				];
				$passHash = password_hash($Contrasena, PASSWORD_BCRYPT, $opciones);

				$success1=false;
				$success2=false;
				$success3=false;
				$success4=false;
				$success5=false;

				$dataNombre = array(
					'Nombres'    => $Nombre,
					'ApePaterno' => $ApePaterno,
					'ApeMaterno' => $ApeMaterno
				);
				$IdNombre=$this->Persona_m->addNombre($dataNombre);
				if ($IdNombre) {
					$success1=true;
				}

				$dataContacto = array(
					'Direccion'   => $Direccion,
					'Colonia'     => $Colonia,
					'Municipio'   => $Municipio,
					'Estado'      => $Estado,
					'Cp'          => $Cp,
					'Telefono'    => $Telefono,
					'Celular'     => $Celular,
					'TelefonoRec' => $TelefonoRec,
					'Email'       => $Email,
					'Web'         => $Web
				);
				$IdContacto=$this->Persona_m->addContacto($dataContacto);
				if ($IdContacto) {
					$success2=true;
				}

				$dataPersona = array(
					'IdNombre'   => $IdNombre,
					'IdContacto'     => $IdContacto
				);
				$IdPersona=$this->Persona_m->addPersona($dataPersona);
				if ($IdPersona) {
					$success3=true;
				}
				$dataUsuario = array(
					'IdPersona'   => $IdPersona,
					'Usuario'     => $Usuario,
					'Contrasena'   => $passHash,
					'Nivel'      => $TipoUser
				);
				$IdUsuario=$this->Persona_m->addUsuario($dataUsuario);
				if ($IdUsuario) {
					$success4=true;
				}

				//Imagen
				$dir="assets/img/Users/".$IdPersona."/";
				if (!file_exists($dir)) {
					mkdir($dir, 0777);
				}
				if ($_FILES['profileImage']['tmp_name']) {
					$file = 'profile_pic.jpg';
					if (move_uploaded_file( $_FILES['profileImage']['tmp_name'], $dir.$file)) {
						$this->CreateThumbnail($dir,$file);
						$success5=true;
					}else{
						echo "Error al subir imagen de perfil";
					}
				}else{
					$success5=true;
				}

				if ($success1==true && $success2==true && $success3==true && $success4==true && $success5==true) {
        		    $is_logged_in = $this->session->userdata('Logged');
        		    if(isset($is_logged_in) || $is_logged_in===true)
        		    {
						$this->addUsuarioLog($IdUsuario,'Create');
        		    }
					echo "success";
				}else{
					echo "error";
				}

			}else{
				echo "emailOcupado";
			}
		}
	}

	function CreateThumbnail($dir, $file){
		$resourceImage=$dir.$file;
	    $info=getimagesize($resourceImage);
	    $width=$info[0];
	    $height=$info[1];
	
	    $url_arr = explode ('/', $resourceImage);
	    $ct = count($url_arr);
	    $name = 'sm_'.$url_arr[$ct-1];
	    $dir=getcwd()."/".$dir.$name;
	
		if ($width>300) {
			$cosiente=$width/300;
			$newWidth=$width/$cosiente;
			$newHeight=$height/$cosiente;
		}else{
			$newWidth=$width;
			$newHeight=$height;
		}
	
	    if ($info['mime']=='image/png') {
	        $src = imagecreatefrompng($resourceImage);
	        $thumb=imagecreatetruecolor($newWidth, $newHeight);
	        imagecopyresampled($thumb, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	        return imagepng($thumb, $dir);
	    }elseif ($info['mime']=='image/jpeg') {
	        $src = imagecreatefromjpeg($resourceImage);
	        $thumb=imagecreatetruecolor($newWidth, $newHeight);
	        imagecopyresampled($thumb, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	        return imagejpeg($thumb, $dir);
	    }else{
	        return false;
	        echo "Formato no valido";
	    }
	}



	public function updateContacto(){
		if (isset($_POST['IdContacto'])) { $IdContacto=$_POST['IdContacto']; }else{ $IdContacto=''; }
		if (isset($_POST['Telefono'])) { $Telefono=$_POST['Telefono']; }else{ $Telefono=''; }
		if (isset($_POST['Email'])) { $Email=$_POST['Email']; }else{ $Email=''; }
		$dataContacto = array(
			'Telefono'  => $Telefono,
			'Email'     => $Email
		);
		if ($this->Persona_m->updateContacto($dataContacto, $IdContacto)) {
			echo "success";
			return true;
		}else{
			echo "error";
			return false;
		}
	}

	public function updateUserName(){
		if (isset($_POST['IdUsuario'])) { $IdUsuario=$_POST['IdUsuario']; }else{ $IdUsuario=''; }
		if (isset($_POST['Usuario'])) { $Usuario=$_POST['Usuario']; }else{ $Usuario=''; }
		$dataUsuario = array(
			'Usuario'     => $Usuario
		);
		if ($this->Persona_m->updateUsuario($dataUsuario, $IdUsuario)) {
			echo "success";
			return true;
		}else{
			echo "error";
			return false;
		}
	}

	public function deleteUsuario(){
		$idUsr=$_POST['idUsr'];
		$dataUsuario = array(
			'Estatus'        => 'Deleted'
		);
		if ($this->Persona_m->updateUsuario($dataUsuario, $idUsr)) {
			$this->addUsuarioLog($idUsr,'Delete');
			echo 'success';
		}else{
			echo "error";
		}
	}

	function addUsuarioLog($idUsr, $Tipo){
		$dataUsuarioLog = array(
			'IdUsuario'         => $this->session->userdata('IdUsuario'),
			'IdUsuarioAffected' => $idUsr,
			'Tipo'              => $Tipo
		);
		$this->Persona_m->addUsuarioLog($dataUsuarioLog);
	}


}
