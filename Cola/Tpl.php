<?php   
/*
	模板文件夹在 tpl 目录下， 默认是default文件夹。
	模板缓存在 data/tpl_c目录下。
*/
global  $_K;
$_K ['i'] = 0;
$_K ['block_search'] = $_K ['block_replace'] = array ();
define('CHARSET', 'utf-8');
//模板缓存
define(TPL_CACHE, 0);
class Cola_Tpl {
	
	static private  $tpl_path = 'views/tpl_c';
	
	static function parse_code($tag_code, $tag_id, $tag_type = 'tag') {
		 
		$tplfile = 'db/' . $tag_type . '_' . $tag_id;
		$objfile = S_ROOT . static::$tpl_path . str_replace ( '/', '_', $tplfile ) . '.php';
		//read
		$tag_code = Cola_Tpl::parse_rule ( $tag_code );
		//write
		if(!is_dir(self::$tpl_path)){
			if(!mkdir(self::$tpl_path,07777,TRUE)){
				throw new Cola_Exception( 'Directory tpl_c must be writable');
			}
		}
		Cola_Tpl::swritefile ( $objfile, $tag_code ) or exit ( "File: $objfile can not be write!" );
		
		return $objfile;
	
	}
	static function parse_template($tpl) {
		//包含模板
		$tplfile = S_ROOT .  $tpl . '.htm';
		$objfile = S_ROOT . self::$tpl_path .DIRECTORY_SEPARATOR. str_replace ( '/', '_', $tpl ) . '.php';
		//var_dump($tpl,$tplfile,$objfile);die;
		//read
		if (! is_file( $tplfile )) {
			throw  new Cola_Exception($tplfile.'文件不存在！');
		
		}
		
		$template = Cola_Tpl::sreadfile ( $tplfile );
		empty ( $template ) and exit ( "Template file : $tplfile Not found or have no access!" );
		
		$template = Cola_Tpl::parse_rule ( $template, $tpl );
		//write
		if(!is_dir(self::$tpl_path)){
			if(!mkdir(self::$tpl_path,07777,TRUE)){
				throw new Cola_Exception ( 'Directory tpl_c must be writable');
			}
		}
		Cola_Tpl::swritefile ( $objfile, $template ) or exit ( "File: $objfile can not be write!" );
	
	}
	/**
	 * 
	 * 解析规则
	 * @param string $content  -html
	 * @param array  $sub_tpls 
	 * @param string $tpl
	 * @return string
	 */
	public static function parse_rule($template, $tpl = null) {
		global $_K;
		 
		$template = preg_replace ( "/{include\s+([a-z0-9_\/]+)\}/ie", "Cola_Tpl::readtemplate('\\1')", $template );
		//处理子页面中的代码
		$template = preg_replace ( "/{include\s+([a-z0-9_\/]+)\}/ie", "Cola_Tpl::readtemplate('\\1')", $template );
		
		//标签调用
		//$template = preg_replace ( '/\{tag\((.+?)\)\}/ie', "Cola_Tpl::readtag(\"'\\1'\")", $template );
		
		//广告调用
		//$template = preg_replace ( '/\{ad_tag\((.+?)\)\}/ie', "Cola_Tpl::ad_tag('\\1')", $template );
		
		//时间处理
		$template = preg_replace ( '/\{date\((.+?),(.+?)\)\}/ie', "Cola_Tpl::datetags('\\1','\\2')", $template );
		//货币显示
		//$template = preg_replace ( '/{c\:(.+?)(,?)(\d?)\}/ie', "Curren::currtags('\\1','\\3')", $template );
		////头像处理
		//$template = preg_replace ( '/\{avatar\((.+?),(.+?)\)\}/ie', "Cola_Tpl::avatar('\\1','\\2')", $template );
		//文字裁剪
		//$template = preg_replace ( '/\{cutstr\((.+?),(.+?)\)\}/ie', "Cola_Tpl::cutstr('\\1','\\2')", $template );
		
		//PHP代码
		$template = preg_replace ( "/\<\!\-\-\{eval\s+(.+?)\s*\}\-\-\>/ies", "Cola_Tpl::evaltags('\\1')", $template );
				
		//开始处理
		//变量
		$var_regexp = "((\\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)(\[[a-zA-Z0-9_\-\.\"\'\[\]\$\x7f-\xff]+\])*)";
		$template = preg_replace ( "/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $template );
		$template = preg_replace ( "/([\n\r]+)\t+/s", "\\1", $template );
		//数组变量
		$template = preg_replace ( "/(\\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\.([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/s", "\\1['\\2']", $template );
		
		//对象变量
		$template = preg_replace('/\{\$this-\>(.*)\}/Uis', '<?php echo -this->\\1 ;?>', $template);
		
		$template = preg_replace ( "/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s", "<?=\\1?>", $template );
		$template = preg_replace ( "/$var_regexp/es", "Cola_Tpl::addquote('<?=\\1?>')", $template );
		$template = preg_replace ( "/\<\?\=\<\?\=$var_regexp\?\>\?\>/es", "Cola_Tpl::addquote('<?php echo \\1;?>')", $template );
		
		
		 
		
		//逻辑
		$template = preg_replace ( "/\{elseif\s+(.+?)\}/ies", "Cola_Tpl::stripvtags('<?php } elseif(\\1) { ?>','')", $template );
		$template = preg_replace ( "/\{else\}/is", "<?php } else { ?>", $template );
		//循环
		for($i = 0; $i < 6; $i ++) {
			$template = preg_replace ( "/\{loop\s+(\S+)\s+(\S+)\}(.+?)\{\/loop\}/ies", "Cola_Tpl::stripvtags('<?php if(is_array(\\1)) { foreach(\\1 as \\2) { ?>','\\3<?php } } ?>')", $template );
			$template = preg_replace ( "/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}(.+?)\{\/loop\}/ies", "Cola_Tpl::stripvtags('<?php if(is_array(\\1)) { foreach(\\1 as \\2 => \\3) { ?>','\\4<?php } } ?>')", $template );
			$template = preg_replace ( "/\{if\s+(.+?)\}(.+?)\{\/if\}/ies", "Cola_Tpl::stripvtags('<?php if(\\1) { ?>','\\2<?php } ?>')", $template );
		}
		//常量
		$template = preg_replace ( "/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>", $template );
		//换行
		$template = preg_replace ( "/ \?\>[\n\r]*\<\? /s", " ", $template );
		
		$timestamp = $_SERVER['REQUEST_TIME'];
		//附加处理
		$template = "<?php Cola_Tpl::checkrefresh('$tpl', '$timestamp' );?>$template";
		
		//替换
		if(!empty($_K['block_search'])){ 
			$arr = array_combine(array_values($_K ['block_search']),array_values($_K['block_replace']));
			$template = strtr($template, $arr);
		}
		 
		

		$template = strtr($template, array('<?='=>'<?php echo '));
		
		$template = preg_replace('/-this-\>(.*)/Uis', '$this->\\1', $template);
		
		return $template;
	}
	
	static function addquote($var) {
		$var =  strtr (preg_replace ( '/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s', "['\\1']", $var ),"\\\"", "\"");
		return $var;
	}
	/**
	 * 转义页面输入的字符中,防止sql注入
	 * @param string,array $value
	 * @param bool $double_encode
	 * @return string 安全的字符
	 */
	public static function chars($value, $double_encode = FALSE)
	{
		
		if(is_array($value) or is_object($value)){
			foreach ($value as $k=>$v){
			   $value[$k]=Cola_Tpl::chars($v,$double_encode);
			}
		}else{
			if(CHARSET==='gbk'){
				$charset = 'iso-8859-1';
			}else{
				$charset = CHARSET;
			}
			$value = htmlspecialchars( (string) $value, ENT_QUOTES, $charset, $double_encode);
		}
		return $value;
	}
	static function striptagquotes($expr) {
		$expr = preg_replace ( '/\<\?\=(\\\$.+?)\?\>/s', "\\1", $expr );
		$expr = strtr (preg_replace ( '/\[\'([a-zA-Z0-9_\-\.\x7f-\xff]+)\'\]/s', "[\\1]", $expr ),"\\\"", "\"" );
		return $expr;
	}
	
	static function evaltags($php) {
		global $_K;
		$_K ['i'] ++;
		$search = "<!--EVAL_TAG_{$_K['i']}-->";
		$_K ['block_search'] [$_K ['i']] = $search;
		$_K ['block_replace'] [$_K ['i']] = "<?php " . Cola_Tpl::stripvtags ( $php ) . " ?>";
		return $search;
	}
	/**
	 * 日期标签
	 * @param string $parameter 格式
	 * @param int $value 
	 * @return string
	 */
	static function datetags($parameter, $value) {
		global $_K;
		$_K ['i'] ++;
		$search = "<!--DATE_TAG_{$_K['i']}-->";
		$_K ['block_search'] [$_K ['i']] = $search;
		$_K ['block_replace'] [$_K ['i']] = "<?php if((int){$value}){echo date({$parameter},{$value}); } ?>";
		return $search;
	}
	
	/**
	 * 广告/位标签
	 * @param $target 广告位置名称
	 */
	static function ad_tag($target_name) {
		global $_K;
		$_K ['i'] ++;
		$search = "<!--AD_TAG_{$_K['i']}-->";
		$_K ['block_search'] [$_K ['i']] = $search;
		$_K ['block_replace'] [$_K ['i']] = "<?php Sys_tag::ad_tag('$target_name') ?>";
		return $search;

	}
	/**
	 * 数据标签
	 * @param string $name
	 * @return string
	 */
	static function readtag($name) {
		global $_K;
		$_K ['i'] ++;
		$search = "<!--READ_TAG_{$_K['i']}-->";
		$_K ['block_search'] [$_K ['i']] = $search;
		$_K ['block_replace'] [$_K ['i']] = "<?php Sys_tag::factory()->readtag($name) ?>";
		return $search;
	}
	
	/**
	 * 头像调用
	 */
	static function avatar($uid, $size) {
		global $_K;
		$_K ['i'] ++;
		$search = "<!--READ_TAG_{$_K['i']}-->";
		$_K ['block_search'] [$_K ['i']] = $search;
		$_K ['block_replace'] [$_K ['i']] = "<?php echo \"<img class=pic_$size src=\". Keke_user::instance()->get_avatar($uid,'$size').'>'?>";
		return $search;
	}
	/**
	 * 文字裁剪
	 * @param string $string
	 * @param int $length
	 * @return string
	 */
	static function cutstr($string,$length){
		global $_K;
		$_K ['i'] ++;
		$search = "<!--CUTSTR_TAG_{$_K['i']}-->";
		$_K ['block_search'] [$_K ['i']] = $search;
		$_K ['block_replace'] [$_K ['i']] = "<?php echo  Keke::cutstr($string,'$length') ?>";
		return $search;
	}
	
	static function stripvtags($expr, $statement = '') {
		$res = preg_replace ( "/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr );
		$expr = strtr($res.$statement,array("\\\""=>"\""));
		return $expr ;
	}
	
	static function readtemplate($name) {
		global $_K;
		$tpl = Cola_Tpl::tpl_exists ( $name );
		$tplfile = S_ROOT . './' . $tpl . '.htm';
		//$sub_tpls [] = $tpl;
		//var_dump($name,$tplfile);die;
		/* if (! file_exists ( $tplfile )) {
			$tplfile = strtr ( $tplfile,'/' . $_K ['template'] . '/', '/default/');
		} */
		
		$content = trim ( Cola_Tpl::sreadfile ( $tplfile ) );
		return $content;
	}
	
	//获取文件内容
	static function sreadfile($filename) {
		
		if (function_exists ( 'file_get_contents' )) {
			return  file_get_contents ( $filename );
		} elseif ($fp = fopen ( $filename, 'r' )) {
			 	$content = fread ( $fp, filesize ( $filename ) );
				fclose ( $fp );
				return $content;
		}
		
	}
	//写入文件
	static function swritefile($filename, $writetext, $openmod = 'w') {
		if(function_exists('file_put_contents')){
			return file_put_contents($filename, $writetext,LOCK_EX);
		}elseif($fp = fopen ( $filename, $openmod )) {
			flock ( $fp, 2 );
			fwrite ( $fp, $writetext );
			fclose ( $fp );
			return true;
		}
	}
	//判断字符串$haystack中是否存在字符$needle 返回第一次出现的位置   三个等号 判断绝对相等  uican 2009-12-03
	static function strexists($haystack, $needle) {
		return ! (strpos ( $haystack, $needle ) === FALSE);
	}
	
	static function tpl_exists($tplname) {
		 
		if(file_exists( S_ROOT . "views/$tplname.htm" )){
			$tpl = "views/$tplname";
		}else{
			throw new Cola_Exception('views/'.$tplname.'.htm   file is not exists,plase check');
		}
		return $tpl;
	}
	
	static function template($name) {
		global $_K;
		
		$tpl = Cola_Tpl::tpl_exists ( $name );
		 
		$objfile = S_ROOT . 'views/tpl_c/' . strtr ( $tpl,'/', '_') . '.php';
		 
		
		if(! file_exists ( $objfile ) OR ! TPL_CACHE){
			Cola_Tpl::parse_template ( $tpl );
		}

		return $objfile;
	}
	
	
	/**
	 * //子模板更新检查 
	 *
	 * @param string $subfiles 模板路径
	 * @param int $mktime 时间  
	 * @param string $tpl  当前页面模板
	 */
	static function checkrefresh($tpl, $mktime) {
		if ($tpl) {
			$tplfile = S_ROOT . './' . $tpl . '.htm';
			//(! file_exists ( $tplfile )) and $tplfile = strtr ( $tplfile,'/' . $_K ['template'] . '/', '/default/');
			$submktime = filemtime ( $tplfile );
			($submktime > $mktime) and Cola_Tpl::parse_template ( $tpl );
		}
	}
	
	//调整输出
	static function ob_out() {
		global $_K,$_lang;
		
		$content = ob_get_contents ();
		
		$preg_searchs = $preg_replaces = $str_searchs = $str_replaces = array();
		
		
		if (Cola_Request::isAjax()) {
			$preg_searchs [] = '/([\x01-\x09\x0b-\x0c\x0e-\x1f])+/';
			$preg_replaces [] = ' ';
			
			$str_searchs [] = ']]>';
			$str_replaces [] = ']]&gt;';
		}
		
		if ($preg_searchs) {
			$content = preg_replace ( $preg_searchs, $preg_replaces, $content );
		}
		if ($str_searchs) {
			$content = trim ( str_replace ( $str_searchs, $str_replaces, $content ) );
		}
		 
		Cola_Tpl::obclean ();
		(Cola_Request::isAjax()) and self::xml_out ( $content );
		
		//echo $content;

	}
	static function obclean() {
		global $_K;
		 if($_K['inajax']==1){
		 	ob_end_clean();
		 	ob_start();
		 }
		 
	}
	static function rewrite_url($pre, $para, $hot = '') {
		$str = '';
		parse_str ( $para, $joint );
	 
		$s = array_filter ( $joint );
		$url = http_build_query ( $s );
		
		$url = str_replace ( array ("do=", '&', '=' ), array ("", '-', '-' ), $url );
		 
		$hot = $hot ? "#" . $hot : '';
		return '<a href="'.$url . '.html' . $hot . '"';
	}
	static function xml_out($content) {
		
		header ( "Expires: -1" );
		header ( "Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE );
		header ( "Pragma: no-cache" );
		header ( "Content-type: application/xml; charset=".CHARSET );
		echo '<' . "?xml version=\"1.0\" encoding=\"".CHARSET."\"?>\n";
		echo "<root><![CDATA[" . trim ( $content ) . "]]></root>";
		exit ();
	}

}