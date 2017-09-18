<template>
  <div id="menuLeft"  @click.stop>
    <ul>
      <li @click="goSever"><img src="./icon/sever.png" alt="...">我的收藏</li>
      <li @click="set1"><img src="./icon/set.png" alt="..." >阅读设置</li>
      <li><img src="./icon/sever2.png" alt="...">给个好评</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ['set1'],
  name: 'menuLeft',
  data () {
    return {
    }
  },
  methods: {
    goSever () {
      this.$emit('goSever', true)
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#menuLeft{
  height: 100%
}
ul,li{
  list-style: none;
  margin: 0;
  padding: 0;
}
ul{
  background: #424241;
  height: 100%
}
li{
  border-bottom: 1px solid black;
  font-size: .3rem;
  padding: .4rem .2rem;
  text-align: center;
  color: rgb(143,136,136);
}
li img{
  height: .3rem;
  float: left;
  margin-right: 5px
}
</style>
