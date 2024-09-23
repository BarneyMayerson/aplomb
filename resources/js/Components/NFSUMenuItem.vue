<script setup>
defineProps(["href", "active"]);
</script>

<template>
  <li active>
    <a :href>
      <slot />
    </a>
  </li>
</template>

<style scoped>
.main-menu ul {
  list-style: none;
  padding-left: 0;
  margin-left: 0;
}
.main-menu ul li {
  list-style: none;
  padding-left: 0;
  margin-left: 0;
  padding-right: 19px;
  position: relative;
  width: 100%;
  height: 62px;
}
.main-menu ul li:hover::after {
  display: block;
  width: 19px;
  height: 62px;
  position: absolute;
  top: 0;
  right: 0;
  content: "";
  -webkit-animation: activemenu 1s infinite; /* Safari 4+ */
  -moz-animation: activemenu 1s infinite; /* Fx 5+ */
  -o-animation: activemenu 1s infinite; /* Opera 12+ */
  animation: activemenu 1s infinite; /* IE 10+, Fx 29+ */
}
.main-menu ul li a {
  border-top: 15px solid transparent;
  border-bottom: 15px solid transparent;
  border-left: 15px solid transparent;
  color: #5099b2;
  font-size: 28px;
  line-height: 32px;
  text-decoration: none;
  text-transform: uppercase;
  display: block;
  padding-right: 15px;
  text-align: right;
}
.main-menu ul li:hover a {
  border-top: 15px solid #2b3c46;
  border-bottom: 15px solid #2b3c46;
  color: #cde7f1;
}
@-webkit-keyframes activemenu {
  0%,
  49% {
    background: #5f5f5f;
  }
  50%,
  100% {
    background: transparent;
  }
}
@keyframes activemenu {
  0%,
  49% {
    background: #5f5f5f;
  }
  50%,
  100% {
    background: transparent;
  }
}
</style>
