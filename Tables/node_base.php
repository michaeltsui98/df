<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_node_base  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'base' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getBase_fid(){
			return self::$_data ['base_fid'];
		}
		public function getBase_title(){
			return self::$_data ['base_title'];
		}
		public function getBase_order(){
			return self::$_data ['base_order'];
		}
		public function getBase_time(){
			return self::$_data ['base_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setBase_fid($value){
			return self::$_data ['base_fid'] = $value;
			$this;
		}
		public function setBase_title($value){
			return self::$_data ['base_title'] = $value;
			$this;
		}
		public function setBase_order($value){
			return self::$_data ['base_order'] = $value;
			$this;
		}
		public function setBase_time($value){
			return self::$_data ['base_time'] = $value;
			$this;
		}
}