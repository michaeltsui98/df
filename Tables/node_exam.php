<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_node_exam  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'exam' );
			self::$pk = '';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getNode_id(){
			return self::$_data ['node_id'];
		}
		public function getPaper_id(){
			return self::$_data ['paper_id'];
		}
		public function getExam_score(){
			return self::$_data ['exam_score'];
		}
		public function getExam_ranking(){
			return self::$_data ['exam_ranking'];
		}
		public function getExam_user(){
			return self::$_data ['exam_user'];
		}
		public function getExam_time(){
			return self::$_data ['exam_time'];
		}
		public function setId($value){
			return self::$_data ['id'] = $value;
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
		public function setExam_score($value){
			return self::$_data ['exam_score'] = $value;
			$this;
		}
		public function setExam_ranking($value){
			return self::$_data ['exam_ranking'] = $value;
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