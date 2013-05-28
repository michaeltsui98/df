<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_exam_paper_topic  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'paper_topic' );
			self::$pk = '';
		}
		public function getPaper_id(){
			return self::$_data ['paper_id'];
		}
		public function getTopic_id(){
			return self::$_data ['topic_id'];
		}
		public function getTopic_score(){
			return self::$_data ['topic_score'];
		}
		public function getOrder(){
			return self::$_data ['order'];
		}
		public function setPaper_id($value){
			return self::$_data ['paper_id'] = $value;
			$this;
		}
		public function setTopic_id($value){
			return self::$_data ['topic_id'] = $value;
			$this;
		}
		public function setTopic_score($value){
			return self::$_data ['topic_score'] = $value;
			$this;
		}
		public function setOrder($value){
			return self::$_data ['order'] = $value;
			$this;
		}
}