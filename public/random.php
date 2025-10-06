<?php
require_once '../app/config/function.php';

function getApprovedSites() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT site_title, site_domain FROM icp_records WHERE status = 'approved'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$siteSettings = getSiteSettings();
$sitename = $siteSettings['site_name'];

$approvedSites = getApprovedSites();

if (empty($approvedSites)) {
    $targetSite = "TuanICP";
    $targetUrl = "https://icp.we2050.fun";
} else {
    $randomSite = $approvedSites[array_rand($approvedSites)];
    $targetSite = $randomSite['site_title'];
    $targetUrl = "https://" . ltrim($randomSite['site_domain'], 'https://');
}

function generateRandomCoords() {
    $x = rand(0, 9999);
    $y = rand(0, 9999);
    $z = rand(0, 9999);
    return "X-{$x}.Y-{$y}.Z-{$z}";
}

$targetCoords = generateRandomCoords();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($sitename); ?> - 星际迁跃</title>
    <link href="static/css/random.css" rel="stylesheet">
</head>
<body>
    <div class="stars" id="stars"></div>
    
    <div class="emoticon" style="--hue-offset: -15%; top: 15%; left: 10%; animation-delay: 0s;">(✧ω✧)</div>
    <div class="emoticon" style="--hue-offset: 10%; top: 25%; right: 15%; animation-delay: 0.5s;">(≧∇≦)ﾉ</div>
    <div class="emoticon" style="--hue-offset: -5%; top: 70%; left: 15%; animation-delay: 1s;">(๑•̀ㅂ•́)و✧</div>
    <div class="emoticon" style="--hue-offset: 20%; top: 60%; right: 12%; animation-delay: 1.5s;">(✿◠‿◠)</div>
    <div class="emoticon" style="--hue-offset: -10%; top: 40%; left: 5%; animation-delay: 2s;">(๑>ᴗ<๑)</div>
    <div class="emoticon" style="--hue-offset: 15%; top: 30%; right: 8%; animation-delay: 2.5s;">(≧∀≦)ﾉ</div>
    
    <div class="decoration" style="--decor-hue: 330; --hue-offset: -10%; top: 10%; right: 25%; animation-delay: 0s;">✧</div>
    <div class="decoration" style="--decor-hue: 270; --hue-offset: 15%; top: 30%; left: 20%; animation-delay: 1s;">☼</div>
    <div class="decoration" style="--decor-hue: 195; --hue-offset: -5%; top: 75%; right: 25%; animation-delay: 2s;">♡</div>
    <div class="decoration" style="--decor-hue: 330; --hue-offset: 20%; top: 50%; left: 15%; animation-delay: 3s;">✦</div>
    <div class="decoration" style="--decor-hue: 270; --hue-offset: -15%; top: 20%; left: 30%; animation-delay: 4s;">✧</div>
    <div class="decoration" style="--decor-hue: 195; --hue-offset: 10%; top: 60%; right: 30%; animation-delay: 5s;">★</div>
    <div class="decoration" style="--decor-hue: 330; --hue-offset: -5%; top: 40%; right: 25%; animation-delay: 6s;">✩</div>
    <div class="decoration" style="--decor-hue: 270; --hue-offset: 15%; top: 80%; left: 20%; animation-delay: 7s;">❀</div>
    <div class="decoration" style="--decor-hue: 330; --hue-offset: 20%; top: 50%; right: 18%; animation-delay: 9s;">✫</div>
    
    <div class="jump-container">
        <h1>✨ 星际迁跃准备中 ✨</h1>
        
        <div class="jump-info">
            <div class="info-line">
                亲爱的旅行者，欢迎乘坐 <span class="highlight"><?php echo htmlspecialchars($sitename); ?></span> 航班
            </div>
            <div class="info-line">
                目的地: <span class="highlight" id="target-site" onclick="jumpNow()"><?php echo htmlspecialchars($targetSite); ?></span>
            </div>
            <div class="info-line">
                坐标: <span class="highlight" id="target-coords"><?php echo htmlspecialchars($targetCoords); ?></span>
            </div>
        </div>
        
        <div class="countdown">
            正在启动超空间引擎... 预计还有 <span class="time-remaining" id="time-remaining">3.5</span> 秒到达
        </div>
        <div class="progress-container">
            <div class="progress-bar"></div>
        </div>
        
    </div>
    
    <script>
        function createStars() {
            const starsContainer = document.getElementById('stars');
            const starCount = 100;
            
            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                
                const size = Math.random() * 4 + 2;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                
                const duration = Math.random() * 3 + 1;
                star.style.setProperty('--duration', `${duration}s`);
                
                const hueOffset = Math.random() * 40 - 20;
                star.style.backgroundColor = `hsl(330, 100%, ${50 + hueOffset}%)`;
                
                starsContainer.appendChild(star);
            }
        }
        
        function jumpNow() {
            window.location.href = "<?php echo htmlspecialchars($targetUrl); ?>";
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            createStars();
            
            const timeRemaining = document.getElementById('time-remaining');
            const startTime = 3.5;
            let remaining = startTime;
            
            const timer = setInterval(() => {
                remaining -= 0.1;
                if (remaining <= 0) {
                    remaining = 0;
                    clearInterval(timer);
                    jumpNow();
                }
                timeRemaining.textContent = remaining.toFixed(1);
            }, 100);
            
            const container = document.querySelector('.jump-container');
            container.addEventListener('mouseover', () => {
                container.style.transform = 'scale(1.02)';
            });
            container.addEventListener('mouseout', () => {
                container.style.transform = 'scale(1)';
            });
            
            const targetSite = document.getElementById('target-site');
            targetSite.style.cursor = 'pointer';
            targetSite.addEventListener('click', jumpNow);
        });
    </script>
</body>
</html>