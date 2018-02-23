<?php
class WebPage_m extends CI_Model {
	function __construct() {
 		parent::__construct();
 	}


    public function addFormProductoFinal($dataServicio, $dataProducto, $level){
        if ($this->session->userdata('Idioma')=='Español') {
            if ($this->db->insert('ServicioLvl'.$level, $dataServicio)) {
                $insert_id = $this->db->insert_id();
                $dataProducto['IdServicioLvl'.$level]=$insert_id;
                if ($this->db->insert('ProductoLvl'.$level, $dataProducto)) {
                    return $insert_id;
                }
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            if ($this->db->insert('EngServicioLvl'.$level, $dataServicio)) {
                $insert_id = $this->db->insert_id();
                $dataProducto['IdServicioLvl'.$level]=$insert_id;
                if ($this->db->insert('EngProductoLvl'.$level, $dataProducto)) {
                    return $insert_id;
                }
            }else{
                return false;
            }
        }
    }

    public function addFormProductoCategoria($dataServicio, $level){
        if ($this->session->userdata('Idioma')=='Español') {
            if ($this->db->insert('ServicioLvl'.$level, $dataServicio)) {
                $insert_id = $this->db->insert_id();
                return  $insert_id;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            if ($this->db->insert('EngServicioLvl'.$level, $dataServicio)) {
                $insert_id = $this->db->insert_id();
                return  $insert_id;
            }else{
                return false;
            }
        }
    }

    public function getServSuperiores($level){
        if ($this->session->userdata('Idioma')=='Español') {
            $this->db->select('*');
            $this->db->from('ServicioLvl'.$level);
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('Titulo', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                return $items;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $this->db->select('*');
            $this->db->from('EngServicioLvl'.$level);
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('Titulo', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                return $items;
            }else{
                return false;
            }
        }
    }

    public function getMenu(){
        if ($this->session->userdata('Idioma')=='Español') {
            $this->db->select('*');
            $this->db->from('ServicioLvl1');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                $counter=0;
                foreach ($items->result() as $row) {
                    if ($row->EsProducto=='Si'){//level 1 es produdcto final
                        $this->db->select('*');
                        $this->db->where('IdServicioLvl1', $row->IdServicioLvl1);
                        $this->db->from('ServicioLvl1');
                        $this->db->join('ProductoLvl1', 'ServicioLvl1.IdServicioLvl1 = ProductoLvl1.IdServicioLvl1');
                        $this->db->group_by('ServicioLvl1.IdServicioLvl1');
                        $items2 = $this->db->get();
                        foreach ($items2->result() as $rxw) {
                            $arrayItems[$counter]['IdServicioLvl1']=$rxw->IdServicioLvl1;
                            $arrayItems[$counter]['Titulo']=$rxw->Titulo;
                            $arrayItems[$counter]['Texto']=$rxw->Texto;
                            $arrayItems[$counter]['Imagen']=$rxw->Imagen;
                            $arrayItems[$counter]['EsProducto']=$rxw->EsProducto;
                            $arrayItems[$counter]['Overview']=$rxw->Overview;
                            $arrayItems[$counter]['Ficha']=$rxw->Ficha;
                        }
                    }else{//level 1 es servicio
                        $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                        $arrayItems[$counter]['Titulo']=$row->Titulo;
                        $arrayItems[$counter]['Texto']=$row->Texto;
                        $arrayItems[$counter]['Imagen']=$row->Imagen;
                        $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                        $this->db->select('*');
                        $this->db->where('IdServicioLvl1', $row->IdServicioLvl1);
                        $this->db->from('ServicioLvl2');
                        $items2 = $this->db->get();
                        if ($items2->num_rows() > 0){
                            $counter2=0;
                            foreach ($items2->result() as $rxw) {
                                if ($rxw->EsProducto=='Si') {//level 2 es produdcto final
                                    $this->db->select('*');
                                    $this->db->where('IdServicioLvl1', $rxw->IdServicioLvl1);
                                    $this->db->from('ServicioLvl2');
                                    $this->db->join('ProductoLvl2', 'ServicioLvl2.IdServicioLvl2 = ProductoLvl2.IdServicioLvl2');
                                    $this->db->group_by('ServicioLvl2.IdServicioLvl2');
                                    $items3 = $this->db->get();
                                    foreach ($items3->result() as $rxw) {
                                        $arrayItems[$counter][$counter2]['IdServicioLvl2']=$rxw->IdServicioLvl2;
                                        $arrayItems[$counter][$counter2]['Titulo']=$rxw->Titulo;
                                        $arrayItems[$counter][$counter2]['Texto']=$rxw->Texto;
                                        $arrayItems[$counter][$counter2]['Imagen']=$rxw->Imagen;
                                        $arrayItems[$counter][$counter2]['EsProducto']=$rxw->EsProducto;
                                        $arrayItems[$counter][$counter2]['Overview']=$rxw->Overview;
                                        $arrayItems[$counter][$counter2]['Ficha']=$rxw->Ficha;
                                    }
                                }else{//level 2 es servicio
                                    $arrayItems[$counter][$counter2]['IdServicioLvl2']=$rxw->IdServicioLvl2;
                                    $arrayItems[$counter][$counter2]['Titulo']=$rxw->Titulo;
                                    $arrayItems[$counter][$counter2]['Texto']=$rxw->Texto;
                                    $arrayItems[$counter][$counter2]['Imagen']=$rxw->Imagen;
                                    $arrayItems[$counter][$counter2]['EsProducto']=$rxw->EsProducto;
                                    $this->db->select('*');
                                    $this->db->where('IdServicioLvl2', $rxw->IdServicioLvl2);
                                    $this->db->from('ServicioLvl3');
                                    $items4 = $this->db->get();
                                    if ($items4->num_rows() > 0){
                                        $counter3=0;
                                        foreach ($items4->result() as $rxy) {
                                            if ($rxy->EsProducto=='Si') {//level 3 es produdcto final
                                                $this->db->select('*');
                                                $this->db->where('IdServicioLvl2', $rxy->IdServicioLvl2);
                                                $this->db->from('ServicioLvl3');
                                                $this->db->join('ProductoLvl3', 'ServicioLvl3.IdServicioLvl3 = ProductoLvl3.IdServicioLvl3');
                                                $this->db->group_by('ServicioLvl3.IdServicioLvl3');
                                                $items3 = $this->db->get();
                                                foreach ($items3->result() as $rxy) {
                                                    $arrayItems[$counter][$counter2][$counter3]['IdServicioLvl3']=$rxy->IdServicioLvl3;
                                                    $arrayItems[$counter][$counter2][$counter3]['Titulo']=$rxy->Titulo;
                                                    $arrayItems[$counter][$counter2][$counter3]['Texto']=$rxy->Texto;
                                                    $arrayItems[$counter][$counter2][$counter3]['Imagen']=$rxy->Imagen;
                                                    $arrayItems[$counter][$counter2][$counter3]['EsProducto']=$rxy->EsProducto;
                                                    $arrayItems[$counter][$counter2][$counter3]['Overview']=$rxy->Overview;
                                                    $arrayItems[$counter][$counter2][$counter3]['Ficha']=$rxy->Ficha;
                                                }
                                            }else{//level 3 es servicio
                                                    $arrayItems[$counter][$counter2][$counter3]['IdServicioLvl3']=$rxy->IdServicioLvl3;
                                                    $arrayItems[$counter][$counter2][$counter3]['Titulo']=$rxy->Titulo;
                                                    $arrayItems[$counter][$counter2][$counter3]['Texto']=$rxy->Texto;
                                                    $arrayItems[$counter][$counter2][$counter3]['Imagen']=$rxy->Imagen;
                                                    $arrayItems[$counter][$counter2][$counter3]['EsProducto']=$rxy->EsProducto;    
                                                    $this->db->select('*');
                                                    $this->db->where('IdServicioLvl3', $rxy->IdServicioLvl3);
                                                    $this->db->from('ServicioLvl4');
                                                    $items4 = $this->db->get();
                                                    if ($items4->num_rows() > 0){
                                                        $counter4=0;
                                                        foreach ($items4->result() as $rxx) {
                                                            if ($rxx->EsProducto=='Si') {//level 4 es produdcto final
                                                                $this->db->select('*');
                                                                $this->db->where('IdServicioLvl3', $rxy->IdServicioLvl3);
                                                                $this->db->from('ServicioLvl4');
                                                                $this->db->join('ProductoLvl4', 'ServicioLvl4.IdServicioLvl4 = ProductoLvl4.IdServicioLvl4');
                                                                $this->db->group_by('ServicioLvl4.IdServicioLvl4');
                                                                $items3 = $this->db->get();
                                                                foreach ($items3->result() as $rxy) {
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['IdServicioLvl4']=$rxy->IdServicioLvl4;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Titulo']=$rxy->Titulo;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Texto']=$rxy->Texto;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Imagen']=$rxy->Imagen;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['EsProducto']=$rxy->EsProducto;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Overview']=$rxy->Overview;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Ficha']=$rxy->Ficha;
                                                                }
                                                            }else{
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['IdServicioLvl3']=$rxy->IdServicioLvl3;
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['Titulo']=$rxy->Titulo;
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['Texto']=$rxy->Texto;
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['Imagen']=$rxy->Imagen;
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['EsProducto']=$rxy->EsProducto;    
                                                            }
                                                        }
                                                        $counter4++;
                                                    }
                                            }
                                            $counter3++;
                                        }
                                    }
                                }
                                $counter2++;
                            }
                        }
                    }
                    $counter++;
                }
                return $arrayItems;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $this->db->select('*');
            $this->db->from('EngServicioLvl1');
            $items = $this->db->get();
            //$sql = $this->db->last_query();
            //print_r($sql->result());
            //die();
            if ($items->num_rows() > 0){
                $counter=0;
                foreach ($items->result() as $row) {
                    if ($row->EsProducto=='Si'){//level 1 es produdcto final
                        $this->db->select('*');
                        $this->db->where('IdServicioLvl1', $row->IdServicioLvl1);
                        $this->db->from('EngServicioLvl1');
                        $this->db->join('EngProductoLvl1', 'EngServicioLvl1.IdServicioLvl1 = EngProductoLvl1.IdServicioLvl1');
                        $this->db->group_by('EngServicioLvl1.IdServicioLvl1');
                        $items2 = $this->db->get();
                        foreach ($items2->result() as $rxw) {
                            $arrayItems[$counter]['IdServicioLvl1']=$rxw->IdServicioLvl1;
                            $arrayItems[$counter]['Titulo']=$rxw->Titulo;
                            $arrayItems[$counter]['Texto']=$rxw->Texto;
                            $arrayItems[$counter]['Imagen']=$rxw->Imagen;
                            $arrayItems[$counter]['EsProducto']=$rxw->EsProducto;
                            $arrayItems[$counter]['Overview']=$rxw->Overview;
                            $arrayItems[$counter]['Ficha']=$rxw->Ficha;
                        }
                    }else{//level 1 es servicio
                        $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                        $arrayItems[$counter]['Titulo']=$row->Titulo;
                        $arrayItems[$counter]['Texto']=$row->Texto;
                        $arrayItems[$counter]['Imagen']=$row->Imagen;
                        $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                        $this->db->select('*');
                        $this->db->where('IdServicioLvl1', $row->IdServicioLvl1);
                        $this->db->from('EngServicioLvl2');
                        $items2 = $this->db->get();
                        if ($items2->num_rows() > 0){
                            $counter2=0;
                            foreach ($items2->result() as $rxw) {
                                if ($rxw->EsProducto=='Si') {//level 2 es produdcto final
                                    $this->db->select('*');
                                    $this->db->where('IdServicioLvl1', $rxw->IdServicioLvl1);
                                    $this->db->from('EngServicioLvl2');
                                    $this->db->join('EngProductoLvl2', 'EngServicioLvl2.IdServicioLvl2 = EngProductoLvl2.IdServicioLvl2');
                                    $this->db->group_by('EngServicioLvl2.IdServicioLvl2');
                                    $items3 = $this->db->get();
                                    foreach ($items3->result() as $rxw) {
                                        $arrayItems[$counter][$counter2]['IdServicioLvl2']=$rxw->IdServicioLvl2;
                                        $arrayItems[$counter][$counter2]['Titulo']=$rxw->Titulo;
                                        $arrayItems[$counter][$counter2]['Texto']=$rxw->Texto;
                                        $arrayItems[$counter][$counter2]['Imagen']=$rxw->Imagen;
                                        $arrayItems[$counter][$counter2]['EsProducto']=$rxw->EsProducto;
                                        $arrayItems[$counter][$counter2]['Overview']=$rxw->Overview;
                                        $arrayItems[$counter][$counter2]['Ficha']=$rxw->Ficha;
                                    }
                                }else{//level 2 es servicio
                                    $arrayItems[$counter][$counter2]['IdServicioLvl2']=$rxw->IdServicioLvl2;
                                    $arrayItems[$counter][$counter2]['Titulo']=$rxw->Titulo;
                                    $arrayItems[$counter][$counter2]['Texto']=$rxw->Texto;
                                    $arrayItems[$counter][$counter2]['Imagen']=$rxw->Imagen;
                                    $arrayItems[$counter][$counter2]['EsProducto']=$rxw->EsProducto;
                                    $this->db->select('*');
                                    $this->db->where('IdServicioLvl2', $rxw->IdServicioLvl2);
                                    $this->db->from('EngServicioLvl3');
                                    $items4 = $this->db->get();
                                    if ($items4->num_rows() > 0){
                                        $counter3=0;
                                        foreach ($items4->result() as $rxy) {
                                            if ($rxy->EsProducto=='Si') {//level 3 es produdcto final
                                                $this->db->select('*');
                                                $this->db->where('IdServicioLvl2', $rxy->IdServicioLvl2);
                                                $this->db->from('EngServicioLvl3');
                                                $this->db->join('EngProductoLvl3', 'EngServicioLvl3.IdServicioLvl3 = EngProductoLvl3.IdServicioLvl3');
                                                $this->db->group_by('EngServicioLvl3.IdServicioLvl3');
                                                $items3 = $this->db->get();
                                                foreach ($items3->result() as $rxy) {
                                                    $arrayItems[$counter][$counter2][$counter3]['IdServicioLvl3']=$rxy->IdServicioLvl3;
                                                    $arrayItems[$counter][$counter2][$counter3]['Titulo']=$rxy->Titulo;
                                                    $arrayItems[$counter][$counter2][$counter3]['Texto']=$rxy->Texto;
                                                    $arrayItems[$counter][$counter2][$counter3]['Imagen']=$rxy->Imagen;
                                                    $arrayItems[$counter][$counter2][$counter3]['EsProducto']=$rxy->EsProducto;
                                                    $arrayItems[$counter][$counter2][$counter3]['Overview']=$rxy->Overview;
                                                    $arrayItems[$counter][$counter2][$counter3]['Ficha']=$rxy->Ficha;
                                                }
                                            }else{//level 3 es servicio
                                                    $arrayItems[$counter][$counter2][$counter3]['IdServicioLvl3']=$rxy->IdServicioLvl3;
                                                    $arrayItems[$counter][$counter2][$counter3]['Titulo']=$rxy->Titulo;
                                                    $arrayItems[$counter][$counter2][$counter3]['Texto']=$rxy->Texto;
                                                    $arrayItems[$counter][$counter2][$counter3]['Imagen']=$rxy->Imagen;
                                                    $arrayItems[$counter][$counter2][$counter3]['EsProducto']=$rxy->EsProducto;    
                                                    $this->db->select('*');
                                                    $this->db->where('IdServicioLvl3', $rxy->IdServicioLvl3);
                                                    $this->db->from('EngServicioLvl4');
                                                    $items4 = $this->db->get();
                                                    if ($items4->num_rows() > 0){
                                                        $counter4=0;
                                                        foreach ($items4->result() as $rxx) {
                                                            if ($rxx->EsProducto=='Si') {//level 4 es produdcto final
                                                                $this->db->select('*');
                                                                $this->db->where('IdServicioLvl3', $rxy->IdServicioLvl3);
                                                                $this->db->from('EngServicioLvl4');
                                                                $this->db->join('EngProductoLvl4', 'EngServicioLvl4.IdServicioLvl4 = EngProductoLvl4.IdServicioLvl4');
                                                                $this->db->group_by('EngServicioLvl4.IdServicioLvl4');
                                                                $items3 = $this->db->get();
                                                                foreach ($items3->result() as $rxy) {
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['IdServicioLvl4']=$rxy->IdServicioLvl4;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Titulo']=$rxy->Titulo;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Texto']=$rxy->Texto;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Imagen']=$rxy->Imagen;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['EsProducto']=$rxy->EsProducto;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Overview']=$rxy->Overview;
                                                                    $arrayItems[$counter][$counter2][$counter3][$counter4]['Ficha']=$rxy->Ficha;
                                                                }
                                                            }else{
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['IdServicioLvl3']=$rxy->IdServicioLvl3;
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['Titulo']=$rxy->Titulo;
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['Texto']=$rxy->Texto;
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['Imagen']=$rxy->Imagen;
                                                                $arrayItems[$counter][$counter2][$counter3][$counter4]['EsProducto']=$rxy->EsProducto;    
                                                            }
                                                        }
                                                        $counter4++;
                                                    }
                                            }
                                            $counter3++;
                                        }
                                    }
                                }
                                $counter2++;
                            }
                        }
                    }
                    $counter++;
                }
                return $arrayItems;
            }else{
                return false;
            }
        }


    }

    public function getServForList($level){
        if ($this->session->userdata('Idioma')=='Español') {
            $this->db->select('*');
            $this->db->from('ServicioLvl'.$level);
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                return $items;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $this->db->select('*');
            $this->db->from('EngServicioLvl'.$level);
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                return $items;
            }else{
                return false;
            }
        }
    }

    public function getServicioProductoByIdAndLevel($Nivel, $IdServicio, $EsProducto){
        if ($this->session->userdata('Idioma')=='Español') {
            if ($EsProducto=='Si') {
                $this->db->select('*');
                $this->db->from('ServicioLvl'.$Nivel);
                $this->db->where('ServicioLvl'.$Nivel.'.IdServicioLvl'.$Nivel, $IdServicio);
                $this->db->join('ProductoLvl'.$Nivel, 'ServicioLvl'.$Nivel.'.IdServicioLvl'.$Nivel.' = ProductoLvl'.$Nivel.'.IdServicioLvl'.$Nivel);
                $this->db->group_by('ServicioLvl'.$Nivel.'.IdServicioLvl'.$Nivel);
            }else{
                $this->db->select('*');
                $this->db->from('ServicioLvl'.$Nivel);
                $this->db->where('IdServicioLvl'.$Nivel, $IdServicio);
            }
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                return $items;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            if ($EsProducto=='Si') {
                $this->db->select('*');
                $this->db->from('EngServicioLvl'.$Nivel);
                $this->db->where('EngServicioLvl'.$Nivel.'.IdServicioLvl'.$Nivel, $IdServicio);
                $this->db->join('EngProductoLvl'.$Nivel, 'EngServicioLvl'.$Nivel.'.IdServicioLvl'.$Nivel.' = EngProductoLvl'.$Nivel.'.IdServicioLvl'.$Nivel);
                $this->db->group_by('EngServicioLvl'.$Nivel.'.IdServicioLvl'.$Nivel);
            }else{
                $this->db->select('*');
                $this->db->from('EngServicioLvl'.$Nivel);
                $this->db->where('IdServicioLvl'.$Nivel, $IdServicio);
            }
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                return $items;
            }else{
                return false;
            }
        }
    }


    public function getServiciosProductosLvl1(){
        if ($this->session->userdata('Idioma')=='Español') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('ServicioLvl1');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('ProductoLvl1', 'ServicioLvl1.IdServicioLvl1 = ProductoLvl1.IdServicioLvl1');
            $this->db->group_by('ServicioLvl1.IdServicioLvl1');
            $this->db->order_by('ServicioLvl1.IdServicioLvl1', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Level']=1;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('ServicioLvl1');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('ServicioLvl1.IdServicioLvl1', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Level']=1;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('EngServicioLvl1');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('EngProductoLvl1', 'EngServicioLvl1.IdServicioLvl1 = EngProductoLvl1.IdServicioLvl1');
            $this->db->group_by('EngServicioLvl1.IdServicioLvl1');
            $this->db->order_by('EngServicioLvl1.IdServicioLvl1', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Level']=1;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('EngServicioLvl1');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('EngServicioLvl1.IdServicioLvl1', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Level']=1;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }

    }


    public function getServiciosProductosLvl2(){
        if ($this->session->userdata('Idioma')=='Español') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('ServicioLvl2');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('ProductoLvl2', 'ServicioLvl2.IdServicioLvl2 = ProductoLvl2.IdServicioLvl2');
            $this->db->group_by('ServicioLvl2.IdServicioLvl2');
            $this->db->order_by('ServicioLvl2.IdServicioLvl2', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl2']=$row->IdServicioLvl2;
                    $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('ServicioLvl2');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('ServicioLvl2.IdServicioLvl2', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl2']=$row->IdServicioLvl2;
                    $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('EngServicioLvl2');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('EngProductoLvl2', 'EngServicioLvl2.IdServicioLvl2 = EngProductoLvl2.IdServicioLvl2');
            $this->db->group_by('EngServicioLvl2.IdServicioLvl2');
            $this->db->order_by('EngServicioLvl2.IdServicioLvl2', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl2']=$row->IdServicioLvl2;
                    $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('EngServicioLvl2');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('EngServicioLvl2.IdServicioLvl2', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl2']=$row->IdServicioLvl2;
                    $arrayItems[$counter]['IdServicioLvl1']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }

    }
    
    public function getServiciosProductosLvl3(){
        if ($this->session->userdata('Idioma')=='Español') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('ServicioLvl3');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('ProductoLvl3', 'ServicioLvl3.IdServicioLvl3 = ProductoLvl3.IdServicioLvl3');
            $this->db->group_by('ServicioLvl3.IdServicioLvl3');
            $this->db->order_by('ServicioLvl3.IdServicioLvl3', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl3']=$row->IdServicioLvl3;
                    $arrayItems[$counter]['IdServicioLvl2']=$row->IdServicioLvl2;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('ServicioLvl3');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('ServicioLvl3.IdServicioLvl3', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl3']=$row->IdServicioLvl3;
                    $arrayItems[$counter]['IdServicioLvl2']=$row->IdServicioLvl2;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('EngServicioLvl3');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('EngProductoLvl3', 'EngServicioLvl3.IdServicioLvl3 = EngProductoLvl3.IdServicioLvl3');
            $this->db->group_by('EngServicioLvl3.IdServicioLvl3');
            $this->db->order_by('EngServicioLvl3.IdServicioLvl3', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl3']=$row->IdServicioLvl3;
                    $arrayItems[$counter]['IdServicioLvl2']=$row->IdServicioLvl2;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('EngServicioLvl3');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('EngServicioLvl3.IdServicioLvl3', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl3']=$row->IdServicioLvl3;
                    $arrayItems[$counter]['IdServicioLvl2']=$row->IdServicioLvl2;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }

    }    
    public function getServiciosProductosLvl4(){
        if ($this->session->userdata('Idioma')=='Español') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('ServicioLvl4');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('ProductoLvl4', 'ServicioLvl4.IdServicioLvl4 = ProductoLvl4.IdServicioLvl4');
            $this->db->group_by('ServicioLvl4.IdServicioLvl4');
            $this->db->order_by('ServicioLvl4.IdServicioLvl4', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl4']=$row->IdServicioLvl4;
                    $arrayItems[$counter]['IdServicioLvl3']=$row->IdServicioLvl3;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('ServicioLvl4');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('ServicioLvl4.IdServicioLvl4', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl4']=$row->IdServicioLvl4;
                    $arrayItems[$counter]['IdServicioLvl3']=$row->IdServicioLvl3;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('EngServicioLvl4');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('EngProductoLvl4', 'EngServicioLvl4.IdServicioLvl4 = EngProductoLvl4.IdServicioLvl4');
            $this->db->group_by('EngServicioLvl4.IdServicioLvl4');
            $this->db->order_by('EngServicioLvl4.IdServicioLvl4', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl4']=$row->IdServicioLvl4;
                    $arrayItems[$counter]['IdServicioLvl3']=$row->IdServicioLvl3;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('EngServicioLvl4');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('EngServicioLvl4.IdServicioLvl4', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl4']=$row->IdServicioLvl4;
                    $arrayItems[$counter]['IdServicioLvl3']=$row->IdServicioLvl3;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }

    }

    public function getServiciosProductosDefaultMenu(){
        if ($this->session->userdata('Idioma')=='Español') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('ServicioLvl1');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('ProductoLvl1', 'ServicioLvl1.IdServicioLvl1 = ProductoLvl1.IdServicioLvl1');
            $this->db->group_by('ServicioLvl1.IdServicioLvl1');
            $this->db->order_by('ServicioLvl1.IdServicioLvl1', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Level']=1;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('ServicioLvl1');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('ServicioLvl1.IdServicioLvl1', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Level']=1;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $counter=0;
            $this->db->select('*');
            $this->db->from('EngServicioLvl1');
            $this->db->where('EsProducto', 'Si');
            $this->db->join('EngProductoLvl1', 'EngServicioLvl1.IdServicioLvl1 = EngProductoLvl1.IdServicioLvl1');
            $this->db->group_by('EngServicioLvl1.IdServicioLvl1');
            $this->db->order_by('EngServicioLvl1.IdServicioLvl1', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Level']=1;
                    $arrayItems[$counter]['Overview']=$row->Overview;
                    $arrayItems[$counter]['Ficha']=$row->Ficha;
                    $counter++;
                }
            }
            $this->db->select('*');
            $this->db->from('EngServicioLvl1');
            $this->db->where('EsProducto', 'No');
            $this->db->order_by('EngServicioLvl1.IdServicioLvl1', 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                foreach ($items->result() as $row) {
                    $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl1;
                    $arrayItems[$counter]['Titulo']=$row->Titulo;
                    $arrayItems[$counter]['Texto']=$row->Texto;
                    $arrayItems[$counter]['Imagen']=$row->Imagen;
                    $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                    $arrayItems[$counter]['Level']=1;
                    $counter++;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }

    }

    public function getServiciosProductos($IdServicio, $Level){
        if ($this->session->userdata('Idioma')=='Español') {
            $newLevel=$Level+1;
            $this->db->select('*');
            $this->db->from('ServicioLvl'.$newLevel);
            $this->db->where('ServicioLvl'.$newLevel.'.IdServicioLvl'.$Level, $IdServicio);
            $this->db->order_by('ServicioLvl'.$newLevel.'.IdServicioLvl'.$newLevel, 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                $counter=1;
                switch ($Level) {
                    case 1:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl2;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Level']=$newLevel;
                            $counter++;
                        }
                        break;
                    case 2:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl3;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Level']=$newLevel;
                            $counter++;
                        }
                        break;
                    case 3:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl4;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Level']=$newLevel;
                            $counter++;
                        }
                        break;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $newLevel=$Level+1;
            $this->db->select('*');
            $this->db->from('EngServicioLvl'.$newLevel);
            $this->db->where('EngServicioLvl'.$newLevel.'.IdServicioLvl'.$Level, $IdServicio);
            $this->db->order_by('EngServicioLvl'.$newLevel.'.IdServicioLvl'.$newLevel, 'DESC');
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                $counter=1;
                switch ($Level) {
                    case 1:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl2;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Level']=$newLevel;
                            $counter++;
                        }
                        break;
                    case 2:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl3;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Level']=$newLevel;
                            $counter++;
                        }
                        break;
                    case 3:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl4;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Level']=$newLevel;
                            $counter++;
                        }
                        break;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }

    }


    public function getInfoProducto($IdServicio, $Level){
        if ($this->session->userdata('Idioma')=='Español') {
            $this->db->select('*');
            $this->db->from('ServicioLvl'.$Level);
            $this->db->where('EsProducto', 'Si');
            $this->db->where('ServicioLvl'.$Level.'.IdServicioLvl'.$Level, $IdServicio);
            $this->db->join('ProductoLvl'.$Level, 'ServicioLvl'.$Level.'.IdServicioLvl'.$Level.' = ProductoLvl'.$Level.'.IdServicioLvl'.$Level);
            $this->db->group_by('ServicioLvl'.$Level.'.IdServicioLvl'.$Level);
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                $counter=1;
                switch ($Level) {
                    case 1:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl1;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Overview']=$row->Overview;
                            $arrayItems[$counter]['Ficha']=$row->Ficha;
                            $arrayItems[$counter]['Level']=$Level;
                            $counter++;
                        }
                        break;
                    case 2:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl2;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Overview']=$row->Overview;
                            $arrayItems[$counter]['Ficha']=$row->Ficha;
                            $arrayItems[$counter]['Level']=$Level;
                            $counter++;
                        }
                        break;
                    case 3:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl3;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Overview']=$row->Overview;
                            $arrayItems[$counter]['Ficha']=$row->Ficha;
                            $arrayItems[$counter]['Level']=$Level;
                            $counter++;
                        }
                        break;
                    case 3:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl4;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Overview']=$row->Overview;
                            $arrayItems[$counter]['Ficha']=$row->Ficha;
                            $arrayItems[$counter]['Level']=$Level;
                            $counter++;
                        }
                        break;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $this->db->select('*');
            $this->db->from('EngServicioLvl'.$Level);
            $this->db->where('EsProducto', 'Si');
            $this->db->where('EngServicioLvl'.$Level.'.IdServicioLvl'.$Level, $IdServicio);
            $this->db->join('EngProductoLvl'.$Level, 'EngServicioLvl'.$Level.'.IdServicioLvl'.$Level.' = EngProductoLvl'.$Level.'.IdServicioLvl'.$Level);
            $this->db->group_by('EngServicioLvl'.$Level.'.IdServicioLvl'.$Level);
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                $counter=1;
                switch ($Level) {
                    case 1:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl1;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Overview']=$row->Overview;
                            $arrayItems[$counter]['Ficha']=$row->Ficha;
                            $arrayItems[$counter]['Level']=$Level;
                            $counter++;
                        }
                        break;
                    case 2:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl2;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Overview']=$row->Overview;
                            $arrayItems[$counter]['Ficha']=$row->Ficha;
                            $arrayItems[$counter]['Level']=$Level;
                            $counter++;
                        }
                        break;
                    case 3:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl3;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Overview']=$row->Overview;
                            $arrayItems[$counter]['Ficha']=$row->Ficha;
                            $arrayItems[$counter]['Level']=$Level;
                            $counter++;
                        }
                        break;
                    case 3:
                        foreach ($items->result() as $row) {
                            $arrayItems[$counter]['IdServicioLvl']=$row->IdServicioLvl4;
                            $arrayItems[$counter]['Titulo']=$row->Titulo;
                            $arrayItems[$counter]['Texto']=$row->Texto;
                            $arrayItems[$counter]['Imagen']=$row->Imagen;
                            $arrayItems[$counter]['EsProducto']=$row->EsProducto;
                            $arrayItems[$counter]['Overview']=$row->Overview;
                            $arrayItems[$counter]['Ficha']=$row->Ficha;
                            $arrayItems[$counter]['Level']=$Level;
                            $counter++;
                        }
                        break;
                }
            }
            if (!empty($arrayItems)) {
                return $arrayItems;
            }else{
                return false;
            }
        }

    }



    public function deleteServicio($IdServicio, $Level){
        if ($this->session->userdata('Idioma')=='Español') {
            $this->db->select('*');
            $this->db->from('ServicioLvl'.$Level);
            $this->db->where('IdServicioLvl'.$Level, $IdServicio);
            $items = $this->db->get();
            $dir="assets/recursos_sistema/level".$Level."/".$IdServicio."/";
            if ($items->num_rows() > 0){
                if ($this->db->delete('ServicioLvl'.$Level, array('IdServicioLvl'.$Level => $IdServicio))) {
                    foreach ($items ->result() as $row) {
                        if (array_map('unlink', glob($dir."*"))) {
                            return true;
                        }
                    }
                }else{
                    return false;
                }
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $this->db->select('*');
            $this->db->from('EngServicioLvl'.$Level);
            $this->db->where('IdServicioLvl'.$Level, $IdServicio);
            $items = $this->db->get();
            $dir="assets/recursos_sistema/level".$Level."/".$IdServicio."/";
            if ($items->num_rows() > 0){
                if ($this->db->delete('EngServicioLvl'.$Level, array('IdServicioLvl'.$Level => $IdServicio))) {
                    foreach ($items ->result() as $row) {
                        if (array_map('unlink', glob($dir."*"))) {
                            return true;
                        }
                    }
                }else{
                    return false;
                }
            }
        }

    }

    public function uploadServicio($dataServicio, $Level, $IdServicio){
        if ($this->session->userdata('Idioma')=='Español') {
            $this->db->where('IdServicioLvl'.$Level, $IdServicio);
            if ($this->db->update('ServicioLvl'.$Level, $dataServicio)) {
                return true;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $this->db->where('IdServicioLvl'.$Level, $IdServicio);
            if ($this->db->update('EngServicioLvl'.$Level, $dataServicio)) {
                return true;
            }else{
                return false;
            }
        }

    }

    public function ifExistProductoDelete($Level, $IdServicio){
        if ($this->session->userdata('Idioma')=='Español') {
            $this->db->select('*');
            $this->db->from('ProductoLvl'.$Level);
            $this->db->where('IdServicioLvl'.$Level, $IdServicio);
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                $dir="assets/recursos_sistema/level".$Level."/".$IdServicio."/";
                if ($this->db->delete('ProductoLvl'.$Level, array('IdServicioLvl'.$Level => $IdServicio))) {
                    foreach ($items ->result() as $row) {
                        $FichaNme=$row->Ficha;
                        if (unlink($dir.$FichaNme)) {
                            return true;
                        }
                    }
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $this->db->select('*');
            $this->db->from('EngProductoLvl'.$Level);
            $this->db->where('IdServicioLvl'.$Level, $IdServicio);
            $items = $this->db->get();
            if ($items->num_rows() > 0){
                $dir="assets/recursos_sistema/level".$Level."/".$IdServicio."/";
                if ($this->db->delete('EngProductoLvl'.$Level, array('IdServicioLvl'.$Level => $IdServicio))) {
                    foreach ($items ->result() as $row) {
                        $FichaNme=$row->Ficha;
                        if (unlink($dir.$FichaNme)) {
                            return true;
                        }
                    }
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }

    }

    public function makeProducto($dataProducto, $Level){
        if ($this->session->userdata('Idioma')=='Español') {
            if ($this->db->insert('ProductoLvl'.$Level, $dataProducto)) {
                return  true;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            if ($this->db->insert('EngProductoLvl'.$Level, $dataProducto)) {
                return  true;
            }else{
                return false;
            }
        }

    }

    public function uploadProducto($dataProducto, $Level, $IdServicio){
        if ($this->session->userdata('Idioma')=='Español') {
            $this->db->where('IdServicioLvl'.$Level, $IdServicio);
            if ($this->db->update('ProductoLvl'.$Level, $dataProducto)) {
                return true;
            }else{
                return false;
            }
        }elseif ($this->session->userdata('Idioma')=='Ingles') {
            $this->db->where('IdServicioLvl'.$Level, $IdServicio);
            if ($this->db->update('EngProductoLvl'.$Level, $dataProducto)) {
                return true;
            }else{
                return false;
            }
        }
    }



}
?>
