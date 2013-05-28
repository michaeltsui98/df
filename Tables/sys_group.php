<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_sys_group  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'group' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getGroup_fid(){
			return self::$_data ['group_fid'];
		}
		public function getGroup_name(){
			return self::$_data ['group_name'];
		}
		public function getGroup_description(){
			return self::$_data ['group_description'];
		}
		public function getModule_list(){
			return self::$_data ['module_list'];
		}
		public function getGroup_isok(){
			return self::$_data ['group_isok'];
		}
		public function getGroup_order(){
			return self::$_data ['group_order'];
		}
		public function getGroup_time(){
			return self::$_data ['group_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setGroup_fid($value){
			return self::$_data ['group_fid'] = $value;
			$this;
		}
		public function setGroup_name($value){
			return self::$_data ['group_name'] = $value;
			$this;
		}
		public function setGroup_description($value){
			return self::$_data ['group_description'] = $value;
			$this;
		}
		public function setModule_list($value){
			return self::$_data ['module_list'] = $value;
			$this;
		}
		public function setGroup_isok($value){
			return self::$_data ['group_isok'] = $value;
			$this;
		}
		public function setGroup_order($value){
			return self::$_data ['group_order'] = $value;
			$this;
		}
		public function setGroup_time($value){
			return self::$_data ['group_time'] = $value;
			$this;
		}
}