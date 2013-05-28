<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_exam_paper  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'paper' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getNode_id(){
			return self::$_data ['node_id'];
		}
		public function getPaper_title(){
			return self::$_data ['paper_title'];
		}
		public function getPaper_description(){
			return self::$_data ['paper_description'];
		}
		public function getPaper_clicks(){
			return self::$_data ['paper_clicks'];
		}
		public function getPaper_show(){
			return self::$_data ['paper_show'];
		}
		public function getPaper_mode(){
			return self::$_data ['paper_mode'];
		}
		public function getPaper_type(){
			return self::$_data ['paper_type'];
		}
		public function getPaper_user(){
			return self::$_data ['paper_user'];
		}
		public function getPaper_order(){
			return self::$_data ['paper_order'];
		}
		public function getPaper_time(){
			return self::$_data ['paper_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setNode_id($value){
			return self::$_data ['node_id'] = $value;
			$this;
		}
		public function setPaper_title($value){
			return self::$_data ['paper_title'] = $value;
			$this;
		}
		public function setPaper_description($value){
			return self::$_data ['paper_description'] = $value;
			$this;
		}
		public function setPaper_clicks($value){
			return self::$_data ['paper_clicks'] = $value;
			$this;
		}
		public function setPaper_show($value){
			return self::$_data ['paper_show'] = $value;
			$this;
		}
		public function setPaper_mode($value){
			return self::$_data ['paper_mode'] = $value;
			$this;
		}
		public function setPaper_type($value){
			return self::$_data ['paper_type'] = $value;
			$this;
		}
		public function setPaper_user($value){
			return self::$_data ['paper_user'] = $value;
			$this;
		}
		public function setPaper_order($value){
			return self::$_data ['paper_order'] = $value;
			$this;
		}
		public function setPaper_time($value){
			return self::$_data ['paper_time'] = $value;
			$this;
		}
}