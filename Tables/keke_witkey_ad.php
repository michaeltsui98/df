<?php

/** 
 * @copyright keke-tech 
 * @author Michaeltsui98 
 * @version 3.0 2013-1-14 10:09:46 
 */
final class Tables_keke_witkey_ad extends Tables_Model
{

    function __construct ()
    {
        parent::__construct('keke_witkey_ad');
        self::$pk = 'ad_id';
    }

    /**
     *
     * @return self
     */
    public static function instance ()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getAd_id ()
    {
        return self::$data['ad_id'];
    }

    public function getTarget_id ()
    {
        return self::$data['target_id'];
    }

    public function getAd_type ()
    {
        return self::$data['ad_type'];
    }

    public function getAd_name ()
    {
        return self::$data['ad_name'];
    }

    public function getAd_file ()
    {
        return self::$data['ad_file'];
    }

    public function getAd_content ()
    {
        return self::$data['ad_content'];
    }

    public function getAd_url ()
    {
        return self::$data['ad_url'];
    }

    public function getEnd_time ()
    {
        return self::$data['end_time'];
    }

    public function getListorder ()
    {
        return self::$data['listorder'];
    }

    public function getWidth ()
    {
        return self::$data['width'];
    }

    public function getHeight ()
    {
        return self::$data['height'];
    }

    public function getOn_time ()
    {
        return self::$data['on_time'];
    }

    public function setAd_id ($value)
    {
        self::$data['ad_id'] = $value;
        self::$pkVal = $value;
        return $this;
    }

    public function setTarget_id ($value)
    {
        self::$data['target_id'] = $value;
        return $this;
    }

    public function setAd_type ($value)
    {
        self::$data['ad_type'] = $value;
        return $this;
    }

    public function setAd_name ($value)
    {
        self::$data['ad_name'] = $value;
        return $this;
    }

    public function setAd_file ($value)
    {
        self::$data['ad_file'] = $value;
        return $this;
    }

    public function setAd_content ($value)
    {
        self::$data['ad_content'] = $value;
        return $this;
    }

    public function setAd_url ($value)
    {
        self::$data['ad_url'] = $value;
        return $this;
    }

    public function setEnd_time ($value)
    {
        self::$data['end_time'] = $value;
        return $this;
    }

    public function setListorder ($value)
    {
        self::$data['listorder'] = $value;
        $this;
    }

    public function setWidth ($value)
    {
        self::$data['width'] = $value;
        return $this;
    }

    public function setHeight ($value)
    {
        self::$data['height'] = $value;
        return $this;
    }

    public function setOn_time ($value)
    {
        self::$data['on_time'] = $value;
        return $this;
    }
}