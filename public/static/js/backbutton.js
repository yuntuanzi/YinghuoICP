    // 返回顶部按钮
    const backToTopButton = document.getElementById('back-to-top');
    
    // 监听滚动事件
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible', 'translate-y-4');
            backToTopButton.classList.add('opacity-100', 'visible', 'translate-y-0');
        } else {
            backToTopButton.classList.add('opacity-0', 'invisible', 'translate-y-4');
            backToTopButton.classList.remove('opacity-100', 'visible', 'translate-y-0');
        }
    });
    
    // 点击返回顶部
    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });