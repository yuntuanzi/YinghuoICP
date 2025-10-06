<?php
require_once '../app/config/function.php';
$page = 'choose';
include('header.php');
function getOccupiedNumbers(PDO $pdo, string $currentYear): array {
    $stmt = $pdo->prepare("SELECT icp_number FROM icp_records WHERE icp_number LIKE :yearPattern");
    $stmt->execute([':yearPattern' => $currentYear . '%']);
    $numbers = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    
    $mainNumbers = array_map(function($number) {
        return explode('-', $number)[0];
    }, $numbers);
    
    return array_unique($mainNumbers);
}

$currentYear = date('Y');
$occupiedNumbers = getOccupiedNumbers($pdo, $currentYear);
?>

<link rel="stylesheet" href="static/css/choose.css">
<body>
    <div class="choose-container container mx-auto px-4 py-8 max-w-4xl">

        <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-pink-400 via-purple-500 to-indigo-600 p-8 md:p-12 mb-8 text-center shadow-lg">
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
                    <span class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full"><?php echo $maintitle; ?>选号中心</span>
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-6 font-medium">
                    <span class="inline-block bg-black/20 px-3 py-1 rounded-md">选择你心仪的备案号码，开启二次元虚拟备案之旅</span>
                </p>
            </div>
        </div>

        <div class="number-container">
            <div class="prefix-selector" id="prefixSelector">
            </div>

            <table class="number-table">
                <thead>
                    <tr>
                        <th colspan="6">可选号码列表 (前缀: <span id="currentPrefix">0</span>开头)</th>
                    </tr>
                </thead>
                <tbody id="numberGrid">
                </tbody>
            </table>
        </div>
    </div>

    <div class="fixed bottom-8 right-8 z-50">
        <button id="back-to-top" class="w-14 h-14 bg-pink-600 hover:bg-pink-500 rounded-full flex items-center justify-center text-white shadow-lg transition-all opacity-0 invisible transform translate-y-4">
            <i class="fas fa-arrow-up text-xl"></i>
        </button>
    </div>

    <script>
    const currentYear = <?= json_encode($currentYear) ?>;

    const occupiedNumbers = Object.values(<?= json_encode($occupiedNumbers) ?>);

    
    document.addEventListener('DOMContentLoaded', function() {
        const prefixSelector = document.getElementById('prefixSelector');
        const numberGrid = document.getElementById('numberGrid');
        const currentPrefixSpan = document.getElementById('currentPrefix');
        
        let currentPrefix = '0';
        
        for (let i = 0; i <= 9; i++) {
            const btn = document.createElement('button');
            btn.className = `prefix-btn ${i === 0 ? 'active' : ''}`;
            btn.textContent = `${i}开头`;
            btn.dataset.prefix = i;
            
            btn.addEventListener('click', function() {
                document.querySelectorAll('.prefix-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentPrefix = this.dataset.prefix;
                currentPrefixSpan.textContent = currentPrefix;
                generateNumberGrid();
            });
            
            prefixSelector.appendChild(btn);
        }
        
        function generateNumberGrid() {
            numberGrid.innerHTML = '';
            
            const screenWidth = window.innerWidth;
            let numbersPerRow = 6;
            if (screenWidth < 1200) numbersPerRow = 5;
            if (screenWidth < 992) numbersPerRow = 4;
            if (screenWidth < 768) numbersPerRow = 3;
            if (screenWidth < 576) numbersPerRow = 2;
            
            let row;
            
            for (let i = 0; i < 1000; i++) {
                if (i % numbersPerRow === 0) {
                    row = document.createElement('tr');
                    numberGrid.appendChild(row);
                }
                
                const num = i.toString().padStart(3, '0');
                const fullNum = `${currentPrefix}${num}`;
                const fullIcpNumber = `${currentYear}${fullNum}`;
                
                const cell = document.createElement('td');
                const numberCell = document.createElement('span');
                numberCell.className = 'number-cell';
                numberCell.textContent = fullIcpNumber;
                numberCell.dataset.number = fullNum;

                if (occupiedNumbers && occupiedNumbers.includes(fullIcpNumber)) {
                    numberCell.classList.add('occupied');
                    numberCell.title = '该备案号已被占用';
                } else {
                    numberCell.addEventListener('click', function() {
                        window.location.href = `/register.php?number=${currentYear}${this.dataset.number}`;
                    });
                }
                
                cell.appendChild(numberCell);
                row.appendChild(cell);
            }
        }
        
        generateNumberGrid();

        window.addEventListener('resize', function() {
            generateNumberGrid();
        });
    });
</script>
        <?php include('footer.php'); ?>
</body>
</html>