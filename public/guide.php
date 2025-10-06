<?php
require_once '../app/config/function.php';
$page = 'guide';
include('header.php');
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

$record = null;
$domain = '';
$error = '';

if (!empty($keyword)) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM icp_records WHERE icp_number = :keyword OR site_domain = :keyword");
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $stmt = $pdo->query("SELECT site_domain FROM web_settings LIMIT 1");
            $web_settings = $stmt->fetch(PDO::FETCH_ASSOC);
            $domain = $web_settings['site_domain'] ?? 'yourdomain.com';
        } else {
            $error = '未找到该备案号的记录，或备案信息已经注销';
        }
    } catch (PDOException $e) {
        $error = '查询出错: ' . $e->getMessage();
    }
} else {
    $error = '请输入有效的备案号或域名';
}
?>
    <link rel="stylesheet" href="static/css/guide.css">
<body>
    <div class="guide-container">

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <p><?= htmlspecialchars($error) ?></p>
                <p><a href="index.php" class="nav-link">返回首页重新查询</a></p>
            </div>
        <?php elseif ($record): ?>
            <div class="suspension-guide">
                <div class="guide-header">
                    <h2>备案悬挂引导</h2>
                    <p>请按照要求将备案信息悬挂至您的网站</p>
                </div>
                
                <div class="guide-body">
                    <h3>您的备案进度：</h3>
                    <div class="status-badge status-<?= $record['status'] ?>">
                        <?php 
                            switch($record['status']) {
                                case 'approved': echo '审核通过'; break;
                                case 'pending': echo '待审核'; break;
                                case 'rejected': echo '审核驳回'; break;
                            }
                        ?>
                    </div>
                    
                    <h3>您的备案信息</h3>
                    <p class="info-text">备案号: <strong>
                        <?php 
                        if (strpos($record['icp_number'], '-') !== false) {
                            list($mainNum, $subNum) = explode('-', $record['icp_number'], 2);
                            echo htmlspecialchars($mainNum) . '号-' . htmlspecialchars($subNum);
                        } else {
                            echo htmlspecialchars($record['icp_number']);
                        }
                        ?>
                    </strong></p>
                    
                    <p class="info-text">网站域名: <a href="https://<?= htmlspecialchars($record['site_domain']) ?>" style="color: inherit; text-decoration: none;"><strong><?= htmlspecialchars($record['site_domain']) ?></strong></a></p>
                    
                    <h3>悬挂代码</h3>
                    <p class="info-text">请将以下代码放置到您网站的页脚或其他显著位置:</p>
                    
                    <div class="code-block">
                        <code id="suspension-code">&lt;a href="https://<?php echo htmlspecialchars($sitedomain); ?>/icp.php?keyword=<?=htmlspecialchars($record['icp_number'])?>" target="_blank"&gt;
                        <?php 
                            $stmt = $pdo->query("SELECT logo_url FROM web_settings LIMIT 1");
                            $web_settings = $stmt->fetch(PDO::FETCH_ASSOC);
                            $logoUrl = isset($web_settings['logo_url']) ? trim($web_settings['logo_url']) : '';
                            
                            if (!empty($logoUrl)) {
                                if (!preg_match('/^(https?:)?\/\//', $logoUrl)) {
                                    $logoUrl = 'https://' . htmlspecialchars($sitedomain) . '/' . ltrim($logoUrl, '/');
                                }
                                echo '&lt;img src="' . htmlspecialchars($logoUrl) . '" width="20" height="20" style="vertical-align: middle; margin-right: 5px;"&gt;';
                            }
                            if(strpos($record['icp_number'],'-')!==false){
                                list($mainNum,$subNum)=explode('-',$record['icp_number'],2);
                                echo htmlspecialchars($shortname).'ICP备'.htmlspecialchars($mainNum).'号-'.htmlspecialchars($subNum);
                            }else{
                                echo htmlspecialchars($shortname).'ICP备'.htmlspecialchars($record['icp_number']).'号';
                            }
                        ?>&lt;/a&gt;</code>
                    </div>
                    
                    
<div class="preview-area">
    <p>效果预览:</p>
    <div class="preview-content">
        <a href="https://<?php echo htmlspecialchars($sitedomain); ?>/icp.php?keyword=<?= htmlspecialchars($record['icp_number']) ?>" target="_blank">
            <?php 
            if (!empty($logoUrl)) {
                echo '<img src="' . htmlspecialchars($logoUrl) . '" class="preview-logo">';
            }
            if (strpos($record['icp_number'], '-') !== false) {
                list($mainNum, $subNum) = explode('-', $record['icp_number'], 2);
                echo '<span class="preview-text">' . htmlspecialchars($shortname) . 'ICP备' . htmlspecialchars($mainNum) . '号-' . htmlspecialchars($subNum) . '</span>';
            } else {
                echo '<span class="preview-text">' . htmlspecialchars($shortname) . 'ICP备' . htmlspecialchars($record['icp_number']) . '号</span>';
            }
            ?>
        </a>
    </div>
    
    <div class="badge-generator-link">
        <a href="shields.php" target="_blank" class="badge-link">
            <span class="badge-icon">✨</span>
            <span class="badge-text">不好看？来生成精美的备案徽章</span>
            <span class="badge-arrow">→</span>
        </a>
    </div>
</div>
                    
                    <div class="guide-steps">
                        <h3>悬挂步骤</h3>
                        
                        <div class="step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <strong>复制上方代码</strong>
                                <p>选择并复制整个代码块</p>
                            </div>
                        </div>
                        
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <strong>添加到您的网站</strong>
                                <p>将代码粘贴到您网站的页脚或其他显著位置</p>
                            </div>
                        </div>
                        
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <strong>完成悬挂</strong>
                                <p>添加代码后刷新您的网站，检查悬挂效果是否正确显示，我们会尽快完成审核。（约3个休息日）</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
    <div class="fixed bottom-8 right-8 z-50">
        <button id="back-to-top" class="w-14 h-14 bg-pink-600 hover:bg-pink-500 rounded-full flex items-center justify-center text-white shadow-lg transition-all opacity-0 invisible transform translate-y-4">
            <i class="fas fa-arrow-up text-xl"></i>
        </button>
    </div>
    <script>
        function copyCode() {
            const code = document.getElementById('suspension-code').textContent;
            navigator.clipboard.writeText(code.trim()).then(() => {
                const btn = document.querySelector('.copy-btn');
                btn.textContent = '已复制!';
                setTimeout(() => {
                    btn.textContent = '复制代码';
                }, 2000);
            });
        }
    </script>
    <?php include('footer.php'); ?>
</body>
</html>