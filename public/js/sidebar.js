document.addEventListener('DOMContentLoaded', () => {
    const body = document.querySelector('body'),
          sidebar = body.querySelector('.sidebar'),
          toggle = body.querySelector('.toggle'),
          searchBtn = body.querySelector('.search-box'),
          modeSwitch = body.querySelector('.toggle-switch'),
          modeText = body.querySelector('.mode-text');

    if (toggle) {
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('close');
        });
    }

    if (searchBtn) {
        searchBtn.addEventListener('click', () => {
            sidebar.classList.remove('close');
        });
    }

    if (modeSwitch) {
        modeSwitch.addEventListener('click', () => {
            body.classList.toggle('dark');
            
            if(body.classList.contains('dark')) {
                modeText.innerText = 'Light mode';
            } else {
                modeText.innerText = 'Dark mode';
            }
        });
    }
});