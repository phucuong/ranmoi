<?php
class SessionService
    {
        public function __construct()
        {
            $ns = 'session_namespace';
            $this->zs = new Zend_Session_Namespace( $ns );
        }
        public function setSession($ar){
            foreach( $ar as $k=>$v ){
                $this->zs->$k    = empty($v) ? "" : $v;
            }
        }
        public function getSession(){
            $ret_array = array();
            foreach( $this->zs as $k=>$v ){
                $ret_array[$k] = $v;
            }
            return $ret_array;
        }

        public function clearSession(){
            foreach( $this->zs as $k=>$v ){
                $this->zs->$k = "";
            }
        }
		public function updateSession($key, $value){
			$this->zs->$key = empty($value) ? "" : $value;
		}
    }
?>