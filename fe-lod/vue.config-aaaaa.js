module.exports = {
  // options...
  devServer: {
    proxy: {
      "^/api": {
        target: "http://localhost:8080/",
        ws: true,
        changeOrigin: true,
      },
    },
  },
};
