<?php
    $displayInfor =$this->displayInfor;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>湖北省中小学教辅资料管理平台</title>
<link href="/statics/css/right.css" rel="stylesheet" type="text/css" />
<script>
function goToUrl(leftUrl,mainUrl){
	parent.frames.leftFrame.location.href=leftUrl;
	parent.frames.mainFrame.location.href=mainUrl;
}
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" background="/statics/images/n02.jpg">&nbsp;</td>
  </tr>
</table>
<br />
<br />
<table width="90%"  border="0" cellpadding="0" cellspacing="0">
<?php
 if(!empty($displayInfor)){
     foreach($displayInfor as $value){

?>
  <tr>
    <td width="30" height="30">&nbsp;</td>
    <td><img src="/statics/images/n05.gif" width="19" height="12" /><span class="black14">

    <a href="<?php echo $value['mainUrl'];?>" target="_self"><?php echo $value['content'];?></a>

    </span>
    </td>
  </tr>
<?php
     }
 }
 ?>
</table>
</body>
</html>