<template>
  <div id="heade">
    <img src="./icon/caid.png" alt="..." class="menuLeftimg" @click.stop="left1">
    <img src="./icon/portmenu.png" alt="..." class="menuRightimg" @click.stop="right1">
    </div>
  </div>
</template>

<script>
export default {
  props: ['left1', 'right1'],
  name: 'heade',
  data () {
    return {
    }
  }
}
</script>

<style scoped>
#heade{
  position: fixed;
  top: 0;
  background: #fff;
  width: 95%;
  padding:.1rem 2.5%;
  z-index: 1;
  transition: left .5s;
}
img{
  height: .5rem
}
.menuRightimg{
  float: right;
}


</style>
