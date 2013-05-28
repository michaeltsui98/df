<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_sys_purview  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'purview' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getGroup_id(){
			return self::$_data ['group_id'];
		}
		public function getModule_id(){
			return self::$_data ['module_id'];
		}
		public function getC(){
			return self::$_data ['c'];
		}
		public function getA(){
			return self::$_data ['a'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setGroup_id($value){
			return self::$_data ['group_id'] = $value;
			$this;
		}
		public function setModule_id($value){
			return self::$_data ['module_id'] = $value;
			$this;
		}
		public function setC($value){
			return self::$_data ['c'] = $value;
			$this;
		}
		public function setA($value){
			return self::$_data ['a'] = $value;
			$this;
		}
}