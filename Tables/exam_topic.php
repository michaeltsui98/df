<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_exam_topic  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'topic' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getTopic_type(){
			return self::$_data ['topic_type'];
		}
		public function getTopic_title(){
			return self::$_data ['topic_title'];
		}
		public function getTopic_resolve(){
			return self::$_data ['topic_resolve'];
		}
		public function getTopic_answer(){
			return self::$_data ['topic_answer'];
		}
		public function getTopic_score(){
			return self::$_data ['topic_score'];
		}
		public function getTopic_clicks(){
			return self::$_data ['topic_clicks'];
		}
		public function getTopic_xueduan(){
			return self::$_data ['topic_xueduan'];
		}
		public function getTopic_grade(){
			return self::$_data ['topic_grade'];
		}
		public function getTopic_subject(){
			return self::$_data ['topic_subject'];
		}
		public function getTopic_edition(){
			return self::$_data ['topic_edition'];
		}
		public function getTopic_special(){
			return self::$_data ['topic_special'];
		}
		public function getTopic_label(){
			return self::$_data ['topic_label'];
		}
		public function getTopic_user(){
			return self::$_data ['topic_user'];
		}
		public function getTopic_show(){
			return self::$_data ['topic_show'];
		}
		public function getTopic_order(){
			return self::$_data ['topic_order'];
		}
		public function getTopic_time(){
			return self::$_data ['topic_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setTopic_type($value){
			return self::$_data ['topic_type'] = $value;
			$this;
		}
		public function setTopic_title($value){
			return self::$_data ['topic_title'] = $value;
			$this;
		}
		public function setTopic_resolve($value){
			return self::$_data ['topic_resolve'] = $value;
			$this;
		}
		public function setTopic_answer($value){
			return self::$_data ['topic_answer'] = $value;
			$this;
		}
		public function setTopic_score($value){
			return self::$_data ['topic_score'] = $value;
			$this;
		}
		public function setTopic_clicks($value){
			return self::$_data ['topic_clicks'] = $value;
			$this;
		}
		public function setTopic_xueduan($value){
			return self::$_data ['topic_xueduan'] = $value;
			$this;
		}
		public function setTopic_grade($value){
			return self::$_data ['topic_grade'] = $value;
			$this;
		}
		public function setTopic_subject($value){
			return self::$_data ['topic_subject'] = $value;
			$this;
		}
		public function setTopic_edition($value){
			return self::$_data ['topic_edition'] = $value;
			$this;
		}
		public function setTopic_special($value){
			return self::$_data ['topic_special'] = $value;
			$this;
		}
		public function setTopic_label($value){
			return self::$_data ['topic_label'] = $value;
			$this;
		}
		public function setTopic_user($value){
			return self::$_data ['topic_user'] = $value;
			$this;
		}
		public function setTopic_show($value){
			return self::$_data ['topic_show'] = $value;
			$this;
		}
		public function setTopic_order($value){
			return self::$_data ['topic_order'] = $value;
			$this;
		}
		public function setTopic_time($value){
			return self::$_data ['topic_time'] = $value;
			$this;
		}
}