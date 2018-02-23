<?php
class Persona_m extends CI_Model {
	function __construct() {
 		parent::__construct();
 	}

    function login($user, $pass){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('Usuario', $user);
        $consultaUser = $this->db->get();
        if ($consultaUser->num_rows()>0){
            $this->ifPass($consultaUser, $pass);
        }
    }

    function ifPass($query, $pass){
        foreach ($query->result() as $row) {
            if (password_verify($pass, $row->Contrasena)===true) {
                $this->createSess($row->IdUsuario);
                break;
            }
        }
    }

    function createSess($IdUsuario){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('usuario.IdUsuario', $IdUsuario);
        $consulta = $this->db->get();
        if ($consulta->num_rows()>0){
            foreach ($consulta->result() as $row){
                $data = array(
                    'IdUsuario' => $row->IdUsuario,
                    'Nombre'    => $row->Nombre,
                    'Usuario'   => $row->Usuario,
                    'Nivel'     => $row->Nivel,
                    'Logged'    =>true
                );
            }
            $this->session->set_userdata($data);
        }
    }

    public function updateProfile($dataProfile, $IdUsuario){
        if ($this->db->update('usuario', $dataProfile, "IdUsuario = ".$IdUsuario)) {
            return true;
        }else{
            return false;
        }
    }

    public function checkEmail($Email){
        $this->db->select('Email');
        $this->db->from('Contacto');
        $this->db->where('Email', $Email);
        $items = $this->db->get();
        if ($items->num_rows()>0){
            return false;
        }else{
            return true;
        }
    }

    function isLogged(){
            $is_logged_in = $this->session->userdata('Logged');
            if(!isset($is_logged_in) || $is_logged_in!==true)
            {
                return false;
            }else{
                return true;
            }
    }

    function isDuw(){
        if($this->session->userdata('Nivel')=='Duw Goruchaf')
        {
            return true;
        }else{
            return false;
        }
    }

    function isSuperAdministrador(){
        if($this->session->userdata('Nivel')=='SuperAdministrador')
        {
            return true;
        }else{
            return false;
        }
    }

    function isAdministrador(){
        if($this->session->userdata('Nivel')=='Administrador')
        {
            return true;
        }else{
            return false;
        }
    }

    function isCliente(){
        if($this->session->userdata('Nivel')=='Cliente')
        {
            return true;
        }else{
            return false;
        }
    }

    public function addNombre($dataNombre){
        if ($this->db->insert('Nombre', $dataNombre)) {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
            return false;
        }
    }
    public function addContacto($dataContacto){
        if ($this->db->insert('Contacto', $dataContacto)) {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
            return false;
        }
    }
    public function addPersona($dataPersona){
        if ($this->db->insert('Persona', $dataPersona)) {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
            return false;
        }
    }
    public function addUsuario($dataUsuario){
        if ($this->db->insert('Usuario', $dataUsuario)) {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
            return false;
        }
    }


    public function updateNombre($dataNombre, $IdNombre){
        if ($this->db->update('Nombre', $dataNombre, "IdNombre = ".$IdNombre)) {
            return true;
        }else{
            return false;
        }
    }

    public function updateContacto($dataContacto, $IdContacto){
        if ($this->db->update('Contacto', $dataContacto, "IdContacto = ".$IdContacto)) {
            return true;
        }else{
            return false;
        }
    }

    public function updatePersona($dataPersona, $IdPersona){
        if ($this->db->update('Persona', $dataPersona, "IdPersona = ".$IdPersona)) {
            return true;
        }else{
            return false;
        }
    }

    public function updateUsuario($dataUsuario, $IdUsuario){
        if ($this->db->update('Usuario', $dataUsuario, "IdUsuario = ".$IdUsuario)) {
            return true;
        }else{
            return false;
        }
    }

    public function getUsuarios(){
        $this->db->select('Usuario.IdUsuario as IdUsuario, Nombre.Nombres as Nombres, Nombre.ApePaterno as ApePaterno, Nombre.ApeMaterno as ApeMaterno, Usuario.Usuario as Usuario, Usuario.Nivel as Nivel, Persona.IdPersona as IdPersona');
        $this->db->from('Usuario');
        $this->db->join('Persona', 'Usuario.IdPersona = Persona.IdPersona');
        $this->db->join('Contacto', 'Persona.IdContacto = Contacto.IdContacto');
        $this->db->join('Nombre', 'Persona.IdNombre = Nombre.IdNombre');
        $this->db->group_by("Usuario.IdUsuario");
        $this->db->where('Usuario.Estatus', 'Normal');
        $this->db->where('Usuario.Nivel !=', 'Duw Goruchaf');
        $this->db->where('Usuario.IdUsuario !=', $this->session->userdata('IdUsuario'));
        if ($this->isAdministrador()) {
            $this->db->where('Usuario.Nivel !=', 'SuperAdministrador');
        }
        $this->db->order_by('IdUsuario', 'ASC');
        $items = $this->db->get();
        if ($items->num_rows()>0){
            return $items;
        }else{
            return false;
        }
    }

    public function getUsuario($idUsr){
        $this->db->select('*');
        $this->db->from('Usuario');
        $this->db->join('Persona', 'Usuario.IdPersona = Persona.IdPersona');
        $this->db->join('Contacto', 'Persona.IdContacto = Contacto.IdContacto');
        $this->db->join('Nombre', 'Persona.IdNombre = Nombre.IdNombre');
        $this->db->group_by("Usuario.IdUsuario");
        $this->db->where('Usuario.IdUsuario', $idUsr);
        $items = $this->db->get();
        if ($items->num_rows()>0){
            $array=$items->unbuffered_row('array');
            return $array;
        }else{
            return false;
        }
    }

    public function getUsuarioInSession(){
        $this->db->select('*');
        $this->db->from('Usuario');
        $this->db->join('Persona', 'Usuario.IdPersona = Persona.IdPersona');
        $this->db->join('Contacto', 'Persona.IdContacto = Contacto.IdContacto');
        $this->db->join('Nombre', 'Persona.IdNombre = Nombre.IdNombre');
        $this->db->group_by("Usuario.IdUsuario");
        $this->db->where('Usuario.IdUsuario', $this->session->userdata('IdUsuario'));
        $items = $this->db->get();
        if ($items->num_rows()>0){
            $array=$items->unbuffered_row('array');
            return $array;
        }else{
            return false;
        }
    }

    public function getLogUserInSession(){
        $this->db->select('Nombre.Nombres as Nombre, Nombre.ApePaterno as ApePaterno, Nombre.ApeMaterno as ApeMaterno, Usuario.Nivel as Nivel, UsuarioLog.Tipo as Accion, UsuarioLog.TimeUpload as TimeUpload, Persona.IdPersona as IdPersona');
        $this->db->from('UsuarioLog');
        $this->db->join('Usuario', 'UsuarioLog.IdUsuarioAffected = Usuario.IdUsuario');
        $this->db->join('Persona', 'Usuario.IdPersona = Persona.IdPersona');
        $this->db->join('Contacto', 'Persona.IdContacto = Contacto.IdContacto');
        $this->db->join('Nombre', 'Persona.IdNombre = Nombre.IdNombre');
        $this->db->group_by("UsuarioLog.IdUsuarioLog");
        $this->db->where('UsuarioLog.IdUsuario', $this->session->userdata('IdUsuario'));
        $this->db->order_by('TimeUpload', 'DESC');
        $this->db->limit(5);
        $items = $this->db->get();
        if ($items->num_rows()>0){
            return $items;
        }else{
            return false;
        }
    }

    public function getLogEventosInSession(){
        $this->db->select('Evento.Titulo as Titulo, Evento.Lugar as Lugar, EventoLog.TimeUpload as TimeUpload, EventoLog.Tipo as Accion');
        $this->db->from('EventoLog');
        $this->db->join('Evento', 'EventoLog.IdEvento = Evento.IdEvento');
        $this->db->group_by("EventoLog.IdEventoLog");
        $this->db->where('EventoLog.IdUsuario', $this->session->userdata('IdUsuario'));
        $this->db->order_by('TimeUpload', 'DESC');
        $this->db->limit(5);
        $items = $this->db->get();
        if ($items->num_rows()>0){
            return $items;
        }else{
            return false;
        }
    }


    public function addUsuarioLog($dataUsuarioLog){
        if ($this->db->insert('UsuarioLog', $dataUsuarioLog)) {
            return  true;
        }else{
            return false;
        }
    }

}
?>
