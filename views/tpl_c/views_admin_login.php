<?php Cola_Tpl::checkrefresh('views/admin/login', '1369102266' );?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>湖北省中小学教辅资料管理平台-登录页面</title>
        <link href="<?php echo BASE_PATH;?>/statics/css/public.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BASE_PATH;?>/statics/css/login.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div id="wrapper">
            <div id="header">
                <div class="header_r float_r">
                    <a href="/" title="网站首页">网站首页</a>　｜　<a href="http://jcjf.e21.cn/index.php/user/article/?html=http://cms.e21.cn/html/2012/09-17/1347864216119442816.htm" target='_blank' title="帮助">帮助</a>
                </div>
                <div class="logo float_l">
                    <img src="<?php echo BASE_PATH;?>/statics/images/login_logo.gif" alt="湖北省教育辅材征订意向管理平台" />
                </div>
            </div>

            <div id="contentBox">
                <div class="sidebar float_l">
                    <img src="<?php echo BASE_PATH;?>/statics/images/login_banner.jpg" alt="" />
                    <ul>
                        <li>湖北省教材教辅征订意向管理平台是对湖北省内中小学的教辅材料征订情况进行
                            跟踪统计和监督管理，实现教辅材料征订规范化的平台。</li>
                        <li>湖北省教材教辅征订意向管理平台是对湖北省内中小学的教辅材料征订情况进行
                            跟踪统计和监督管理，实现教辅材料征订规范化的平台。</li>
                    </ul>
                </div>
                <div class="content float_r">
                    <h2>欢迎登录湖北省教材教辅征订网</h2>
                    <form name="myform" action="/index.php/user/login" method="post">
                        <table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>用户名：</td>
                                <td><input type="text" name="username"  size="20" /></td>
                            </tr>
                            <tr>
                                <td>密　码：</td>
                                <td><input type="password" name="password" size="20" /></td>
                            </tr>
                            <tr>
                                <td>验证码：</td>
                                <td><input type="text" name="code" size="8" /> <img width="78px" height="34px" id="code_img" onclick='this.src=this.src+"/"+Math.random()' src="<?php echo BASE_PATH;?>/index.php/Admin_Login/Captcha" alt="验证码" title="点击更换验证码" /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><a class="hui" href="javascript:document.getElementById('code_img').src='<?php echo BASE_PATH;?>/index.php/Admin_Login/Captcha/time/'+Math.random();void(0);">看不清楚，换一张</a></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="checkbox" name="checkbox" id="checkbox" class="loginCheckbox" />
                                    <label for="checkbox">下次自动登录</label></td>
                            </tr>
                            <tr>
                                <td height="45" colspan="2"><input type="submit" name="button" id="button" value="" class="loginButton" />
                                    <a href="#" title="忘记密码？">忘记密码？</a></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
