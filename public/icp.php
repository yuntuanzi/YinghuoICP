<?php
require_once '../app/config/function.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

$icpInfo = null;
if (!empty($keyword)) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM icp_records WHERE icp_number = :keyword OR site_domain = :keyword LIMIT 1");
        $stmt->execute([':keyword' => $keyword]);
        $icpInfo = $stmt->fetch();
        
        if ($icpInfo && ($icpInfo['status'] === 'pending' || $icpInfo['status'] === 'rejected')) {
            header("Location: guide.php?keyword=" . urlencode($icpInfo['icp_number']));
            exit;
        }
    } catch (PDOException $e) {
        $icpInfo = null;
    }
}

$defaultTitle = '备案信息查询';
$defaultIcpNumber = '未找到备案';
$defaultSiteTitle = '备案跑丢啦';
$defaultDescription = '未找到相关备案信息';

include('header.php');

if (isset($_POST['generate_certificate']) && $icpInfo) {
    $siteTitle = htmlspecialchars($icpInfo['site_title'] ?? $defaultSiteTitle);
    $siteDomain = htmlspecialchars(str_replace("\n", ", ", $icpInfo['site_domain'] ?? ''));
    $icpNumber = htmlspecialchars($icpInfo['icp_number'] ?? $defaultIcpNumber);
    $owner = htmlspecialchars($icpInfo['owner'] ?? '未知');
    $updateTime = htmlspecialchars($icpInfo['update_time'] ?? '未知');
    
    $statusText = '未知状态';
    $statusClass = '';
    if (isset($icpInfo['status'])) {
        switch ($icpInfo['status']) {
            case 'approved':
                $statusText = '审核通过';
                $statusClass = 'status-approved';
                break;
            case 'pending':
                $statusText = '待审核';
                break;
            case 'rejected':
                $statusText = '审核驳回';
                break;
        }
    }
    
    $currentDate = date('Y年m月d日');
    
    $certificateHTML = <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$sitename}虚拟备案证书</title>
    <link rel="stylesheet" href="static/css/certificate.css">
</head>
<body>
    <div class="certificate-modal">
        <button class="close-modal" onclick="window.history.back()">×</button>
        <div class="certificate-wrapper">
            <div class="certificate">
                <div class="certificate-content">
                    <div class="certificate-header">
                        <h1 class="certificate-title">{$shortname}ICP虚拟备案证书</h1>
                        <p class="certificate-subtitle">Virtual ICP Filing Certificate</p>
                    </div>
                    <div class="certificate-body">
                        <table class="certificate-table">
                            <tr>
                                <th>网站名称</th>
                                <td>{$siteTitle}</td>
                            </tr>
                            <tr>
                                <th>网站域名</th>
                                <td>{$siteDomain}</td>
                            </tr>
                            <tr>
                                <th>备案号码</th>
                                <td>{$shortname}ICP备{$icpNumber}号</td>
                            </tr>
                            <tr>
                                <th>所有者</th>
                                <td>{$owner}</td>
                            </tr>
                            <tr>
                                <th>更新时间</th>
                                <td>{$updateTime}</td>
                            </tr>
                            <tr>
                                <th>审核状态</th>
                                <td><span class="{$statusClass}">{$statusText}</span></td>
                            </tr>
                        </table>
                        <p class="certificate-remark">经审核，该网站符合{$shortname}ICP备案要求，特发此证</p>
                    </div>
                    <div class="certificate-footer">
                        <div class="certificate-issuer">{$shortname}ICP备案中心</div>
                        <div class="certificate-date">{$currentDate}</div>
                    </div>
                </div>
            </div>
            <div class="certificate-actions">
                <button class="download-btn" onclick="downloadCertificate()">下载证书</button>
                <button class="close-btn" onclick="window.history.back()">关闭</button>
            </div>
        </div>
    </div>
    <script>
        function downloadCertificate() {
            const certificate = document.querySelector('.certificate');
            html2canvas(certificate, {
                scale: 2,
                logging: false,
                useCORS: true,
                allowTaint: true
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = '{$shortname}ICP备案证书_{$icpNumber}.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }
        document.body.style.overflow = 'hidden';
    </script>
    <script src="static/js/html2canvas.min.js"></script>
</body>
</html>
HTML;

    echo $certificateHTML;
    exit;
}

?>

<link rel="stylesheet" href="static/css/icp.css">
<body>
    
    <div class="icp-container">
        <header class="header">
            <h1><?php echo htmlspecialchars($shortname ?? ''); ?>ICP备案信息查询系统</h1>
            <p></p>
        </header>

        <?php if ($icpInfo): ?>
        <div class="icp-card">
            <h2 class="icp-title">备案信息公示</h2>
            
            <table class="icp-table">
                <tr>
                    <th>网站名称</th>
                    <td><?php echo htmlspecialchars($icpInfo['site_title'] ?? $defaultSiteTitle); ?></td>
                </tr>
                <tr>
                    <th style="vertical-align: middle;">网站域名</th>
                    <td>
                        <?php if (!empty($icpInfo['site_domain'])): ?>
                            <?php 
                            $domains = explode("\n", $icpInfo['site_domain']);
                            foreach ($domains as $domain): 
                                $domain = trim($domain);
                                if (!empty($domain)): ?>
                                    <a href="https://<?php echo htmlspecialchars($domain); ?>" class="domain-link" target="_blank">
                                        <?php echo htmlspecialchars($domain); ?>
                                    </a><br>
                                <?php endif; 
                            endforeach; ?>
                        <?php else: ?>
                            未提供域名
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>网站描述</th>
                    <td><?php echo htmlspecialchars(!empty($icpInfo['site_description']) ? $icpInfo['site_description'] : '暂无描述'); ?></td>
                </tr>
                <tr>
                    <th>备案号码</th>
                    <td>
                        <?php 
                        $icpNumber = $icpInfo['icp_number'] ?? $defaultIcpNumber;
                        if (strpos($icpNumber, '-') !== false) {
                            list($mainNum, $subNum) = explode('-', $icpNumber, 2);
                            echo htmlspecialchars($shortname ?? '') . 'ICP备' . htmlspecialchars($mainNum) . '号-' . htmlspecialchars($subNum);
                        } else {
                            echo htmlspecialchars($shortname ?? '') . 'ICP备' . htmlspecialchars($icpNumber) . '号';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>所有者</th>
                    <td><?php echo htmlspecialchars($icpInfo['owner'] ?? '未知'); ?></td>
                </tr>
                <tr>
                    <th>更新时间</th>
                    <td><?php echo htmlspecialchars($icpInfo['update_time'] ?? '未知'); ?></td>
                </tr>
                <tr>
                    <th>状态</th>
                    <td>
                        <?php 
                        $statusClass = '';
                        $statusText = '未知状态';
                        if (isset($icpInfo['status'])) {
                            switch ($icpInfo['status']) {
                                case 'approved':
                                    $statusClass = 'approved';
                                    $statusText = '审核通过';
                                    break;
                                case 'pending':
                                    $statusClass = 'pending';
                                    $statusText = '待审核';
                                    break;
                                case 'rejected':
                                    $statusClass = 'rejected';
                                    $statusText = '审核驳回';
                                    break;
                            }
                        }
                        ?>
                        <span class="status <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                        <?php if (!empty($adminemail)): ?>
                        <a href="mailto:<?php echo htmlspecialchars($adminemail); ?>" class="feedback-link">反馈</a>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            
            <div class="button-container">
                <form method="post" style="display: inline;" id="certificate-form">
                    <input type="hidden" name="generate_certificate" value="1">
                    <button type="button" class="action-btn action-btn-primary certificate-icon" onclick="checkDevice()">
                        证书生成
                    </button>
                </form>
                <a href="guide.php?keyword=<?php echo urlencode($icpInfo['icp_number'] ?? ''); ?>" class="action-btn action-btn-secondary code-icon" target="_blank">
                    对接代码
                </a>
            </div>
            
            <div class="mascot">
                哇，是谁家的小可爱？
            </div>
        </div>
    <?php else: ?>
<div class="icp-card">
    <h2 class="icp-title">备案信息详情</h2>
    <p class="no-result"><?php echo empty($keyword) ? '请输入备案号或域名进行查询' : '备案跑丢啦，未找到相关备案信息'; ?></p>
    <div class="button-container">
        <a href="search.php" class="action-btn action-btn-primary search-icon">
            返回查询
        </a>
    </div>
</div>
<?php endif; ?>
    </div>
    
<div class="fixed bottom-8 right-8 z-50">
    <button id="back-to-top" class="w-14 h-14 bg-pink-600 hover:bg-pink-500 rounded-full flex items-center justify-center text-white shadow-lg transition-all opacity-0 invisible transform translate-y-4">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>
</div>
    <div class="footer-spacer" style="height: 8rem;"></div>
    <script>
    function checkDevice() {
        if (window.innerWidth < 768) {
            alert('对不起，请在电脑端访问并生成证书');
        } else {
            document.getElementById('certificate-form').submit();
        }
    }
    </script>
    <?php include('footer.php'); ?>
</body>
</html>