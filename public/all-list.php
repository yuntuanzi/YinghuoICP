<?php
require_once '../app/config/function.php';
$page = 'all-list';
include('header.php');

function isLianghao($icpNumber) {
    $numbers = preg_replace('/[^\d]/', '', $icpNumber);
    return preg_match('/(\d)\1{2,}/', $numbers);
}

$perPage = 10;
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $perPage;

$stmt = $pdo->query("SELECT COUNT(*) FROM icp_records WHERE status = 'approved'");
$totalRecords = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT * FROM icp_records WHERE status = 'approved' ORDER BY update_time DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalPages = ceil($totalRecords / $perPage);

$pastelColors = [
    'bg-pink-100', 'bg-blue-100', 'bg-purple-100', 'bg-indigo-100',
    'bg-green-100', 'bg-yellow-100', 'bg-red-100', 'bg-teal-100',
    'bg-cyan-100', 'bg-orange-100', 'bg-lime-100', 'bg-amber-100'
];

$textColors = [
    'text-pink-800', 'text-blue-800', 'text-purple-800', 'text-indigo-800',
    'text-green-800', 'text-yellow-800', 'text-red-800', 'text-teal-800',
    'text-cyan-800', 'text-orange-800', 'text-lime-800', 'text-amber-800'
];
?>

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-400 via-indigo-500 to-purple-600 p-8 md:p-12 mb-8 text-center shadow-lg">
        <div class="absolute top-0 left-0 w-full h-full opacity-20">
            <div class="absolute -top-10 -left-10 w-32 h-32 rounded-full bg-white"></div>
            <div class="absolute bottom-0 right-0 w-48 h-48 rounded-full bg-white"></div>
            <div class="absolute top-1/4 right-1/4 w-16 h-16 rounded-full bg-white"></div>
        </div>
        
        <div class="absolute top-4 left-4 text-yellow-300 text-xl">✦</div>
        <div class="absolute top-8 right-6 text-yellow-300 text-xl">✧</div>
        <div class="absolute bottom-6 left-10 text-yellow-300 text-xl">✧</div>
        <div class="absolute bottom-10 right-8 text-yellow-300 text-xl">✦</div>
        
        <div class="relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tight">
                <span class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full"><?php echo $maintitle; ?> - 全部备案</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-6 font-medium">
                <span class="inline-block bg-black/20 px-3 py-1 rounded-md">共 <?php echo $totalRecords; ?> 个网站通过备案</span>
            </p>
            
            <div class="flex justify-center space-x-4 mb-4">
                <a href="index.php" class="inline-block px-4 py-2 bg-white/20 text-white rounded-full hover:bg-white/30 transition-colors">
                    ✦ 返回首页
                </a>
                <a href="random.php" class="inline-block px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors">
                    ✈️ 星际迁跃
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($records as $index => $record): 
            $colorIndex = $index % count($pastelColors);
            $bgColor = $pastelColors[$colorIndex];
            $textColor = $textColors[$colorIndex];
            
            $siteAvatar = !empty($record['site_avatar']) ? $record['site_avatar'] : null;
            $siteInitial = mb_substr(trim($record['site_title']), 0, 1, 'UTF-8');
            $siteTitle = htmlspecialchars($record['site_title']);
            $siteDomain = htmlspecialchars($record['site_domain']);
        ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border-2 border-blue-100">
                <div class="bg-gradient-to-r from-blue-400 to-indigo-500 p-4 text-white">
                    <div class="flex items-center">
                        <?php if($siteAvatar): ?>
                        <img src="<?php echo htmlspecialchars($siteAvatar); ?>" 
                             alt="网站图标" 
                             class="w-8 h-8 mr-3 rounded-full bg-white p-1 object-cover"
                             onload="this.nextElementSibling.style.display='none';"
                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMTIgMkE0IDQgMCAwIDEgMTIgMTBBNCA0IDAgMCAxIDEyIDJNMTIgNEMxMS44IDQgMTEuNSA0LjQgMTEuNSA0LjlDMTEuNSA1LjQgMTEuOCA2IDEyIDZDMTIuMiA2IDEyLjUgNS42IDEyLjUgNS4xQzEyLjUgNC42IDEyLjIgNCAxMiA0TTEyIDEzQzkuNjYgMTMgNSAxNC4zMyA1IDE2LjY2VjE5SDE5VjE2LjY2QzE5IDE0LjMzIDE0LjM0IDEzIDEyIDEzTTcgMTYuNkM3LjU2IDE2IDkuNDQgMTUgMTIgMTVDMTQuNTYgMTUgMTYuNDQgMTYgMTcgMTYuNjJWN0g3VjE2LjZaIiAvPjwvc3ZnPg==';this.onerror=null;this.classList.add('<?php echo $bgColor; ?>');this.classList.add('<?php echo $textColor; ?>');this.nextElementSibling.style.display='block';">
                        <span class="hidden <?php echo $bgColor; ?> <?php echo $textColor; ?>" style="display:none;"><?php echo $siteInitial; ?></span>
                        <?php else: ?>
                            <div class="w-8 h-8 mr-3 rounded-full <?php echo $bgColor; ?> flex items-center justify-center <?php echo $textColor; ?>">
                                <?php echo $siteInitial; ?>
                            </div>
                        <?php endif; ?>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold truncate"><?php echo $siteTitle; ?></h3>
                            <p class="text-sm opacity-90 truncate"><?php echo $siteDomain; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="flex items-center mb-3">
                        <span class="text-gray-600 text-sm mr-2">备案号码:</span>
                        <span class="font-medium text-blue-600 text-sm">
                            <?php echo htmlspecialchars($record['icp_number']); ?>
                            <?php if (isLianghao($record['icp_number'])): ?>
                                <div class="group relative inline-block ml-1">
                                    <img src="../static/image/lh.png" class="h-4 w-4" style="margin-bottom: -3px;" alt="靓号备案">
                                    <div class="absolute z-10 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-800 rounded whitespace-nowrap bottom-full left-1/2 transform -translate-x-1/2 mb-1">
                                        靓号备案（连号）
                                        <div class="absolute w-2 h-2 bg-gray-800 bottom-0 left-1/2 -mb-1 -translate-x-1/2 rotate-45"></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </span>
                    </div>
                    
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center">
                            <span class="text-gray-600 text-sm mr-2">审核状态:</span>
                            <span class="text-sm font-medium px-2 py-1 rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>通过审核
                            </span>
                        </div>
                        
                        <div class="flex items-center">
                            <span class="text-gray-600 text-sm mr-2">审核时间:</span>
                            <span class="text-sm text-gray-700"><?php echo date('Y-m-d H:i:s', strtotime($record['update_time'])); ?></span>
                        </div>
                        
                        <div class="flex items-start">
                            <span class="text-gray-600 text-sm mr-2">审核意见:</span>
                            <div class="text-green-700 text-sm">
                                网站内容符合相关规定，审核已通过。
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-2 border-t border-gray-100 text-right">
                    <a href="icp.php?keyword=<?php echo urlencode($record['site_domain']); ?>" 
                       class="text-sm text-blue-600 hover:text-blue-800">
                       查看详情 &raquo;
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <?php if ($totalPages > 1): ?>
    <div class="mt-8 flex justify-center">
        <nav class="inline-flex rounded-md shadow">
            <a href="?page=<?php echo max(1, $currentPage - 1); ?>" 
               class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50 <?php echo $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                &laquo; 上一页
            </a>
            
            <?php 
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $currentPage + 2);
            
            if ($startPage > 1) {
                echo '<a href="?page=1" class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-500 hover:bg-gray-50">1</a>';
                if ($startPage > 2) {
                    echo '<span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-500">...</span>';
                }
            }
            
            for ($i = $startPage; $i <= $endPage; $i++): ?>
                <a href="?page=<?php echo $i; ?>" 
                   class="px-3 py-2 border-t border-b border-gray-300 <?php echo $i == $currentPage ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-500 hover:bg-gray-50'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor;
            
            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) {
                    echo '<span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-500">...</span>';
                }
                echo '<a href="?page='.$totalPages.'" class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-500 hover:bg-gray-50">'.$totalPages.'</a>';
            }
            ?>
            
            <a href="?page=<?php echo min($totalPages, $currentPage + 1); ?>" 
               class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50 <?php echo $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                下一页 &raquo;
            </a>
        </nav>
    </div>
    <?php endif; ?>
</main>

<div class="fixed bottom-8 right-8 z-50">
    <button id="back-to-top" class="w-14 h-14 bg-pink-600 hover:bg-pink-500 rounded-full flex items-center justify-center text-white shadow-lg transition-all opacity-0 invisible transform translate-y-4">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>
</div>
<?php include('footer.php'); ?>