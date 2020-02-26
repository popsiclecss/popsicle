// tailwind.config.js
const { colors } = require('./defaultTheme')

module.exports = {
    theme: {
      extend: {
        colors: {
          blue: {
            '50': '#DEEBFF',
            '75': '#B3D4FF',
            '100': '#4C9AFF',
            '200': '#2684FF',
            '300': '#0065FF',
            '400': '#0052CC',
            '500': '#0747A6'
          }
        }
      }
    }
  }