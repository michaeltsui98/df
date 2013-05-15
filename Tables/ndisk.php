<?php 
 /** 
 * @Copyright Michael 
 * @author Michaeltsui98 
 * @version 3.0 2013/5/15 10:09:54 
 */
class Tables_ndisk  extends Tables_Model {
		function  __construct(){
			parent::__construct ( 'ndisk' );
			self::$pk = 'disk_id';
		}
		public function getDisk_id(){
			return self::$_data ['disk_id'];
		}
		public function getObj_id(){
			return self::$_data ['obj_id'];
		}
		public function getDisk_size(){
			return self::$_data ['disk_size'];
		}
		public function getDisk_use_size(){
			return self::$_data ['disk_use_size'];
		}
		public function getObj_type(){
			return self::$_data ['obj_type'];
		}
		public function getFile_num(){
			return self::$_data ['file_num'];
		}
		public function getDisk_time(){
			return self::$_data ['disk_time'];
		}
		public function getDisk_priv(){
			return self::$_data ['disk_priv'];
		}
		public function setDisk_id($value){
			return self::$_data ['disk_id'] = $value;
			self::$pk_val = $value;
			$this;
		}
		public function setObj_id($value){
			return self::$_data ['obj_id'] = $value;
			$this;
		}
		public function setDisk_size($value){
			return self::$_data ['disk_size'] = $value;
			$this;
		}
		public function setDisk_use_size($value){
			return self::$_data ['disk_use_size'] = $value;
			$this;
		}
		public function setObj_type($value){
			return self::$_data ['obj_type'] = $value;
			$this;
		}
		public function setFile_num($value){
			return self::$_data ['file_num'] = $value;
			$this;
		}
		public function setDisk_time($value){
			return self::$_data ['disk_time'] = $value;
			$this;
		}
		public function setDisk_priv($value){
			return self::$_data ['disk_priv'] = $value;
			$this;
		}
}