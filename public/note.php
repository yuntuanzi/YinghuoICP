<?php
require_once '../app/config/function.php';
include('header.php');
?>

<body>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-500 via-purple-600 to-indigo-700 p-8 md:p-12 mb-8 text-center shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-white/10 backdrop-blur-sm"></div>
            
            <div class="absolute top-0 left-0 w-full h-full opacity-15">
                <div class="absolute -top-12 -left-12 w-40 h-40 rounded-full bg-white/30 blur-xl"></div>
                <div class="absolute bottom-0 right-0 w-56 h-56 rounded-full bg-white/30 blur-xl"></div>
            </div>
            
            <div class="absolute top-6 left-6 text-yellow-300 text-2xl opacity-80">✦</div>
            <div class="absolute top-10 right-8 text-yellow-300 text-2xl opacity-80">✧</div>
            <div class="absolute bottom-8 left-12 text-yellow-300 text-2xl opacity-80">✧</div>
            <div class="absolute bottom-12 right-10 text-yellow-300 text-2xl opacity-80">✦</div>
            
            <div class="relative z-10">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tight">
                    <span class="inline-block bg-white/20 backdrop-blur-md px-6 py-3 rounded-2xl shadow-sm"><?php echo htmlspecialchars($shortname); ?>ICP备案加入须知</span>
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-6 font-medium">
                    <span class="inline-block bg-black/20 backdrop-blur-sm px-4 py-2 rounded-lg">请仔细阅读以下条款，确保您的网站符合要求</span>
                </p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
            <div class="relative bg-gradient-to-r from-pink-500 to-purple-600 p-5 text-white">
                <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-white/5 backdrop-blur-sm"></div>
                <div class="relative z-10 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight">备案条款说明</h2>
                </div>
            </div>
            
            <div class="p-6 md:p-8">
                <div class="space-y-8">
                    <div class="flex items-start group">
                        <div class="flex-shrink-0 h-12 w-12 rounded-xl bg-gradient-to-br from-pink-100 to-pink-200 text-pink-800 flex items-center justify-center mr-5 shadow-sm group-hover:shadow-md transition-all">
                            <span class="font-bold text-xl">1</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">联系方式有效性</h3>
                            <p class="text-gray-600 leading-relaxed">
                                我们会通过邮箱、QQ等方式通知您备案信息的状态，请确保您提供的联系方式<b class="text-pink-600 font-medium">真实有效</b>。若联系方式失效导致备案失败，责任由您自行承担。
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="flex-shrink-0 h-12 w-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 text-blue-800 flex items-center justify-center mr-5 shadow-sm group-hover:shadow-md transition-all">
                            <span class="font-bold text-xl">2</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">备案代码悬挂</h3>
                            <p class="text-gray-600 leading-relaxed">
                                成功提交申请后，您需要按照页面引导将备案信息代码悬挂至您的网站底部。代码必须<b class="text-pink-600 font-medium">清晰可见</b>且<b class="text-pink-600 font-medium">不可修改</b>，否则可能导致备案被撤销。
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="flex-shrink-0 h-12 w-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-200 text-purple-800 flex items-center justify-center mr-5 shadow-sm group-hover:shadow-md transition-all">
                            <span class="font-bold text-xl">3</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">不被允许的站点类型</h3>
                            <div class="mt-3 space-y-3">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-5 h-5 rounded-full bg-pink-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="ml-2 text-gray-600">使用<b class="text-pink-600 font-medium">免费域名</b>或<b class="text-pink-600 font-medium">建站服务</b>的站点</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-5 h-5 rounded-full bg-pink-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="ml-2 text-gray-600">含有<b class="text-pink-600 font-medium">色情暴力</b>、<b class="text-pink-600 font-medium">政治敏感</b>等违禁内容的</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-5 h-5 rounded-full bg-pink-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="ml-2 text-gray-600">违反<b class="text-pink-600 font-medium">中华人民共和国法律法规</b>的</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="flex-shrink-0 h-12 w-12 rounded-xl bg-gradient-to-br from-green-100 to-green-200 text-green-800 flex items-center justify-center mr-5 shadow-sm group-hover:shadow-md transition-all">
                            <span class="font-bold text-xl">4</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">站点基本要求</h3>
                            <div class="mt-3 space-y-3">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-5 h-5 rounded-full bg-pink-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="ml-2 text-gray-600">开启<b class="text-pink-600 font-medium">HTTPS安全访问</b></p>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-5 h-5 rounded-full bg-pink-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="ml-2 text-gray-600">非<b class="text-pink-600 font-medium">空壳网站</b>，能长期存活和更新</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-5 h-5 rounded-full bg-pink-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="ml-2 text-gray-600">按要求完成与<b class="text-pink-600 font-medium"><?php echo htmlspecialchars($shortname); ?>备</b>的正确对接</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <div class="text-gray-600 mb-6">
                        如有疑问，请联系站长邮箱：
                        <a href="mailto:<?php echo htmlspecialchars($adminemail); ?>" class="text-pink-600 hover:text-pink-800 font-medium"><?php echo htmlspecialchars($adminemail); ?></a>
                    </div>
                    
                    <a href="choose.php">
                      <button class="px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl flex items-center mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        我已认真阅读并承诺遵守
                      </button>
                    </a>
                    
                    <p class="mt-6 text-gray-500 italic text-sm">
                        若你在万千网站中遇到<?php echo htmlspecialchars($shortname); ?>备<br>甚有缘分! ✧(≖ ◡ ≖✿)
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="fixed bottom-8 right-8 z-50">
        <button id="back-to-top" class="w-14 h-14 bg-gradient-to-br from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 rounded-full flex items-center justify-center text-white shadow-lg transition-all opacity-0 invisible transform translate-y-4 hover:shadow-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>