<?php
/**
 * 教材专用的oauth client
 * @author    sizzflair
 * @datetime  2013/3/5
 * @modify    2013-11-05
 * @copyright Copyright (c) 2012 Wuhan Bo Sheng Education Information Co., Ltd.
 * @version 0.1
 */
/**
 * 教材线上的配置
 * APP_ID:63
 * APP_KEY:789f27b3b3e9ad4c30c7d23bda5d9d22
 * APP_SECRET:607cb09deabb98c0
 */
// header('Content-Type: text/html; charset=UTF-8');
/* 站内应用生成的APPID */
define("DD_APPID", '72');
/* APP_KEY */
define("DD_AKEY", '1265515e58684904db8f6b901c2902a2');
/* APP_SERCET */
define("DD_SKEY", '8595907a818826aa');
/* 回调地址，这个不是已经写过去了么,估计是未授权就跳，但是可能是多此一举 */
define("DD_CALLBACK_URL", 'http://dev-wenku.dodoedu.com/df/index.php/Sign/callBack');
/* 多多社区API地址 */
define("DD_API_URL", DOMAIN_NAME.'/DDApi/');

/**
 * 社区站内应用的PHP SDK
 */
class Models_DDClient
{

    private $appId = '';

    private $appKey = '';

    private $appSecret = '';

    private $callBackUrl = '';

    private $accessToken = '';

    private $refreshToken = '';

    public $http_code;

    /**
     * Contains the last API call.
     *
     * @ignore
     *
     *
     */
    public $url;

    /**
     * Set up the API root URL.
     *
     * @ignore
     *
     *
     */
    public $host = DD_API_URL;

    /**
     * Set timeout default.
     *
     * @ignore
     *
     *
     */
    public $timeout = 30;

    /**
     * Set connect timeout.
     *
     * @ignore
     *
     *
     */
    public $connecttimeout = 30;

    /**
     * Verify SSL Cert.
     *
     * @ignore
     *
     *
     */
    public $ssl_verifypeer = false;

    /**
     * Respons format.
     *
     * @ignore
     *
     *
     */
    public $format = 'json';

    /**
     * Decode returned json data.
     *
     * @ignore
     *
     *
     */
    public $decode_json = true;

    /**
     * Contains the last HTTP headers returned.
     *
     * @ignore
     *
     *
     */
    public $http_info;

    /**
     * Set the useragnet.
     *
     * @ignore
     *
     *
     */
    public $useragent = 'DDApi';

    /**
     * print the debug info
     *
     * @ignore
     *
     *
     */
    public $debug = false;

    /**
     * boundary of multipart
     *
     * @ignore
     *
     *
     */
    public static $boundary = '';

    /**
     * params of file
     *
     * @ignore
     *
     *
     */

    /**
     * 构造函数
     */
    function __construct($access_token = null, $refresh_token = null)
    {
        $this->appId = DD_APPID;
        $this->appKey = DD_AKEY;
        $this->appSecret = DD_SKEY;
        $this->callBackUrl = DD_CALLBACK_URL;
        $this->accessToken = $access_token;
        $this->refreshToken = $refresh_token;
    }

    /**
     * 获取认证连接
     *
     * @ignore
     *
     *
     */
    private function _grantAuthorizeURL()
    {
        return DD_API_URL . 'auth/authorize/';
    }

    /**
     * 请求accessToken的地址
     *
     * @ignore
     *
     *
     */
    private function _grantAccessTokenURL()
    {
        return DD_API_URL . 'auth/accesstoken/';
    }

    /**
     * 处理服务器传过来的POST
     *
     * @param
     *            $signedRequest
     * @return -1,签名算法不对应. -2,客户端签名与从服务器传过来的不一致.没有错误的话返回数组
     */
    public function parseSignedRequest($signedRequest)
    {
        list($sig, $requestUrl) = explode('.', $signedRequest, 2);
        $infoArr = base64_decode($requestUrl);
        $infoArr = json_decode($infoArr);
        $clientSig = base64_encode(hash_hmac('sha256', $infoArr->user_id, DD_SKEY, true));
        if ($infoArr->algorithm != 'HMAC-SHA256') {
            return '-1';
        } else
            if ($clientSig != $sig) {
                return '-2';
            } else {
                return $this->json_to_array($infoArr);
            }
    }

    /**
     * 获得用户的基本资料http请求
     */
    public function getUserInfo($accessToken, $refreshToken)
    {
        $infoUrl = DD_API_URL . 'user/base/?access_token=' . $accessToken .
            '&refresh_token=' . $refreshToken;
        $infoData = file_get_contents($infoUrl);
        if (isset(json_decode($infoData)->errcode) and json_decode($infoData)->errcode ==
            7) {
            /* 用刷新令牌之后来解决 */
            $newAccessToken = $this->_grantNewAccessToken($accessToken, $refreshToken);
            if ($newAccessToken) {
                $infoData = $this->getUserInfo($_SESSION['tokens']['access_token'], $_SESSION['tokens']['refresh_token']);
                return $infoData;
            } else {
                return - 1;
            }
        } else {
            $infoData = $this->json_to_array(json_decode($infoData));
            return $infoData;
        }
    }

    /**
     * 获得用户的基本资料curl请求
     *
     * @param
     *            $accessToken
     * @param
     *            $refreshToken
     * @return array
     */
    public function getUserInfoCurl($accessToken, $refreshToken)
    {
        $params = array();
        $params['access_token'] = $accessToken;
        // $params['refresh_token'] = $refreshToken;
        $response = $this->oAuthRequest(DD_API_URL . 'user/base/', 'POST', $params);
        if (isset(json_decode($response)->errcode) and json_decode($response)->errcode ==
            7) {
            /* 用刷新令牌之后来解决 */
            $newAccessToken = $this->_grantNewAccessToken($accessToken, $refreshToken);
            if ($newAccessToken) {
                $infoData = $this->getUserInfoCurl($_SESSION['tokens']['access_token'], $_SESSION['tokens']['refresh_token']);
                // return $infoData;
            } else {
                return - 1;
            }
        } else {
            $infoData = $response;
            // return $infoData;
        }
        $data_arr = json_decode($infoData, 1);
        return $data_arr['data'];
    }

    /**
     * 获得用户的全部资料http请求
     */
    public function getUserCompleteInfo($accessToken, $refreshToken)
    {
        $infoUrl = DD_API_URL . 'user/complete/?access_token=' . $accessToken .
            '&refresh_token=' . $refreshToken;
        $infoData = file_get_contents($infoUrl);
        if (isset(json_decode($infoData)->errcode) and json_decode($infoData)->errcode ==
            7) {
            /* 用刷新令牌之后来解决 */
            $newAccessToken = $this->_grantNewAccessToken($accessToken, $refreshToken);
            if ($newAccessToken) {
                $infoData = $this->getUserCompleteInfo($_SESSION['tokens']['access_token'], $_SESSION['tokens']['refresh_token']);
                return $infoData;
            } else {
                return - 1;
            }
        } else {
            $infoData = $this->json_to_array(json_decode($infoData));
            return $infoData['data'];
        }
    }

    /**
     * 获得用户详细资料curl
     *
     * @param
     *            $accessToken
     * @param
     *            $refreshToken
     * @return array
     */
    public function getUserCompleteInfoCurl($accessToken, $refreshToken)
    {
        $params = array();
        $params['access_token'] = $accessToken;
        $params['refresh_token'] = $refreshToken;
        $response = $this->oAuthRequest(DD_API_URL . 'user/complete/', 'POST', $params);
        if (isset(json_decode($response)->errcode) and json_decode($response)->errcode ==
            7) {
            /* 用刷新令牌之后来解决 */
            $newAccessToken = $this->_grantNewAccessToken($accessToken, $refreshToken);
            if ($newAccessToken) {
                $infoData = $this->getUserCompleteInfoCurl($_SESSION['tokens']['access_token'],
                    $_SESSION['tokens']['refresh_token']);
                return $infoData;
            } else {
                return - 1;
            }
        } else {
            $infoData = json_decode($response, 1);
            return $infoData['data'];
        }
    }
    /**
     * 获取主站多多社区的session 信息
     * @return mixed
     */
    public function getMainSession()
    {
        $url = DD_API_URL . 'user/getmainsession';
        //$data['refresh_token'] = $_SESSION['tokens']['refresh_token'];
        $this->updateToken();
        $data['access_token'] = $_SESSION['tokens']['access_token'];
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        return $query['data'];

    }

    /**
     * 获取用户绑定的翼学通号码
     */
    public function getUserEStudyNumber($accessToken, $refreshToken)
    {
        $infoUrl = DD_API_URL . 'user/estudynumber/?access_token=' . $accessToken .
            '&refresh_token=' . $refreshToken;
        //echo $infoUrl;
        $infoData = file_get_contents($infoUrl);
        if (isset(json_decode($infoData)->errcode) and json_decode($infoData)->errcode ==
            7) {
            /* 用刷新令牌之后来解决 */
            $newAccessToken = $this->_grantNewAccessToken($accessToken, $refreshToken);
            if ($newAccessToken) {
                $infoData = $this->getUserEStudyNumber($_SESSION['tokens']['access_token'], $_SESSION['tokens']['refresh_token']);
                return $infoData;
            } else {
                return - 1;
            }
        } else {
            $infoData = $this->json_to_array(json_decode($infoData));
            return $infoData['data'];
        }
    }


    /**
     * 使用refresh_token换取新的access_token
     *
     * @param
     *            $accessToken
     * @param
     *            $refreshToken
     * @return bool
     */
    public function _grantNewAccessToken($accessToken, $refreshToken)
    {
        if (!$accessToken and !$refreshToken) {
            return false;
        }
        $url = DOMAIN_NAME . '/DDApi/auth/newaccesstoken';
        //$infoUrl = DD_API_URL . 'auth/newaccesstoken/?access_token=' .
        // $accessToken . '&refresh_token=' . $refreshToken;
        // $infoData = file_get_contents($infoUrl);
        $params = array();
        $params['access_token'] = $accessToken;
        $params['refresh_token'] = $refreshToken;

        $response = json_decode(Cola_Com_Http::post($url, $params), 1);


        if (isset($response['errcode']) and $response['errcode']) {
            throw new Exception('error:/auth/newaccesstoken/' . var_export($params, 1) .
                var_export((array )$response, 1));
            return false;
        } else {
            if (empty($response)) {
                throw new Exception('error:_grantNewAccessToken 为空');
                return false;
            }
            if ($response['access_token']) {
                $_SESSION['tokens']['access_token'] = $response['access_token'];
                $_SESSION['tokens']['refresh_token'] = $response['refresh_token'];
            } elseif ($response['accessToken']) {
                $_SESSION['tokens']['access_token'] = $response['accessToken'];
                $_SESSION['tokens']['refresh_token'] = $response['refreshToken'];
            }
        }
        return true;
    }

    /**
     * authorize接口
     */
    public function getAuthorizeURL($inUrl, $inResponseType = 'code', $inState = null,
        $inDisplay = null)
    {
        $params = array();
        $params['client_key'] = $this->appKey;
        $params['redirect_uri'] = $inUrl;
        $params['response_type'] = $inResponseType;
        $params['state'] = $inState;
        $params['display'] = $inDisplay;
        return $this->_grantAuthorizeURL() . "?" . http_build_query($params);
    }

    /**
     * access_token接口
     *
     * 对应API：{@link /DDApi/accessToken}
     *
     * @param string $type
     *            请求的类型,可以为:code, password, token
     * @param array $keys
     *            其他参数：(目前都固定为CODE)
     *            - 当$type为code时： array('code'=>..., 'redirect_uri'=>...)
     *            - 当$type为password时： array('username'=>..., 'password'=>...)
     *            - 当$type为token时： array('refresh_token'=>...)
     * @return array
     */
    public function getAccessToken($type = 'code', $keys)
    {
        $params = array();
        $params['client_key'] = $this->appKey;
        $params['client_secret'] = $this->appSecret;
        if ($type === 'code') {
            $params['grant_type'] = 'authorization_code';
            $params['code'] = $keys['code'];
            $params['redirect_uri'] = $keys['redirectUri'];
        } else {
            throw new Exception("wrong auth type");
        }
        $response = $this->oAuthRequest($this->_grantAccessTokenURL(), 'POST', $params);
        $token = json_decode($response, true);

        if (is_array($token) && !isset($token['error'])) {
            $this->accessToken = $token['access_token'];
            $this->refreshToken = $token['refresh_token'];
        } else {
            throw new Exception("get access token failed." . $token['error']);
        }
        $ss['access_token'] = $token['access_token'];
        $ss['refresh_token'] = $token['refresh_token'];
        return $ss;
    }

    /**
     * Format and sign an OAuth / API request
     *
     * @return string
     * @ignore
     *
     *
     */
    public function oAuthRequest($url, $method, $parameters, $multi = false)
    {
        switch ($method) {

            case 'POST':
                $headers = array();
                // $parameters['access_token'] = $this->accessToken;
                if (!$multi && (is_array($parameters) || is_object($parameters))) {
                    $body = http_build_query($parameters);
                } else {
                    $body = self::build_http_query_multi($parameters);
                    $headers[] = "Content-Type: multipart/form-data; boundary=" . self::$boundary;
                }
                return $this->http($url, $method, $body, $headers);
                break;
            default:
                echo "目前只支持post方法";
        }
    }

    /**
     *
     * @ignore
     *
     *
     */
    public static function build_http_query_multi($params)
    {
        if (!$params)
            return '';

        uksort($params, 'strcmp');

        $pairs = array();

        self::$boundary = $boundary = uniqid('------------------');
        $MPboundary = '--' . $boundary;
        $endMPboundary = $MPboundary . '--';
        $multipartbody = '';

        foreach ($params as $parameter => $value) {
            if (in_array($parameter, self::$params_file) && $value{0} == '@') {
                $url = ltrim($value, '@');
                if (!empty($url)) {
                    $content = file_get_contents($url);
                    $array = explode('?', basename($url));
                    $filename = $array[0];

                    $filename = $_FILES[$parameter]['name'];
                    $multipartbody .= $MPboundary . "\r\n";
                    $mime = self::get_image_mime($url);
                    $multipartbody .= 'Content-Disposition: form-data; name="' . $parameter .
                        '"; filename="' . $filename . '"' . "\r\n";
                    $multipartbody .= "Content-Type: " . $mime . "\r\n\r\n";
                    $multipartbody .= $content . "\r\n";
                }
            } else {
                $multipartbody .= $MPboundary . "\r\n";
                $multipartbody .= 'content-disposition: form-data; name="' . $parameter . "\"\r\n\r\n";
                $multipartbody .= $value . "\r\n";
            }
        }

        $multipartbody .= $endMPboundary;
        return $multipartbody;
    }

    /**
     * Make an HTTP request
     *
     * @return string API results
     * @ignore
     *
     *
     */
    public function http($url, $method, $postfields = null, $headers = array())
    {
        $this->http_info = array();
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
        curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_ENCODING, "");
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
        curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
        curl_setopt($ci, CURLOPT_HEADER, false);

        switch ($method) {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, true);
                if (!empty($postfields)) {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                    $this->postdata = $postfields;
                }
                break;
            case 'DELETE':
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($postfields)) {
                    $url = "{$url}?{$postfields}";
                }
        }

        if (isset($this->accessToken) && $this->accessToken) {
            $headers[] = "Authorization: OAuth2 " . $this->accessToken;
        }

        $headers[] = "API-RemoteIP: " . $_SERVER['REMOTE_ADDR'];
        curl_setopt($ci, CURLOPT_URL, $url);
        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ci, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ci);
        $this->http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
        $this->http_info = array_merge($this->http_info, curl_getinfo($ci));
        $this->url = $url;

        if ($this->debug) {
            echo "=====post data======\r\n";
            var_dump($postfields);

            echo '=====info=====' . "\r\n";
            print_r(curl_getinfo($ci));

            echo '=====$response=====' . "\r\n";
            print_r($response);
        }

        curl_close($ci);
        return $response;
    }

    /**
     * Get the header info to store.
     *
     * @return int
     * @ignore
     *
     *
     */
    public function getHeader($ch, $header)
    {
        $i = strpos($header, ':');
        if (!empty($i)) {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->http_header[$key] = $value;
        }
        return strlen($header);
    }

    /**
     * 将JSON对象转化成ARRAY
     *
     * @param
     *            $obj
     * @return array
     */
    public function json_to_array($obj)
    {
        $arr = array();
        foreach ((array )$obj as $k => $w) {
            if (is_object($w))
                $arr[$k] = $this->json_to_array($w); // 判断类型是不是object
            else
                $arr[$k] = $w;
        }
        return $arr;
    }

    /**
     * 根据ID查找个人资料
     *
     * @param
     *            $accessToken
     * @param
     *            $refreshToken
     * @param
     *            $userId
     */
    public function searchUserInfo($userId)
    {
        $tokens = $_SESSION['tokens'];
        $accessToken = $tokens['access_token'];
        $refreshToken = $tokens['refresh_token'];
        $infoUrl = DD_API_URL . 'user/searchuserinfo/?access_token=' . $accessToken .
            '&refresh_token=' . $refreshToken . '&user_id=' . $userId;
        // $infoData = file_get_contents($infoUrl);
        $data['user_id'] = $userId;
        $data['access_token'] = $accessToken;
        $data['refresh_token'] = $refreshToken;
        $infoData = $this->oAuthRequest($infoUrl, 'POST', $data);
        // var_dump(json_decode($infoData));
        if (isset(json_decode($infoData)->errcode) and json_decode($infoData)->errcode ==
            7) {
            /* 用刷新令牌之后来解决 */
            $newAccessToken = $this->_grantNewAccessToken($accessToken, $refreshToken);
            if ($newAccessToken) {
                $infoData = $this->searchUserInfo($accessToken, $refreshToken, $userId);
                return $infoData;
            } else {
                return - 1;
            }
        } else {
            $infoData = json_decode($infoData, 1);

            return $infoData['data'];
        }
    }
    /**
     * 不登录取用户信息
     * @param string $uid
     */
    function viewUserInfo($uid)
    {
        $url = DOMAIN_NAME . '/DDApi/user/viewuserinfo';
        $data['app_key'] = DD_AKEY;
        $data['user_id'] = $uid;
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        if (!$query['errcode']) {
            return $query['data'];
        }
        return $query;
    }

    /**
     * 添加问题
     *
     * @param array $data            
     */
    public function addQuestion($data)
    {
        $url = DOMAIN_NAME . '/DDApi/question/addquestion';

        // 更新token
        $this->_grantNewAccessToken($_SESSION['tokens']['access_token'], $_SESSION['tokens']['refresh_token']);
        $data['access_token'] = $_SESSION['tokens']['access_token'];

        $query = json_decode(Cola_Com_Http::post($url, $data), 1);

        return $query['data'];
    }

    /**
     * 获取教材信息
     *
     * @param string $uid
     *            必要参数是uid
     * @return Ambigous <string, mixed, multitype:unknown mixed string number >
     */
    public function getSchoolInfo($uid)
    {
        $url = DOMAIN_NAME . '/DDApi/school/schoolinfo';
        $data['user_id'] = $uid;
        // 更新token
        $this->_grantNewAccessToken($_SESSION['tokens']['access_token'], $_SESSION['tokens']['refresh_token']);
        $data['access_token'] = $_SESSION['tokens']['access_token'];

        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        return $query['data'];
    }

    /**
     * 添加标签
     *
     * @param array $data
     *            target_id,target,tags_array,creater_id
     * @return mixed
     */
    function add_tag($data)
    {
        $url = DOMAIN_NAME . '/DDApi/tag/updatetagrelation';
        // 更新token
        /* $this->_grantNewAccessToken($_SESSION['tokens']['access_token'],
        $_SESSION['tokens']['refresh_token']); */
        $this->getToken();
        /*  $data['accessToken']= $_SESSION['tokens']['access_token'];
        $data['refreshToken']= $_SESSION['tokens']['refresh_token']; */
        /* $_SESSION['tokens']['access_token'] = $token['accessToken'];
        $_SESSION['tokens']['refresh_token'] = $token['refreshToken']; */
        $data['access_token'] = $_SESSION['tokens']['access_token'];

        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        if ($query['errcode']) {
            throw new Exception($query['msg']);
        }
        return $query['data'];
    }

    function get_tag($target_id, $target)
    {
        $key = Cola_Model::init()->cache_key('get_tag', func_get_args());
        $query = Cola_Model::init()->cache()->get($key);
        if (!$query) {
            $url = DOMAIN_NAME . '/DDApi/tag/gettagrelation';
            $this->updateToken();
            $data['access_token'] = $_SESSION['tokens']['access_token'];
            $data['target_id'] = $target_id;
            $data['target'] = $target;
            $query = json_decode(Cola_Com_Http::post($url, $data), 1);
            Cola_Model::init()->cache()->set($key, $query);
        }
        return $query['data'];
    }

    /**
     * 刷新token
     */
    public function updateToken()
    {
        $this->_grantNewAccessToken($_SESSION['tokens']['access_token'], $_SESSION['tokens']['refresh_token']);
    }

    /**
     * 删除标签
     *
     * @param array $data            
     *
     * @return mixed
     */
    function del_tag($data)
    {
        $url = DOMAIN_NAME . '/DDApi/tag/deltagrelation';
        // 更新token
        $this->updateToken();
        $data['access_token'] = $_SESSION['tokens']['access_token'];
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        return $query['data'];
    }


    function push_msg($data)
    {
        $url = DOMAIN_NAME . '/DDApi/message/pushmessagebycustom';
        // 更新token
        $this->updateToken();
        $data['access_token'] = $_SESSION['tokens']['access_token'];
        //var_dump($data);
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        //var_dump($query);
        return $query['status'];
    }

    /**
     * 获取网盘信息
     *
     * @param string $uid            
     * @return mixed
     */
    function get_disk_info($uid)
    {
        $url = DOMAIN_NAME . '/DDApi/disk/getdiskinfo';
        // 更新token
        $this->updateToken();
        $data['access_token'] = $_SESSION['tokens']['access_token'];
        $data['obj_id'] = $uid;
        // $query = $this->oAuthRequest($url, 'POST', $data);
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);

        return $query['data'];
    }

    /**
     * 添加文件到 网盘
     *
     * @param int $disk_id            
     * @param string $user_id            
     * @param string $file_key            
     * @param int $file_ori_size            
     * @param string $file_name            
     * @param string $file_ext            
     * @param int $dir_id            
     * @return mixed $disk_id,$file_id
     */
    function add_disk_file($disk_id, $user_id, $file_key, $file_ori_size, $file_name,
        $file_ext, $dir_id = 0)
    {
        $url = DOMAIN_NAME . '/DDApi/disk/adddiskfile';
        // 更新token
        $this->updateToken();
        $data['access_token'] = $_SESSION['tokens']['access_token'];
        $data['dir_id'] = $dir_id;
        $data['disk_id'] = $disk_id;
        $data['user_id'] = $user_id;
        $data['file_key'] = $file_key;
        $data['file_ori_size'] = $file_ori_size;
        $data['file_name'] = $file_name;
        $data['file_ext'] = $file_ext;
        $data['is_share'] = 1;
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        return $query['data'];
    }
    /**
     * 更新网盘信息
     * @param int $disk_id
     * @param int $file_id
     * @param array $data
     * @return mixed
     */
    function update_disk_file($disk_id, $file_id, $data)
    {
        $url = DOMAIN_NAME . '/DDApi/disk/updatediskfile';
        // 更新token
        $this->updateToken();
        $data['access_token'] = $_SESSION['tokens']['access_token'];
        $data['disk_id'] = $disk_id;
        $data['file_id'] = $file_id;
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        return $query['data'];
    }

    /**
     * 获取网盘文件信息
     *
     * @param int $disk_id            
     * @param int $file_id            
     * @return mixed
     */
    function get_disk_file($disk_id, $file_id)
    {
        $url = DOMAIN_NAME . '/DDApi/disk/getdiskfile';
        // 更新token
        $this->updateToken();
        $data['access_token'] = $_SESSION['tokens']['access_token'];
        $data['disk_id'] = $disk_id;
        $data['file_id'] = $file_id;
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        return $query['data'];
    }
    /**
     * 删除网盘文件
     * @param string $uid
     * @param int $disk_id
     * @param int $file_id
     * @return mixed
     */
    function del_disk_file($uid, $disk_id, $file_id)
    {
        $url = DOMAIN_NAME . '/DDApi/disk/delfile';
        // 更新token
        $this->updateToken();
        $data['access_token'] = $_SESSION['tokens']['access_token'];
        $data['uid'] = $uid;
        $data['disk_id'] = $disk_id;
        $data['file_id'] = $file_id;
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        return $query['data'];
    }
    /**
     * 获取小站信息,公共接口，不需要token
     * @param     $elementId 组件ID
     * @param     $elementType 组件类型： Blog | Album| Forum
     * @param int $limit 获取的条数
     * @return Ambigous <string, mixed, multitype:unknown mixed string number >
     */
    public function getSiteInfo($elementId = '72662181', $type = 'Forum', $limit =
        10)
    {

        $url = DOMAIN_NAME . '/DDApi/site/getsiteelementdata';
        $data['element_id'] = $elementId;
        $data['element_type'] = $type;
        $data['limit'] = $limit;
        $query = json_decode(Cola_Com_Http::post($url, $data), 1);
        return $query['data'];
    }
    /**
     * 网站从主站登录后如果access_token 这个方法可以取到access_token
     * @return mixed
     */
    public function getSiteLogined()
    {

        $url = DOMAIN_NAME . '/DDApi/auth/siteloginedauthorize';
        $data['client_key'] = $this->appKey;
        $data['user_id'] = $_SESSION['user']['user_id'];
        $data['sid'] = session_id();
        //var_dump($data);
        //$res = Cola_Com_Http::post($url, $data);

        $query = json_decode(Cola_Com_Http::post($url, $data), 1);

        $code = $query['data']['code'];

        $keys = array('code' => $code, 'redirectUri' => DD_CALLBACK_URL);
        $_SESSION['tokens'] = $this->getAccessToken('code', $keys);
        return $query['code'];
    }
    /**
     * 基于client 模式取accestoken
     */
    public function getToken()
    {
        $count = models_Sch_Oauth::init()->checkOauth();
        if ($count == 1) {
            $url = DD_API_URL . 'auth/grantaccesstokenbyclientkey';
            $tokenInfo = Cola_Com_Http::post($url, array('app_key' => DD_AKEY));
            $token = (array )json_decode($tokenInfo, 1);
            if ($token['errcode'] == 0) {
                $data['accessToken'] = $token['access_token'];
                $data['refreshToken'] = $token['refresh_token'];
                $data['expires_in'] = $token['expires_in'];
                models_Sch_Oauth::init()->add($data);
            }
        } else if ($count == 3) {
                //令牌未过期
                $data = models_Sch_Oauth::init()->view();
                 
        }
        $_SESSION['tokens']['access_token'] = $data['accessToken'];
        $_SESSION['tokens']['refresh_token'] = $data['refreshToken'];
        return $data;
    }
    /**
     * 
     * @param string $api_name 'disk/getfilelist'
     * @param array $data  参数
     * @throws Exception
     * @return mixed
     */
    public function getDataByApi($api_name, array $data,$is_debug=false)
    {
        if (!$api_name) {
            throw new Exception("error:$api_name.不存在");
        }
        $token = $this->getToken();

        $url = DOMAIN_NAME . '/DDApi/' . $api_name;
        $data += array('access_token' => $token['accessToken'], 'refresh_token' => $token['refreshToken']);
        //$data['access_token'] = $_SESSION['tokens']['access_token'];
        //var_dump(Cola_Com_Http::post($url, $data));die;
        $res = Cola_Com_Http::post($url, $data);
        //print_r($res);
        if($is_debug){
            echo '<pre>';
            var_dump(func_get_args());
            var_dump($url,$data);
            var_dump($res);
        }
        $query = (array )json_decode($res, 1);
        //var_dump($query);
        if (isset($query['errcode']) and $query['errcode']) {
            throw new Exception("error:$api_name." . var_export($data, 1) . var_export($query,
                1) . $res);
        }
        return $query;

    }
    /**
     * 添加文件到网盘
     * @param int $disk_id
     * @param int $dir_id
     * @param string $file 文件物理路径
     * @param string $obj_id  uid,class_id,school_id  //用来验证数据一致性的
     * @throws Exception
     * @return mixed
     */
    public function filePostSchoolDisk($disk_id, $dir_id, $file, $obj_id, $file_name)
    {
        $token = $this->getToken();
        $data = array(
            'disk_id' => $disk_id,
            'dir_id' => $dir_id,
            'file' => '@' . $file,
            'obj_id' => $obj_id,
            'file_name' => $file_name,
            'is_share' => 1);
        $data += array('access_token' => $token['accessToken'], 'refresh_token' => $token['refreshToken']);
        $url = DOMAIN_NAME . '/DDApi/disk/addschoolfile';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        curl_close($ch);
        $query = json_decode($result, 1);
        
        if (isset($query['errcode']) && $query['errcode']>0) {
            throw new Exception("error:disk/addschoolfile." . var_export($data, 1) .
                var_export($query, 1));
        }
        return $query;
    }
    /**
     * 取文库的文件列表
     * @param int $school_id
     * @param int $role_id 1学生,2老师,3家长
     * @param int $type 文档类型: 1教案，2课件，3习题 
     * @param int $limit
     * @return Ambigous <string, mixed, multitype:unknown mixed string number >
     */
    function getDocListByWenku($school_id,$role_id,$limit=10,$type=0){
        $key = Cola_ModelPlus::init()->func_cache_key(__FUNCTION__,func_get_args());
        $base = models_Sch_Base::init();
        $data = $base->_cache->get($key);
       // var_dump($data);die;
        if($data['data']){
            return $data;
        } 

        $url = HTTP_WENKU.'Interfaces_Doc/getDocListBySchool';
        $params['school_id']=$school_id;
        $params['role_id']=$role_id;
        $params['limit']=$limit;
        $params['app_key']=DD_AKEY;
        $params['type']=$type;
        //var_dump($url,$params);
        $data =  Cola_Com_Http::post($url, $params);
        //var_dump($data);die;
        if($data['data']){
        	$base->_cache->set($key,$data,3600);
        }
        
        return $data;
    }


}
