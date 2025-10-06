<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($maintitle); ?> - 加入我们，体验最可爱的备案服务 (｡♥‿♥｡)</title>
    <meta name="keywords" content="<?php echo htmlspecialchars($maintitle); ?>,<?php echo htmlspecialchars($sitename); ?>,虚拟备案,<?php echo htmlspecialchars($shortname); ?>ICP虚拟备案,网站备案,网站ICP备案,免费备案,免费ICP备案,<?php echo htmlspecialchars($shortname); ?>备案,<?php echo htmlspecialchars($shortname); ?>ICP备案,<?php echo htmlspecialchars($shortname); ?>备">
    <meta name="description" content="加入<?php echo htmlspecialchars($shortname); ?>ICP二次元虚拟备案，体验最可爱的备案服务 (｡♥‿♥｡)">
<!-- 上面的SEO关键字，SEO描述可以编辑。不懂的话别改就行。 -->


<!-- 以下不懂勿动！以下不懂勿动！以下不懂勿动！以下不懂勿动！以下不懂勿动！ -->

<script src="static/js/tailwindcss.js"></script>
<script src="static/js/tailwindconfig.js" defer></script>
<link href="static/css/all.min.css" rel="stylesheet">
<link href="static/css/nav.css" rel="stylesheet">
<link href="static/css/main.css" rel="stylesheet">
<script src="static/js/backbutton.js" defer></script>
<script src="static/js/nav.js" defer></script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<!-- 以上不懂勿动！以上不懂勿动！以上不懂勿动！以上不懂勿动！以上不懂勿动！ -->


<!-- 下面的导航栏可以编辑 -->
<!-- 温馨提示：下面的导航栏分为电脑端和移动端，改动的话别忘了二者都要改！ -->
<nav class="bg-pink-500 text-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md">
                    <img src="favicon.ico" alt="Logo" style="width: 50px;">
                </div>
                <h1 class="text-2xl font-bold tracking-tight">
                    <span class="text-white"><?php echo htmlspecialchars($shortname); ?>ICP虚拟备案</span>
                </h1>
            </div>
            
            <!-- 电脑端导航栏 -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="/" class="hover:text-yellow-200 transition">
                    <i class="fas fa-home mr-1"></i> 首页
                </a>
                <a href="search.php" class="hover:text-yellow-200 transition">
                    <i class="fas fa-search mr-1"></i> 查询
                </a>
                <a href="note.php" class="hover:text-yellow-200 transition">
                    <i class="fas fa-user-plus mr-1"></i> 加入
                </a>
                <a href="change.php" class="hover:text-yellow-200 transition">
                    <i class="fas fa-edit mr-1"></i> 变更/注销
                </a>
                <a href="show.php" class="hover:text-yellow-200 transition">
                    <i class="fas fa-shield-alt mr-1"></i> 公示
                </a>
                <a href="random.php" class="hover:text-yellow-200 transition">
                    <i class="fas fa-biohazard mr-1"></i> 星际迁跃
                </a>
                <a href="shields.php" class="hover:text-yellow-200 transition">
                    <i class="fas fa-medal mr-1"></i> 徽章
                </a>
                <a href="https://github.com/yuntuanzi/TuanICP" class="hover:text-yellow-200 transition">
                    <i class="fas fa-code mr-1"></i> 源码
                </a>
                <a href="https://qm.qq.com/q/uWxyfiQhqg" class="hover:text-yellow-200 transition">
                    <i class="fas fa-users mr-1"></i> 站长Q群
                </a>
                <a href="about.php" class="hover:text-yellow-200 transition">
                    <i class="fas fa-info-circle mr-1"></i> 关于
                </a>
            </div>
            
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        
        
        <!-- 移动端导航栏 -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
            <div class="flex flex-col space-y-3">
                <a href="/" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition">
                    <i class="fas fa-home mr-2"></i> 首页
                </a>
                <a href="search.php" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition">
                    <i class="fas fa-search mr-2"></i> 查询
                </a>
                <a href="note.php" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition">
                    <i class="fas fa-user-plus mr-2"></i> 加入
                </a>
                <a href="change.php" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition">
                    <i class="fas fa-edit mr-2"></i> 变更/注销
                </a>
                <a href="show.php" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition">
                    <i class="fas fa-shield-alt mr-2"></i> 公示
                </a>
                <a href="random.php" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition">
                    <i class="fas fa-biohazard mr-2"></i> 星际迁跃
                </a>
                <a href="shields.php" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition" >
                    <i class="fas fa-medal mr-2"></i> 徽章
                </a>
                <a href="https://github.com/yuntuanzi/TuanICP" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition">
                    <i class="fas fa-code mr-2"></i> 源码
                </a>
                <a href="https://qm.qq.com/q/uWxyfiQhqg" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition">
                    <i class="fas fa-users mr-2"></i> 站长Q群
                </a>
                <a href="about.php" class="text-white hover:text-yellow-200 px-4 py-2 rounded-lg hover:bg-pink-400 transition">
                    <i class="fas fa-info-circle mr-2"></i> 关于
                </a>
            </div>
        </div>
    </div>
</nav>