<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_knowledge_node  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'node' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getNode_fid(){
			return self::$_data ['node_fid'];
		}
		public function getNode_title(){
			return self::$_data ['node_title'];
		}
		public function getNode_xueduan(){
			return self::$_data ['node_xueduan'];
		}
		public function getNode_grade(){
			return self::$_data ['node_grade'];
		}
		public function getNode_subject(){
			return self::$_data ['node_subject'];
		}
		public function getNode_edition(){
			return self::$_data ['node_edition'];
		}
		public function getNode_special(){
			return self::$_data ['node_special'];
		}
		public function getNode_label(){
			return self::$_data ['node_label'];
		}
		public function getNode_user(){
			return self::$_data ['node_user'];
		}
		public function getNode_show(){
			return self::$_data ['node_show'];
		}
		public function getNode_order(){
			return self::$_data ['node_order'];
		}
		public function getNode_time(){
			return self::$_data ['node_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setNode_fid($value){
			return self::$_data ['node_fid'] = $value;
			$this;
		}
		public function setNode_title($value){
			return self::$_data ['node_title'] = $value;
			$this;
		}
		public function setNode_xueduan($value){
			return self::$_data ['node_xueduan'] = $value;
			$this;
		}
		public function setNode_grade($value){
			return self::$_data ['node_grade'] = $value;
			$this;
		}
		public function setNode_subject($value){
			return self::$_data ['node_subject'] = $value;
			$this;
		}
		public function setNode_edition($value){
			return self::$_data ['node_edition'] = $value;
			$this;
		}
		public function setNode_special($value){
			return self::$_data ['node_special'] = $value;
			$this;
		}
		public function setNode_label($value){
			return self::$_data ['node_label'] = $value;
			$this;
		}
		public function setNode_user($value){
			return self::$_data ['node_user'] = $value;
			$this;
		}
		public function setNode_show($value){
			return self::$_data ['node_show'] = $value;
			$this;
		}
		public function setNode_order($value){
			return self::$_data ['node_order'] = $value;
			$this;
		}
		public function setNode_time($value){
			return self::$_data ['node_time'] = $value;
			$this;
		}
}