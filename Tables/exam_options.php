<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_exam_options  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'options' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getTopic_id(){
			return self::$_data ['topic_id'];
		}
		public function getOptions_item(){
			return self::$_data ['options_item'];
		}
		public function getOptions_choose(){
			return self::$_data ['options_choose'];
		}
		public function getOptions_order(){
			return self::$_data ['options_order'];
		}
		public function getOptions_time(){
			return self::$_data ['options_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setTopic_id($value){
			return self::$_data ['topic_id'] = $value;
			$this;
		}
		public function setOptions_item($value){
			return self::$_data ['options_item'] = $value;
			$this;
		}
		public function setOptions_choose($value){
			return self::$_data ['options_choose'] = $value;
			$this;
		}
		public function setOptions_order($value){
			return self::$_data ['options_order'] = $value;
			$this;
		}
		public function setOptions_time($value){
			return self::$_data ['options_time'] = $value;
			$this;
		}
}