module.exports = {
  content: ['./*.html'],
  theme: {
    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl:'1440px',
    },
    extend: {
      colors: {
        'mediblue': '#1fb6ff',
        'mediback':'hsl(12,23%,56%)',
        'medimenu':'rgba(0%,50%,75%,0.4)',
        'purple': '#7e5bef',
        'pink': '#ff49db',
        'orange': '#ff7849',
        'green': '#13ce66',
        'yellow': '#ffc82c',
        'gray-dark': '#273444',
        'gray': '#8492a6',
        'gray-light': '#d6dce6',
        'medi-gray': 'hsl(204, 8%, 98%)',

      },
    },
  },
  plugins: [],
}
