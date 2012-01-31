<?php
/*
 * Sessions class handles user session authentification.
 * inlcudes session management.
 * This class is based on G.Schlossnagles Professional Programming in PHP 5
 *
 * @package REST_API
 * @subpackage Library
 * @since version 1.0
 */
class Session_Library {

    /*
     * @var int
     */
    private $created;

    /*
     * @var int
     */
    private $userID;

    /*
     * @var int
     */
    private $version;

    /*
     * handler for mcyrpt
     * @var  
     */
    private $hdlr;

    private static $cypher = 'blowfish';
    private static $mode = 'cfb';
    private static $key = 'sgh78HksL!34_t';

    /*
     * useful variable for defining the cookie format.
     */
    private static $cookieName = 'APIAUTH';
    private static $static_version = '1';
    
    /*
     * set the default session time to 20 minutes.
     * @var $expires Integer
     */
    private static $expires = '1200';

    /*
     * set the time to set the cookie to 10 minutes.
     * @var int
     */
    private static $timeToSet = '600';

    /*
     * @var string
     */
    private static $tab = '|';

    protected $userData;
    protected $sessionData;

    public function __construct($userID = false) {
        // @todo do something
        $this->hdlr = mcrypt_module_open(self::$cypher, '', self::$mode ,'');
        if($userID) {
            $this->userID = $userID;
            return;
        } else {
            if(array_key_exists(self::$cookieName, $_COOKIE)) {
                $buffer = $this->_unpackage($_COOKIE[self::$cookieName]);
                if(!$this->userID) {
                    throw new Exception('redirect the user.');
                }
            } else {
                throw new Exception('No Cookie Information available.');
            }
        }
    }

    public function set() {
        $cookie = $this->_package();
        setcookie(self::$cookieName, $cookie, time()+60*60*2, "/");
    }

    public function validate() {
        if(!$this->created || !$this->version || !$this->userID) {
            throw new Exception('Cookie has errors. Bad state.' . $this->created . $this->version);
        }

         if($this->version != self::$static_version) {
            throw new Exception('the version is not matching the current version.');
        }

        if(time() - $this->created > self::$expires) {
            throw new Exception('cookie has expired!');
        } else if(time() - $this->created > self::$timeToSet) {
            $this->set();
        }
    }

    public function logout() {
        setcookie(self::$cookieName, 0, 0, '/');
    }

    public function session_init($sessId) {
        session_id($sessId);
    }

    public function session_open() {
        session_start();
    }

    public function session_write($type, $val) {
        $_SESSION[$type] = $val;
    }

    public function session_update() {
        
    }

    public function session_read($type) {
        return $_SESSION[$type];
    }

    public function session_destroy() {
        
    }

    public function session_gc() {
        
    }

    public function user_info() {
        
    }

    public function destroy() {
        
    }

    protected function _package() {
        $components = array(self::$static_version, time(), $this->userID);
        $cookie = implode(self::$tab, $components);
        return $this->_encrypt($cookie);
    }

    /*
     * @param array $cookie
     */
    protected function _unpackage($cookie) {
        $buffer = $this->_decrypt($cookie);
        if($buffer) {
            list($this->version, $this->created, $this->userID) = explode(self::$tab, $buffer);
            
        } else {
            return FALSE;
        }
        if($this->version != self::$static_version || !$this->created || !$this->userID) {
            throw new Exception('_unpackage operation went bad.');
        }
    }

    protected function _encrypt($rawtxt) {
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($this->hdlr), MCRYPT_RAND);
        mcrypt_generic_init($this->hdlr, self::$key, $iv);
        $cryptxt = mcrypt_generic($this->hdlr, $rawtxt);
        mcrypt_generic_deinit($this->hdlr);
        return $iv.$cryptxt;
    }

    protected function _decrypt($cryptxt) {
        if(isset($cryptxt) && strlen($cryptxt) > 1) {
            $ivSize = mcrypt_enc_get_iv_size($this->hdlr);
            $iv = substr($cryptxt, 0, $ivSize);
            $cryptxt = substr($cryptxt, $ivSize);
            mcrypt_generic_init($this->hdlr, self::$key, $iv);
            $rawtxt = mdecrypt_generic($this->hdlr, $cryptxt);
            mcrypt_generic_deinit($this->hdlr);
            return $rawtxt;
        } else {
            #throw new Exception('_decrypt failed.');
            return;
        }
    }

    protected function reset() {
        $this->created = time();
    }
}