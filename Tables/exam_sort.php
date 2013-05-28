<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_exam_sort  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'sort' );
			self::$pk = '';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getSort_title(){
			return self::$_data ['sort_title'];
		}
		public function getSort_description(){
			return self::$_data ['sort_description'];
		}
		public function getSort_order(){
			return self::$_data ['sort_order'];
		}
		public function getSort_time(){
			return self::$_data ['sort_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			$this;
		}
		public function setSort_title($value){
			return self::$_data ['sort_title'] = $value;
			$this;
		}
		public function setSort_description($value){
			return self::$_data ['sort_description'] = $value;
			$this;
		}
		public function setSort_order($value){
			return self::$_data ['sort_order'] = $value;
			$this;
		}
		public function setSort_time($value){
			return self::$_data ['sort_time'] = $value;
			$this;
		}
}