<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_sys_user  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'user' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getGroup_id(){
			return self::$_data ['group_id'];
		}
		public function getUid(){
			return self::$_data ['uid'];
		}
		public function getUser_name(){
			return self::$_data ['user_name'];
		}
		public function getUser_pass(){
			return self::$_data ['user_pass'];
		}
		public function getUser_realname(){
			return self::$_data ['user_realname'];
		}
		public function getUser_school(){
			return self::$_data ['user_school'];
		}
		public function getUser_isok(){
			return self::$_data ['user_isok'];
		}
		public function getUser_time(){
			return self::$_data ['user_time'];
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
		public function setUid($value){
			return self::$_data ['uid'] = $value;
			$this;
		}
		public function setUser_name($value){
			return self::$_data ['user_name'] = $value;
			$this;
		}
		public function setUser_pass($value){
			return self::$_data ['user_pass'] = $value;
			$this;
		}
		public function setUser_realname($value){
			return self::$_data ['user_realname'] = $value;
			$this;
		}
		public function setUser_school($value){
			return self::$_data ['user_school'] = $value;
			$this;
		}
		public function setUser_isok($value){
			return self::$_data ['user_isok'] = $value;
			$this;
		}
		public function setUser_time($value){
			return self::$_data ['user_time'] = $value;
			$this;
		}
}