function integrateGitalk(router) {
  const linkGitalk = document.createElement('link');
  linkGitalk.href = 'https://cdn.jsdelivr.net/npm/gitalk@1/dist/gitalk.css';
  linkGitalk.rel = 'stylesheet';
  document.body.appendChild(linkGitalk);
  const scriptGitalk = document.createElement('script');
  scriptGitalk.src = 'https://cdn.jsdelivr.net/npm/gitalk@1/dist/gitalk.min.js';
  document.body.appendChild(scriptGitalk);
  
  window.onload = () => {
    setTimeout(() => {
      loadGitalk();
    }, 100);
  }

  router.afterEach(() => {
    if (scriptGitalk.onload) {
      loadGitalk();
    } else {
      scriptGitalk.onload = () => {
        loadGitalk();
      }
    }
  });

  function loadGitalk() {
    let commentsContainer = document.getElementById('gitalk-container');
    if (!commentsContainer) {
      commentsContainer = document.createElement('div');
      commentsContainer.id = 'gitalk-container';
      commentsContainer.classList.add('content');
    }
    commentsContainer.innerHTML = "";
    const $page = document.querySelector('.page');
    if ($page) {
      $page.appendChild(commentsContainer);
        setTimeout(() => {
          renderGitalk();
        }, 100);
    }
  }

  function renderGitalk() {
    const path = window.location.pathname;
    const gitalk = new Gitalk({
      clientID: 'e9c54c04c668a10b9e57',
      clientSecret: '706f00f71ed0952813ac695dbed09145c25879e1', // come from github development
      repo: 'bquiz04',
      owner: 'rogeraabbccdd',
      admin: ['rogeraabbccdd'],
      id: decodeURI(path),
      distractionFreeMode: false,
      language: 'zh-TW',
    });
    gitalk.render('gitalk-container');
  }
}

export default ({Vue, options, router}) => {
  try {
    document && integrateGitalk(router)
  } catch (e) {
    console.error(e.message)
  }
}