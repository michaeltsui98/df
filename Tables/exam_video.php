<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/28 10:08:11 
 */
class Tables_exam_video  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'video' );
			self::$pk = 'id';
		}
		public function getId(){
			return self::$_data ['id'];
		}
		public function getNode_id(){
			return self::$_data ['node_id'];
		}
		public function getVideo_title(){
			return self::$_data ['video_title'];
		}
		public function getVideo_description(){
			return self::$_data ['video_description'];
		}
		public function getVideo_playtime(){
			return self::$_data ['video_playtime'];
		}
		public function getVideo_key(){
			return self::$_data ['video_key'];
		}
		public function getVideo_ori_size(){
			return self::$_data ['video_ori_size'];
		}
		public function getVideo_url(){
			return self::$_data ['video_url'];
		}
		public function getVideo_size(){
			return self::$_data ['video_size'];
		}
		public function getVideo_plays(){
			return self::$_data ['video_plays'];
		}
		public function getVideo_user(){
			return self::$_data ['video_user'];
		}
		public function getVideo_time(){
			return self::$_data ['video_time'];
		}
		public function getVideo_order(){
			return self::$_data ['video_order'];
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
		public function setVideo_title($value){
			return self::$_data ['video_title'] = $value;
			$this;
		}
		public function setVideo_description($value){
			return self::$_data ['video_description'] = $value;
			$this;
		}
		public function setVideo_playtime($value){
			return self::$_data ['video_playtime'] = $value;
			$this;
		}
		public function setVideo_key($value){
			return self::$_data ['video_key'] = $value;
			$this;
		}
		public function setVideo_ori_size($value){
			return self::$_data ['video_ori_size'] = $value;
			$this;
		}
		public function setVideo_url($value){
			return self::$_data ['video_url'] = $value;
			$this;
		}
		public function setVideo_size($value){
			return self::$_data ['video_size'] = $value;
			$this;
		}
		public function setVideo_plays($value){
			return self::$_data ['video_plays'] = $value;
			$this;
		}
		public function setVideo_user($value){
			return self::$_data ['video_user'] = $value;
			$this;
		}
		public function setVideo_time($value){
			return self::$_data ['video_time'] = $value;
			$this;
		}
		public function setVideo_order($value){
			return self::$_data ['video_order'] = $value;
			$this;
		}
}