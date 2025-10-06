<?php
require_once '../app/config/function.php';
$page = 'shields';
include('header.php');

?>
<style>
body, html {
    margin: 0;
    padding: 0;
    overflow: hidden;
}
iframe {
    width: 100%;
    height: 100vh;
    border: none;
    display: block;
}
</style>
<body>
    <iframe src="https://api.xn--kiv.fun/Shields/gen.php" frameborder="0"></iframe>
    <div class="fixed bottom-8 right-8 z-50">
        <button id="back-to-top" class="w-14 h-14 bg-pink-600 hover:bg-pink-500 rounded-full flex items-center justify-center text-white shadow-lg transition-all opacity-0 invisible transform translate-y-4">
            <i class="fas fa-arrow-up text-xl"></i>
        </button>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>