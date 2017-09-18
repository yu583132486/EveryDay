<template>
  <div id="menuRight">
  	<ul>
        <li @click="Save">
            <img src="./icon/sever2.png" alt="" v-if="saved" >
            <img src="./icon/sever1.png" alt="" v-else>
            收藏
        </li>
        <li @click="prev">
            <img src="./icon/prev.png" alt="">
            前一天
        </li>
        <li @click="random">
        	<img src="./icon/suiji.png" alt="">
            随机
        </li>
        <li @click="next" v-if='nextshow1'>
            <img src="./icon/next.png" alt="">
            后一天
        </li>
        <li @click="today">
            <img src="./icon/today.png" alt="">
            今日
        </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ['apiData2', 'nextshow1', 'save'],
  name: 'menuRight',
  data () {
    return {
      saved: this.save,
      now: ''
    }
  },
  watch: {
    save () {
      this.saved = this.save
    }
  },
  beforeUpdate () {
    this.now = this.apiData2.date.curr
  },
  methods: {
    prev () {
      this.$emit('apiData2', this.apiData2.date.prev)
    },
    next () {
      this.$emit('apiData2', this.apiData2.date.next)
    },
    random () {
      this.$emit('random')
    },
    today () {
      this.$emit('today', this.apiData2.date.curr)
    },
    Save () {
      this.saved = !this.saved
      if (this.saved) {
        var saveArticle = {}
        saveArticle.title = this.apiData2.title
        saveArticle.author = this.apiData2.author
        saveArticle.date = this.apiData2.date.curr
        this.$emit('Save', saveArticle)
      } else {
        this.$emit('removeSave', this.apiData2.title)
      }
    }
  }
}
</script>

<style scoped>
ul{
	background: black;
	height: 100%;
	margin: 0;
	padding: 0;
}
li{
	list-style: none;
	text-align: center;
	color: rgb(143,136,136);
	padding: .15rem 0;
}
li>img{
	width: .65rem;
    display: block;
    margin: 5px auto;
}
</style>
