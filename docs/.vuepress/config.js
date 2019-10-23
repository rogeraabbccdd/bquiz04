module.exports = {
  markdown: {
    lineNumbers: true
  },
  head: [
    ['link', { rel: 'stylesheet', href: '/css/custom.css'}],
    ['link', { rel: 'shortcut icon', href: '/images/favicon.ico'}],
  ],
  markdown: {
    lineNumbers: true,
  },
  base: '/bquiz04/',
  title:'精品電子商務',
  description: '國家技術士網頁設計乙級檢定第四題',
  plugins: [
    ['vuepress-plugin-container', { type: 'tip' }],
    ['vuepress-plugin-container', { type: 'warning' }],
    ['vuepress-plugin-container', { type: 'danger' }],
    'vuepress-plugin-nprogress',
    [ 
      '@vuepress/google-analytics',{
        'ga': 'UA-131804412-3'
      }
    ], 'vuepress-plugin-smooth-scroll',
  ],
  theme: 'yuu',
  themeConfig: {
    yuu: {
      defaultDarkTheme: true,
      defaultColorTheme: 'blue',
      // disableThemeIgnore: true,
      codeTheme: 'okaidia'
    },
    nav: [
      { text: '首頁', link: 'https://bquiz.kento520.tw' },
      { text: 'GitHub', link: 'https://github.com/rogeraabbccdd/bquiz04' },
    ],
    sidebar: [
      ['/', '首頁'],
      {
        title: '前置作業',
        collapsable: false,
        children: [
          'before/file',
          'before/sql',
          'before/func',
          'before/data',
        ]
      },
      {
        title: '前台',
        collapsable: false,
        children: [
          'front/indexx',
          'front/main',
          'front/user',
          'front/cart',
          'front/ain'
        ]
      },
      {
        title: '後台',
        collapsable: false,
        children: [
          'back/admin',
          'back/adm',
          'back/cat',
          'back/item',
          'back/order',
          'back/user',
          'back/foot'
        ]
      },
      ['end/end', '結語'],
    ]
  }
};