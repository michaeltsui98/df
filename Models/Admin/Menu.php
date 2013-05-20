<?php

class Models_Admin_Menu extends Cola_Model
{

    protected $_table = 'menu';

    /**
     * 按父ID查找菜单子项
     * @param integer $parentid   父菜单ID
     * @param integer $with_self  是否包括他自己
     * @return array 返回用户有权限的菜单数组
     */
    public function getMenu($parentid, $with_self = 0)
    {
        try {
            $parentid = intval($parentid);
            $result = $this->sql("SELECT * FROM menu WHERE parentid={$parentid} AND display=1 ORDER BY listorder ASC;");
            if ($with_self) {
                $result2[] = $this->db->row("SELECT * FROM menu WHERE id={$parentid}");
                $result = array_merge($result2, $result);
            }

            //权限检查, 有等做缓存处理
            if ($_SESSION['user']['roleid'] == 1) return $result;
            $array = array();
            foreach ($result as $v) {
//                echo "SELECT * FROM role_priv WHERE c='{$v['c']}' AND a='{$v['a']}' AND roleid={$_SESSION['user']['roleid']} <br />";
                $r = $this->sql("SELECT * FROM role_priv WHERE c='{$v['c']}' AND a='{$v['a']}' AND roleid={$_SESSION['user']['roleid']}");
                if ($r) $array[] = $v;
            }
            return $array;
        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * 根据菜单id获取当前位置
     * @param integer $menuid 菜单id
     * @return string 返回当前位置字符串
     */
    public function getCurrentPos($id)
    {
        try {
            $data = $this->db->row("SELECT id, name, parentid FROM menu WHERE id={$id}");
            $str = '';
            if ($data['parentid']) {
                $str = $this->getCurrentPos($data['parentid']);
            }
            return $str . $data['name'] . ' > ';
        }  catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * 获取所有菜单
     * @param string $fields 要回返的字段
     */
    public function getAllMenu($fields = '*')
    {
        $data = $this->sql("SELECT {$fields} FROM menu ORDER BY listorder ASC,id DESC");
        return $data;
    }














    /**
     * 取出最新的一期目录名称和ID
     */
    public function getLatestMenuInfo()
    {
        try
        {
            $latestMenuInfoSql = "SELECT * from `menu_info` WHERE `menu_is_available`=1  ORDER BY `menu_id` DESC LIMIT 0,1";
            $latestMenuInfoResult = $this->sql($latestMenuInfoSql);
            return (array) $latestMenuInfoResult;
        }
        catch(Exception $e)
        {
            echo $e;
        }
    }


    /**
     * 取出最新的一期目录名称和ID
     */
    public function getTop5MenuInfo()
    {
        try
        {
            $latestMenuInfoSql = "SELECT * from `menu_info` WHERE `menu_is_available`=1 ORDER BY `menu_id` DESC  LIMIT 0,5";
            $latestMenuInfoResult = $this->sql($latestMenuInfoSql);
            return (array) $latestMenuInfoResult;
        }
        catch(Exception $e)
        {
            echo $e;
        }
    }

    /**
     * 期号分页取出
     */
    public function getMenusList($in_page=1, $in_limit=20)
    {
        $page = intval($in_page);
        $limit = intval($in_limit);

        try
        {
            $totalSql = "SELECT count(*) as `total_items` from `menu_info` ";
            $totalResult = $this->sql($totalSql);
            $totalItems = $totalResult[0]['total_items'];
            $totalPages = ceil($totalItems / $limit);
            if($totalPages ==0)
            {
                $totalPages =1;
            }
            if ($page > $totalItems) $page = $totalPages;
            $start = ($page - 1) * $limit;

            $menuListSql = "SELECT * from `menu_info`  ORDER BY `menu_id` DESC LIMIT {$start}, {$limit}";
            $menuListResult = $this->sql($menuListSql);

            $resultArray = array(
                'result'=>(array) $menuListResult,
                'totalItems'=>$totalItems
            );
            return (array)$resultArray;


        }
        catch(Exception $e)
        {
            echo $e;
        }
    }

    //增加期号的方法
    public function addMenu($in_menuName)
    {
        $menuName = $this->escape($in_menuName);
        $addMenuSql = "INSERT INTO `menu_info` (`menu_name`,`menu_is_available`) VALUES ('".$menuName."',1) ";
        $addMenuResult = $this->sql($addMenuSql);
        return $addMenuResult;
    }

    //单独修改有效期
    public function modifyMenuAvailable($in_menuId,$in_menuAvailable)
    {
        $menuId = intval($in_menuId);
        $menuAvailable = intval($in_menuAvailable);
        $modifyMenuAvailableSql = "UPDATE `menu_info` SET `menu_is_available` = ".$menuAvailable." WHERE `menu_id`=".$menuId." ";
        try
        {
            $modifyMenuAvailableResult = $this->sql($modifyMenuAvailableSql);
            return $modifyMenuAvailableResult;
        }
        catch(Exception $e)
        {
            echo $e;
        }
    }

    //单独修改名称
    public function modifyMenuName($in_menuId,$in_menuName)
    {
        $menuId = intval($in_menuId);
        $menuName = $this->escape($in_menuName);


        $modifyMenuAvailableSql = "UPDATE `menu_info` SET `menu_name` = '".$menuName."' WHERE `menu_id`=".$menuId." ";
        try
        {
            $modifyMenuAvailableResult = $this->sql($modifyMenuAvailableSql);
            return $modifyMenuAvailableResult;
        }
        catch(Exception $e)
        {
            echo $e;
        }
    }

    public function getSingleMenu($in_menuId)
    {
        $menuId = intval($in_menuId);
        $singleMenuSql = "SELECT * FROM `menu_info` WHERE `menu_id`=".$menuId." ";
        try
        {
            $singleResult = $this->sql($singleMenuSql);
            return (array)$singleResult;
        }
        catch(Exception $e)
        {
            echo $e;
        }
    }

    public function deleteMenus($in_menuId)
    {
        $menuId = intval($in_menuId);
        $delSql = "DELETE FROM  `menu_info` WHERE `menu_id`=".$menuId;
        try
        {
            $delResult = $this->sql($delSql);
            return $delResult;

        }
        catch(Exception $e)
        {
            echo $e;
        }

    }







}