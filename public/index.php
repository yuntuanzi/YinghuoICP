<?php
require_once '../app/config/function.php';

include('header.php');
$page = 'index';
?>
<body>
<section class="py-16 bg-gradient-to-r from-pink-500 to-pink-600 text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6"><?php echo htmlspecialchars($maintitle); ?></h2>
        <p class="text-xl text-pink-100 mb-8 max-w-3xl mx-auto">加入我们，体验最可爱的备案服务 (｡♥‿♥｡)</p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="note.php" class="bg-white text-pink-600 hover:bg-yellow-100 px-8 py-4 rounded-full font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 anime-btn">
                <i class="fas fa-heart mr-3"></i> 免费加入
            </a>
            <a href="search.php" class="border-2 border-white text-white hover:bg-white hover:text-pink-600 px-8 py-4 rounded-full font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 anime-btn">
                <i class="fas fa-star mr-3"></i> 查询备案
            </a>
        </div>
    </div>
</section>

<section class="py-16 bg-pink-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-pink-700 mb-4">
                系统の特色
            </h2>
            <div class="w-24 h-2 bg-pink-400 rounded-full mx-auto mb-6"></div>
            <p class="text-xl text-pink-600 max-w-3xl mx-auto"><?php echo htmlspecialchars($shortname); ?>ICP让虚拟备案带你进入二次元的世界 (●'◡'●)</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 anime-card">
                <div class="h-48 bg-gradient-to-r from-pink-400 to-pink-500 flex items-center justify-center relative">
                    <i class="fas fa-bolt text-white text-6xl"></i>
                    <div class="absolute -top-4 -right-4 w-16 h-16 bg-yellow-300 rounded-full flex items-center justify-center text-pink-600 font-bold text-xl">
                        NEW
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-pink-700 mb-4">闪电备案</h3>
                    <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($shortname); ?>ICP虚拟备案中心最快响应时间20s</p>
                    <a href="note.php" class="text-pink-500 font-semibold flex items-center anime-link">
                        了解更多 <i class="fas fa-angle-double-right ml-2 animate-bounce-x"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 anime-card">
                <div class="h-48 bg-gradient-to-r from-purple-400 to-purple-500 flex items-center justify-center">
                    <i class="fas fa-shield-alt text-white text-6xl"></i>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-purple-700 mb-4"><?php echo htmlspecialchars($shortname); ?>盾守护</h3>
                    <p class="text-gray-600 mb-6">团盾保护你的数据安全，WAF防护坚不可摧！</p>
                    <a href="#" class="text-purple-500 font-semibold flex items-center anime-link">
                        了解更多 <i class="fas fa-angle-double-right ml-2 animate-bounce-x"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 anime-card">
                <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-500 flex items-center justify-center">
                    <i class="fas fa-headset text-white text-6xl"></i>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-blue-700 mb-4"><?php echo htmlspecialchars($shortname); ?>国政务</h3>
                    <p class="text-gray-600 mb-6">7x2.4小时接待小伙伴们的<?php echo htmlspecialchars($shortname); ?>国政务人员</p>
                    <a href="#" class="text-blue-500 font-semibold flex items-center anime-link">
                        了解更多 <i class="fas fa-angle-double-right ml-2 animate-bounce-x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gradient-to-r from-pink-500 to-purple-600 text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-12">
            <?php echo htmlspecialchars($shortname); ?><?php echo htmlspecialchars($shortname); ?>の数据
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="p-6 anime-stats">
                <div class="text-4xl md:text-5xl font-bold mb-2 flex items-center justify-center">
                    <span class="counter" data-target="12500">100</span>+
                </div>
                <div class="text-xl">
                    <i class="fas fa-heart text-pink-300 mr-2"></i> 成功备案
                </div>
            </div>
            <div class="p-6 anime-stats">
                <div class="text-4xl md:text-5xl font-bold mb-2 flex items-center justify-center">
                    <span class="counter" data-target="98">97.8</span>%
                </div>
                <div class="text-xl">
                    <i class="fas fa-check-circle text-green-300 mr-2"></i> 通过率
                </div>
            </div>
            <div class="p-6 anime-stats">
                <div class="text-4xl md:text-5xl font-bold mb-2 flex items-center justify-center">
                    <span class="counter" data-target="365">365</span>
                </div>
                <div class="text-xl">
                    <i class="fas fa-clock text-yellow-300 mr-2"></i> 全年摸鱼
                </div>
            </div>
            <div class="p-6 anime-stats">
                <div class="text-4xl md:text-5xl font-bold mb-2 flex items-center justify-center">
                    <span class="counter" data-target="30">20</span>s
                </div>
                <div class="text-xl">
                    <i class="fas fa-bolt text-blue-300 mr-2"></i> 最快响应
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-pink-700 mb-4">
                备案の步骤
            </h2>
            <div class="w-24 h-2 bg-pink-400 rounded-full mx-auto mb-6"></div>
            <p class="text-xl text-pink-600 max-w-3xl mx-auto">登记站点信息，肥肠简单哦 (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧</p>
        </div>
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-12">
            <div class="md:w-1/3 mb-8 md:mb-0 relative anime-step">
                <div class="absolute -left-4 top-0 w-16 h-16 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold text-2xl z-10 shadow-md">
                    1
                </div>
                <div class="bg-pink-50 rounded-2xl p-8 pl-20 shadow-md h-full border-2 border-pink-100">
                    <h3 class="text-2xl font-bold text-pink-700 mb-4">阅读须知</h3>
                    <p class="text-gray-600">认真阅读对接须知，确保网站符合要求</p>
                    <div class="mt-4 text-pink-500">
                        <i class="fas fa-user-edit fa-lg"></i>
                    </div>
                </div>
            </div>
            <div class="hidden md:block transform rotate-12">
                <i class="fas fa-arrow-right text-4xl text-pink-300 mx-8"></i>
            </div>
            <div class="md:w-1/3 mb-8 md:mb-0 relative anime-step">
                <div class="absolute -left-4 top-0 w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-2xl z-10 shadow-md">
                    2
                </div>
                <div class="bg-purple-50 rounded-2xl p-8 pl-20 shadow-md h-full border-2 border-purple-100">
                    <h3 class="text-2xl font-bold text-purple-700 mb-4">提交申请</h3>
                    <p class="text-gray-600">选择备案号码，填写网站信息，提交备案</p>
                    <div class="mt-4 text-purple-500">
                        <i class="fas fa-file-upload fa-lg"></i>
                    </div>
                </div>
            </div>
            <div class="hidden md:block transform -rotate-12">
                <i class="fas fa-arrow-right text-4xl text-purple-300 mx-8"></i>
            </div>
            <div class="md:w-1/3 relative anime-step">
                <div class="absolute -left-4 top-0 w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-2xl z-10 shadow-md">
                    3
                </div>
                <div class="bg-blue-50 rounded-2xl p-8 pl-20 shadow-md h-full border-2 border-blue-100">
                    <h3 class="text-2xl font-bold text-blue-700 mb-4">等待审核</h3>
                    <p class="text-gray-600">提交后请及时悬挂<?php echo htmlspecialchars($shortname); ?>备案号，等待<?php echo htmlspecialchars($shortname); ?>国政务人员的审核~</p>
                    <div class="mt-4 text-blue-500">
                        <i class="fas fa-hourglass-half fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <a href="note.php" class="inline-flex items-center px-8 py-4 bg-pink-500 hover:bg-pink-600 text-white text-lg font-semibold rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 anime-btn">
                <i class="fas fa-book-open mr-3"></i> 查看完整<?php echo htmlspecialchars($shortname); ?>备案指南
            </a>
        </div>
    </div>
</section>

<section class="py-16 bg-pink-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-pink-700 mb-4">
                小伙伴の声音
            </h2>
            <div class="w-24 h-2 bg-pink-400 rounded-full mx-auto mb-6"></div>
            <p class="text-xl text-pink-600 max-w-3xl mx-auto">听听小伙伴们怎么说 (★ω★)</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-md border-2 border-pink-100 transform hover:scale-105 transition duration-300 anime-review">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 rounded-full overflow-hidden mr-4 border-2 border-pink-300">
                        <img src="static/image/anime-avatar1.jpg" alt="用户头像" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-pink-700">鸣月</h4>
                        <p class="text-gray-500 text-sm">青龙云IDC</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-6">"虚拟备案很新颖有趣，界面超可爱，登记也方便！"</p>
                <div class="flex text-yellow-400">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="absolute -bottom-4 -right-4 text-6xl text-pink-200 opacity-60">
                    <i class="fas fa-quote-right"></i>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-md border-2 border-purple-100 transform hover:scale-105 transition duration-300 anime-review">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 rounded-full overflow-hidden mr-4 border-2 border-purple-300">
                        <img src="static/image/anime-avatar2.jpg" alt="用户头像" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-purple-700">十一</h4>
                        <p class="text-gray-500 text-sm">初衷云IDC</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-6">"听说虚拟备案的站长是男娘？"</p>
                <div class="flex text-yellow-400">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="absolute -bottom-4 -right-4 text-6xl text-purple-200 opacity-60">
                    <i class="fas fa-quote-right"></i>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-md border-2 border-blue-100 transform hover:scale-105 transition duration-300 anime-review">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 rounded-full overflow-hidden mr-4 border-2 border-blue-300">
                        <img src="static/image/anime-avatar3.jpg" alt="用户头像" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-blue-700">安安</h4>
                        <p class="text-gray-500 text-sm">奶安云IDC</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-6">"备案徽章特别好看，做的很精致~"</p>
                <div class="flex text-yellow-400">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="absolute -bottom-4 -right-4 text-6xl text-blue-200 opacity-60">
                    <i class="fas fa-quote-right"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gradient-to-r from-pink-500 to-pink-600 text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            <i class="fas fa-heart mr-2"></i> 准备好开始你的可爱备案之旅了吗？
        </h2>
        <p class="text-xl text-pink-100 mb-8 max-w-3xl mx-auto">加入我们，体验最可爱的备案服务 (｡♥‿♥｡)</p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="note.php" class="bg-white text-pink-600 hover:bg-yellow-100 px-8 py-4 rounded-full font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 anime-btn">
                <i class="fas fa-heart mr-3"></i> 免费加入
            </a>
            <a href="search.php" class="border-2 border-white text-white hover:bg-white hover:text-pink-600 px-8 py-4 rounded-full font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 anime-btn">
                <i class="fas fa-star mr-3"></i> 查询备案
            </a>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-100">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-pink-700 mb-4">
                <?php echo htmlspecialchars($shortname); ?>之の友链
            </h2>
            <div class="w-24 h-2 bg-pink-400 rounded-full mx-auto mb-6"></div>
            <p class="text-xl text-pink-600 max-w-3xl mx-auto">这里是我们的邻居小伙伴喵 (◕‿◕✿)</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接1
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接2
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接3
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接4
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接5
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接6
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接7
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接8
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接9
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接10
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接11
                </a>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                <a href="" target="_blank" rel="noopener noreferrer" class="text-pink-600 hover:text-pink-800 font-medium block">
                    友情链接12
                </a>
            </div>
        </div>
    </div>
</section>

<div class="fixed bottom-8 right-8 z-50">
    <button id="back-to-top" class="w-14 h-14 bg-pink-600 hover:bg-pink-500 rounded-full flex items-center justify-center text-white shadow-lg transition-all opacity-0 invisible transform translate-y-4">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>
</div>

<?php include('footer.php'); ?>

</body>
</html>