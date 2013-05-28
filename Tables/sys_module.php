<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_sys_module  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'module' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getModule_fid(){
			return self::$_data ['module_fid'];
		}
		public function getModule_type(){
			return self::$_data ['module_type'];
		}
		public function getModule_title(){
			return self::$_data ['module_title'];
		}
		public function getModule_url(){
			return self::$_data ['module_url'];
		}
		public function getModule_controller(){
			return self::$_data ['module_controller'];
		}
		public function getModule_action(){
			return self::$_data ['module_action'];
		}
		public function getModule_show(){
			return self::$_data ['module_show'];
		}
		public function getModule_order(){
			return self::$_data ['module_order'];
		}
		public function getModule_time(){
			return self::$_data ['module_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setModule_fid($value){
			return self::$_data ['module_fid'] = $value;
			$this;
		}
		public function setModule_type($value){
			return self::$_data ['module_type'] = $value;
			$this;
		}
		public function setModule_title($value){
			return self::$_data ['module_title'] = $value;
			$this;
		}
		public function setModule_url($value){
			return self::$_data ['module_url'] = $value;
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
		public function setModule_show($value){
			return self::$_data ['module_show'] = $value;
			$this;
		}
		public function setModule_order($value){
			return self::$_data ['module_order'] = $value;
			$this;
		}
		public function setModule_time($value){
			return self::$_data ['module_time'] = $value;
			$this;
		}
}