<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_node_exam_answer  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'exam_answer' );
			self::$pk = '';
		}
		public function getExam_id(){
			return self::$_data ['exam_id'];
		}
		public function getNode_id(){
			return self::$_data ['node_id'];
		}
		public function getPaper_id(){
			return self::$_data ['paper_id'];
		}
		public function getTopic_id(){
			return self::$_data ['topic_id'];
		}
		public function getExam_answer(){
			return self::$_data ['exam_answer'];
		}
		public function getExam_correct(){
			return self::$_data ['exam_correct'];
		}
		public function getExam_score(){
			return self::$_data ['exam_score'];
		}
		public function getExam_user(){
			return self::$_data ['exam_user'];
		}
		public function getExam_time(){
			return self::$_data ['exam_time'];
		}
		public function setExam_id($value){
			return self::$_data ['exam_id'] = $value;
			$this;
		}
		public function setNode_id($value){
			return self::$_data ['node_id'] = $value;
			$this;
		}
		public function setPaper_id($value){
			return self::$_data ['paper_id'] = $value;
			$this;
		}
		public function setTopic_id($value){
			return self::$_data ['topic_id'] = $value;
			$this;
		}
		public function setExam_answer($value){
			return self::$_data ['exam_answer'] = $value;
			$this;
		}
		public function setExam_correct($value){
			return self::$_data ['exam_correct'] = $value;
			$this;
		}
		public function setExam_score($value){
			return self::$_data ['exam_score'] = $value;
			$this;
		}
		public function setExam_user($value){
			return self::$_data ['exam_user'] = $value;
			$this;
		}
		public function setExam_time($value){
			return self::$_data ['exam_time'] = $value;
			$this;
		}
}