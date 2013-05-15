<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/15 10:09:54 
 */
class Tables_ndisk_file8  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'file8' );
			self::$pk = 'file_id';
		}
		public function getFile_id(){
			return self::$_data ['file_id'];
		}
		public function getDisk_id(){
			return self::$_data ['disk_id'];
		}
		public function getFile_flv(){
			return self::$_data ['file_flv'];
		}
		public function getFile_name(){
			return self::$_data ['file_name'];
		}
		public function getFile_ext(){
			return self::$_data ['file_ext'];
		}
		public function getFile_path(){
			return self::$_data ['file_path'];
		}
		public function getFile_size(){
			return self::$_data ['file_size'];
		}
		public function getFile_ori_size(){
			return self::$_data ['file_ori_size'];
		}
		public function getFile_views(){
			return self::$_data ['file_views'];
		}
		public function getFile_downs(){
			return self::$_data ['file_downs'];
		}
		public function getFile_likes(){
			return self::$_data ['file_likes'];
		}
		public function getIs_dir(){
			return self::$_data ['is_dir'];
		}
		public function getDir_id(){
			return self::$_data ['dir_id'];
		}
		public function getIs_share(){
			return self::$_data ['is_share'];
		}
		public function getShare_pwd(){
			return self::$_data ['share_pwd'];
		}
		public function getFile_md5(){
			return self::$_data ['file_md5'];
		}
		public function getFile_time(){
			return self::$_data ['file_time'];
		}
		public function getShare_time(){
			return self::$_data ['share_time'];
		}
		public function getIs_link(){
			return self::$_data ['is_link'];
		}
		public function getShare_desc(){
			return self::$_data ['share_desc'];
		}
		public function setFile_id($value){
			return self::$_data ['file_id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setDisk_id($value){
			return self::$_data ['disk_id'] = $value;
			$this;
		}
		public function setFile_flv($value){
			return self::$_data ['file_flv'] = $value;
			$this;
		}
		public function setFile_name($value){
			return self::$_data ['file_name'] = $value;
			$this;
		}
		public function setFile_ext($value){
			return self::$_data ['file_ext'] = $value;
			$this;
		}
		public function setFile_path($value){
			return self::$_data ['file_path'] = $value;
			$this;
		}
		public function setFile_size($value){
			return self::$_data ['file_size'] = $value;
			$this;
		}
		public function setFile_ori_size($value){
			return self::$_data ['file_ori_size'] = $value;
			$this;
		}
		public function setFile_views($value){
			return self::$_data ['file_views'] = $value;
			$this;
		}
		public function setFile_downs($value){
			return self::$_data ['file_downs'] = $value;
			$this;
		}
		public function setFile_likes($value){
			return self::$_data ['file_likes'] = $value;
			$this;
		}
		public function setIs_dir($value){
			return self::$_data ['is_dir'] = $value;
			$this;
		}
		public function setDir_id($value){
			return self::$_data ['dir_id'] = $value;
			$this;
		}
		public function setIs_share($value){
			return self::$_data ['is_share'] = $value;
			$this;
		}
		public function setShare_pwd($value){
			return self::$_data ['share_pwd'] = $value;
			$this;
		}
		public function setFile_md5($value){
			return self::$_data ['file_md5'] = $value;
			$this;
		}
		public function setFile_time($value){
			return self::$_data ['file_time'] = $value;
			$this;
		}
		public function setShare_time($value){
			return self::$_data ['share_time'] = $value;
			$this;
		}
		public function setIs_link($value){
			return self::$_data ['is_link'] = $value;
			$this;
		}
		public function setShare_desc($value){
			return self::$_data ['share_desc'] = $value;
			$this;
		}
}