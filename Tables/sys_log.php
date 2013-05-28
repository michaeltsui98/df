<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_sys_log  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'log' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getLog_msg(){
			return self::$_data ['log_msg'];
		}
		public function getModule_id(){
			return self::$_data ['module_id'];
		}
		public function getModule_controller(){
			return self::$_data ['module_controller'];
		}
		public function getModule_action(){
			return self::$_data ['module_action'];
		}
		public function getUser_name(){
			return self::$_data ['user_name'];
		}
		public function getUid(){
			return self::$_data ['uid'];
		}
		public function getLog_time(){
			return self::$_data ['log_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setLog_msg($value){
			return self::$_data ['log_msg'] = $value;
			$this;
		}
		public function setModule_id($value){
			return self::$_data ['module_id'] = $value;
			$this;
		}
		public function setModule_controller($value){
			return self::$_data ['module_controller'] = $value;
			$this;
		}
		public function setModule_action($value){
			return self::$_data ['module_action'] = $value;
			$this;
		}
		public function setUser_name($value){
			return self::$_data ['user_name'] = $value;
			$this;
		}
		public function setUid($value){
			return self::$_data ['uid'] = $value;
			$this;
		}
		public function setLog_time($value){
			return self::$_data ['log_time'] = $value;
			$this;
		}
}