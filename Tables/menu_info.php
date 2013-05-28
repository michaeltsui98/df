<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_menu_info  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'info' );
			self::$pk = 'menu_id';
		}
		public function getMenu_id(){
			return self::$_data ['menu_id'];
		}
		public function getMenu_name(){
			return self::$_data ['menu_name'];
		}
		public function getMenu_is_available(){
			return self::$_data ['menu_is_available'];
		}
		public function getOrder_start_time(){
			return self::$_data ['order_start_time'];
		}
		public function getOrder_end_time(){
			return self::$_data ['order_end_time'];
		}
		public function getModify_end_time(){
			return self::$_data ['modify_end_time'];
		}
		public function getCheck_end_time(){
			return self::$_data ['check_end_time'];
		}
		public function getSuppler_end_time(){
			return self::$_data ['suppler_end_time'];
		}
		public function getMenu_year(){
			return self::$_data ['menu_year'];
		}
		public function setMenu_id($value){
			return self::$_data ['menu_id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setMenu_name($value){
			return self::$_data ['menu_name'] = $value;
			$this;
		}
		public function setMenu_is_available($value){
			return self::$_data ['menu_is_available'] = $value;
			$this;
		}
		public function setOrder_start_time($value){
			return self::$_data ['order_start_time'] = $value;
			$this;
		}
		public function setOrder_end_time($value){
			return self::$_data ['order_end_time'] = $value;
			$this;
		}
		public function setModify_end_time($value){
			return self::$_data ['modify_end_time'] = $value;
			$this;
		}
		public function setCheck_end_time($value){
			return self::$_data ['check_end_time'] = $value;
			$this;
		}
		public function setSuppler_end_time($value){
			return self::$_data ['suppler_end_time'] = $value;
			$this;
		}
		public function setMenu_year($value){
			return self::$_data ['menu_year'] = $value;
			$this;
		}
}