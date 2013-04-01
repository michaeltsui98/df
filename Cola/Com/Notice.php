<?php

class Cola_Com_Notice
{

    /**
     *
     * @param array $config
     * @return object
     */
    public static function porxy($config = array())
    {
        if (empty($config)) $config = Cola::$_config->get('_webServicesNotice');
        return Cola_Com_WebServices::factory($config);
    }

    /**
     * @param array $head ��Ϣͷ
     * @param array $body ��Ϣ��
     * @param array $config ����
     * @return Boolean
     */
    public static function send(array $head, array $body, $config = array())
    {
        if (empty($config)) $config = Cola::$_config->get('_noticeQueue');
        return Cola_Com_Queue::factory($config)->put(json_encode(array('head' => $head, 'body' => $body)));
    }

}