<template>
  <div id="sever" @click.stop>
    <div id="header">
      <img src="./icon/back.png" @click="back">
    </div>
    <div class="saveArticle_c" v-if="saveDates.length">
      <ul>
        <li v-for="item in saveDates" @click="go(item.date)"> 
            <span class="title">{{ item.title }}</span>
            <span class="author">{{ item.author }}</span>
        </li>
      </ul>
    </div>
    <div class="save2" v-else>
      暂无收藏
    </div>
  </div>
</template>

<script>
export default {
  props: ['saveDates', 'go'],
  name: 'sever',
  data () {
    return {
    }
  },
  methods: {
    back () {
      this.$emit('back', false)
    }
  }
}
</script>

<style scoped>
ul,li{
	margin: 0;
	padding: 0
}
#sever{
  position: fixed;
  box-sizing: border-box;
  top: 0;
  background: #fafafa;
  width: 100%;
  height: 100%;
  font-size: .32rem;
  overflow-y:scroll; 
  left: 0;
  transition:opacity .3s,top .3s, left 0s .3s;
  z-index: 5 
}
#header{
  position: absolute;
  padding: .1rem;
}
.saveArticle_c{
  box-sizing: border-box;
  padding: 0 .2rem;
  margin-top: .8rem;
}
.saveArticle_c ul li{
  border-bottom: 1px solid #ccc;
  padding: .2rem 0;
  display: flex;
  justify-content: space-between;
}
.saveArticle_c ul li .author{
  font-size: .3rem;
  color:#ccc;
}
.save2{
  color: #888;
  text-align: center;
  margin-top: .8rem;
}
</style>
