<?
require_once 'db.php';

try {
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("数据库连接失败: " . $e->getMessage());
}

function getSiteSettings() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM web_settings LIMIT 1");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getCustomContents() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM custom_contents LIMIT 1");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$siteSettings = getSiteSettings();

$customcontents = getCustomContents();

if(!$siteSettings) {
    die("无法获取站点设置，请检查数据库或文件权限配置");
}

function getSmtpSettings() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT smtp_user, smtp_host, smtp_port, smtp_pass FROM system_settings LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('[' . date('Y-m-d H:i:s') . '] PDO Error: ' . $e->getMessage() . "\n", 3, '../app/logs/db_error.log');
        return false;
    }
}

$sitename = $siteSettings['site_name'];
$maintitle = $siteSettings['main_title'];
$subtitle = $siteSettings['sub_title'];
$logourl = $siteSettings['logo_url'];
$shortname = $siteSettings['short_name'];
$sitedomain = $siteSettings['site_domain'];
$adminemail = $siteSettings['admin_email'];
$globalcss = $customcontents['global_css'];
$globaljs = $customcontents['global_js'];
$headerhtml = $customcontents['header_html'];

class TAuth
{
    private $authUrl = 'https://auth.xn--kiv.fun/api/Authorize';

    private $app_code = 'TuanICP37';

    private $error_msg = '未知错误';

    private $ip;

    private $domain;

    private $auth_key;

    private $debugInfo = [];

    private $cacheDuration = 86400;

    private $encryptionKey = 'TuanICP3777';

    private $signatureKey = 'TuanICP3777';

    public function __construct()
    {
        $this->auth_key = $this->getCache('auth_key') ?? '';
        $this->ip = $this->getIp();
        $this->domain = $this->getDomain();
    }

    public function setCacheDuration(int $seconds): void
    {
        $this->cacheDuration = $seconds;
    }

    public function getCacheDuration(): int
    {
        return $this->cacheDuration;
    }

    public function activeAuth($auth_key = ''): bool
    {
        if (!empty($auth_key)) {
            $this->auth_key = $auth_key;
        }

        $data = [
            'app_code' => $this->app_code,
            'ip' => $this->ip,
            'domain' => $this->domain,
            'auth_key' => $this->auth_key,
        ];

        $response = $this->curl_request($this->authUrl . '/authVerify', $data);
        $res = json_decode($response, true);

        $this->debugInfo = [
            'request_url' => $this->authUrl . '/authVerify',
            'request_data' => $data,
            'response_raw' => $response,
            'response_parsed' => $res,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        if (!$res) {
            $this->error_msg = "遇到了点小问题，刷新试试: " . substr($response, 0, 500);
            return false;
        }

        if ($res['code'] == 1 && isset($res['data']['status']) && $res['data']['status'] == 'success') {
            if (!empty($this->auth_key)) {
                $this->setCache('auth_key', $this->auth_key, 0);
            }

            $cacheKey = md5($this->ip . $this->app_code . $this->domain);
            $end_time = strtotime($res['data']['end_time']);
            $current_time = time();
            $remaining_time = $end_time - $current_time;
            $cache_duration = ($remaining_time > $this->cacheDuration) ? $this->cacheDuration : 86400;
            
            $this->setCache($cacheKey, $res['data'], $cache_duration);
            return true;
        }

        $this->error_msg = $res['msg'] ?? ($res['message'] ?? '授权验证失败');
        return false;
    }

    public function getAuthStatus(): bool
    {
        $cacheKey = md5($this->ip . $this->app_code . $this->domain);
        $auth_info = $this->getCache($cacheKey);

        if (empty($auth_info)) {
            return $this->activeAuth();
        }

        $current_time = time();
        $end_time = strtotime($auth_info['end_time']);
        
        if ($current_time >= $end_time || !isset($auth_info['status']) || $auth_info['status'] != 'success') {
            $this->deleteCache($cacheKey);
            return $this->activeAuth();
        }
        
        return true;
    }

    public function getAuthInfo(): array
    {
        $cacheKey = md5($this->ip . $this->app_code . $this->domain);
        return $this->getCache($cacheKey) ?: [];
    }

    public function cleanAuth(): bool
    {
        $cacheKey = md5($this->ip . $this->app_code . $this->domain);
        $this->deleteCache($cacheKey);
        $this->deleteCache('auth_key');
        return true;
    }

    public function getErrorMsg(): string
    {
        return $this->error_msg;
    }

    public function getDebugInfo(): array
    {
        return $this->debugInfo;
    }

    private function getDomain(): string
    {
        $host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '';
        
        $host = preg_replace('/^https?:\/\//i', '', $host);
        
        $host = preg_replace('/:\d+$/', '', $host);
        
        if (preg_match('/[^\x00-\x7F]/', $host)) {
            if (function_exists('idn_to_ascii')) {
                $host = idn_to_ascii($host, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
            } else {
                $host = rawurlencode($host);
            }
        }
        
        return strtolower(trim($host));
    }

    private function getIp(): string
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'] 
            ?? $_SERVER['HTTP_X_FORWARDED_FOR'] 
            ?? $_SERVER['REMOTE_ADDR'] 
            ?? '127.0.0.1';

        if (strpos($ip, ',') !== false) {
            $ips = explode(',', $ip);
            $ip = trim($ips[0]);
        }

        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '127.0.0.1';
    }

    private function encryptData($data): string
    {
        $iv = random_bytes(16);
        $encrypted = openssl_encrypt(
            serialize($data),
            'AES-256-CBC',
            hash('sha256', $this->encryptionKey),
            OPENSSL_RAW_DATA,
            $iv
        );
        
        if ($encrypted === false) {
            throw new RuntimeException('加密失败: ' . openssl_error_string());
        }
        
        $signature = hash_hmac('sha256', $encrypted, $this->signatureKey);
        
        return base64_encode($iv . $encrypted . $signature);
    }

    private function decryptData($encryptedData)
    {
        $data = base64_decode($encryptedData);
        if (strlen($data) < (16 + 64)) {
            throw new RuntimeException('无效的加密数据');
        }
        
        $iv = substr($data, 0, 16);
        $encrypted = substr($data, 16, -64);
        $signature = substr($data, -64);
        
        $expectedSignature = hash_hmac('sha256', $encrypted, $this->signatureKey);
        if (!hash_equals($expectedSignature, $signature)) {
            throw new RuntimeException('签名验证失败');
        }
        
        $decrypted = openssl_decrypt(
            $encrypted,
            'AES-256-CBC',
            hash('sha256', $this->encryptionKey),
            OPENSSL_RAW_DATA,
            $iv
        );
        
        if ($decrypted === false) {
            throw new RuntimeException('解密失败: ' . openssl_error_string());
        }
        
        return unserialize($decrypted);
    }

private function setCache($key, $value, $expire = 0): bool
{
    $cacheDir = __DIR__ . '/../cache/';
    if (is_dir($cacheDir)) {
        array_map('unlink', glob($cacheDir . '*.cache'));
    }
        $cacheDir = __DIR__ . '/../cache/';
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }
        
        $cacheFile = $cacheDir . '/' . md5($key) . '.cache';
        
        try {
            $data = [
                'expire' => $expire > 0 ? time() + $expire : 0,
                'data' => $value
            ];
            
            $encryptedData = $this->encryptData($data);
            return file_put_contents($cacheFile, $encryptedData, LOCK_EX) !== false;
        } catch (Exception $e) {
            $this->error_msg = '缓存加密失败: ' . $e->getMessage();
            return false;
        }
    }

    private function getCache($key)
    {
        $cacheFile = __DIR__ . '/../cache/' . md5($key) . '.cache';
        
        if (!file_exists($cacheFile)) {
            return null;
        }
        
        try {
            $encryptedData = file_get_contents($cacheFile);
            $data = $this->decryptData($encryptedData);
            
            if (!isset($data['expire'], $data['data'])) {
                unlink($cacheFile);
                return null;
            }
            
            if ($data['expire'] > 0 && $data['expire'] < time()) {
                unlink($cacheFile);
                return null;
            }
            
            return $data['data'];
        } catch (Exception $e) {
            if (file_exists($cacheFile)) {
                unlink($cacheFile);
            }
            $this->error_msg = '缓存解密失败: ' . $e->getMessage();
            return null;
        }
    }

    private function deleteCache($key): bool
    {
        $cacheFile = __DIR__ . '/../cache/' . md5($key) . '.cache';
        return file_exists($cacheFile) ? unlink($cacheFile) : true;
    }

    private function curl_request($url, $data = [], $method = 'POST')
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['server: 1']);
        
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        } elseif (!empty($data)) {
            $url .= '?' . http_build_query($data);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            $this->error_msg = 'CURL错误: ' . curl_error($ch);
            curl_close($ch);
            return false;
        }
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode >= 400) {
            $this->error_msg = "HTTP错误: {$httpCode}";
            curl_close($ch);
            return false;
        }
        
        curl_close($ch);
        return $response;
    }
}
