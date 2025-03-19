import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  publicPath: '/Rentika/'  //you have to add your repo name here 
})

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  server:{
    port:3500
  }
})
