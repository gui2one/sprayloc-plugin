"use_strict";

Vue.component("VueApp", {
  data() {
    return {
      count: 42,
    };
  },
});

const vue = new Vue({
  el: document.getElementById("vue_app"),
  data: {
    message: "hello vue App !!",
    count: 45,
  },
  mounted() {
    this.helloWorld();
  },
  methods: {
    helloWorld() {
      //   this.$el.innerHTML = "sdfsdfsdf";
      //   console.log(this.$el);
    },
  },
});

// console.log(vue.message);
