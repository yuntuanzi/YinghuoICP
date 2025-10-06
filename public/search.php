<?php
require_once '../app/config/function.php';

include('header.php');
$page = 'search';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['type'])) {
    $searchTerm = trim($_GET['type']);
    
    if (preg_match('/\bICP备(\d+)号\b/u', $searchTerm, $matches)) {
        $icpNumber = $matches[1];
        $searchValue = $icpNumber;
        $searchType = 'icp_number';
    } elseif (preg_match('/^\d+$/', $searchTerm)) {
        $searchValue = $searchTerm;
        $searchType = 'icp_number';
    } else {
        $searchValue = $searchTerm;
        $searchType = 'site_domain';
    }
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM icp_records WHERE $searchType = ? AND status = 'approved' LIMIT 1");
        $stmt->execute([$searchValue]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($record) {
            header("Location: icp.php?keyword=" . urlencode($searchTerm));
            exit();
        } else {
            $error = '喵喵：不存在这个备案记录呦~';
        }
    } catch (PDOException $e) {
        $error = '查询时出现错误，请稍后再试';
        error_log('[' . date('Y-m-d H:i:s') . '] PDO Error: ' . $e->getMessage() . "\n", 3, '../app/logs/db_error.log');
    }
}
?>
<body>
    <div class="search-container">
        <main class="flex-grow container mx-auto px-4 py-8">
            <div class="bg-pink-50 rounded-2xl shadow-lg p-8 mb-12 border-2 border-pink-200">
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-pink-700 mb-2">备案信息查询 <span class="text-xl">(◕‿◕✿)</span></h2>
                    <p class="text-pink-600 max-w-lg mx-auto">查询网站备案信息，确保网站合法合规运营哦~</p>
                </div>
                <form action="search.php" method="get" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-pink-400"></i>
                        </div>
                        <input type="text" name="type" value="<?php echo isset($_GET['type']) ? htmlspecialchars($_GET['type']) : ''; ?>" 
                               placeholder="输入备案号 or 域名" 
                               class="w-full pl-10 pr-4 py-4 border-2 border-pink-300 rounded-2xl focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50 shadow-sm text-lg bg-white focus:border-pink-400 transition-all">
                    </div>
                    <button type="submit" class="px-8 py-4 bg-pink-500 hover:bg-pink-600 text-white font-medium rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 text-lg flex items-center justify-center">
                        <i class="fas fa-search mr-2"></i> 查询备案
                    </button>
                </form>
                <?php if ($error): ?>
                <div class="mt-4 flex justify-center">
                    <p class="text-red-500 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle mr-2 text-red-500"></i><?php echo htmlspecialchars($error); ?>
                    </p>
                </div>
                <?php endif; ?>
                <div class="mt-4 flex justify-center">
                    <p class="text-pink-500 text-sm flex items-center">
                        <i class="fas fa-info-circle mr-2 text-pink-400"></i>请输入完整的域名或备案号进行精确查询喵~
                    </p>
                </div>
            </div>
                    <div class="result-card bg-white rounded-2xl shadow-lg overflow-hidden text-center py-12 border-2 border-pink-200">
                        <div class="max-w-5xl mx-auto px-6">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-pink-100 text-pink-500 rounded-full mb-6">
                                <i class="fas fa-search text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-pink-700 mb-3">欢迎使用备案信息查询系统 <span class="text-xl">(◠‿◠)</span></h3>
                            <p class="text-pink-600 mb-8 text-lg">请输入完整的域名或备案号查询备案信息喵~</p>
                            <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-6 mb-10">
                                <div class="bg-pink-50 p-6 rounded-xl border-2 border-pink-100 transition-all hover:border-pink-300 hover:shadow-md">
                                    <div class="w-12 h-12 bg-pink-200 text-pink-700 rounded-full flex items-center justify-center mb-4 mx-auto">
                                        <i class="fas fa-link text-xl"></i>
                                    </div>
                                    <h4 class="font-medium text-pink-800 mb-2">域名查询</h4>
                                    <p class="text-pink-600 text-sm">www.example.com</p>
                                </div>
                                <div class="bg-purple-50 p-6 rounded-xl border-2 border-purple-100 transition-all hover:border-purple-300 hover:shadow-md">
                                    <div class="w-12 h-12 bg-purple-200 text-purple-700 rounded-full flex items-center justify-center mb-4 mx-auto">
                                        <i class="fas fa-id-card text-xl"></i>
                                    </div>
                                    <h4 class="font-medium text-purple-800 mb-2">备案号查询</h4>
                                    <p class="text-purple-600 text-sm"><?php echo htmlspecialchars($shortname); ?>ICP备<?php echo date("Y"); ?>1234号</p>
                                </div>
                            </div>
        
                            <div class="bg-blue-50 border-2 border-blue-100 rounded-xl p-6 max-w-5xl mx-auto">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-blue-200 text-blue-700 rounded-full items-center justify-center flex mr-4">
                                        <i class="fas fa-info-circle text-xl"></i>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-medium text-blue-800 mb-2">备案查询说明 <span class="text-sm">(◕‿◕✿)</span></h4>
                                        <ul class="text-blue-700 text-sm space-y-2">
                                            <li class="flex items-start">
                                                <i class="fas fa-check-circle text-blue-400 mr-2 mt-1"></i>
                                                <span>请输入完整的域名或备案号进行查询喵~</span>
                                            </li>
                                           <li class="flex items-start">
                                                <i class="fas fa-check-circle text-blue-400 mr-2 mt-1"></i>
                                                <span>备案号需准确输入完整备案号喵(｡･ω･｡)</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-check-circle text-blue-400 mr-2 mt-1"></i>
                                                <span>备案号查询格式例如：<?php echo htmlspecialchars($shortname); ?>ICP备<?php echo date("Y"); ?>1234号</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </main>
        </div>
    <div class="fixed bottom-8 right-8 z-50">
        <button id="back-to-top" class="w-14 h-14 bg-pink-600 hover:bg-pink-500 rounded-full flex items-center justify-center text-white shadow-lg transition-all opacity-0 invisible transform translate-y-4">
            <i class="fas fa-arrow-up text-xl"></i>
        </button>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>