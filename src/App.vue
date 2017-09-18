<template>
  <div id="app"  
  v-on="{click:left2,touchstart:ts,touchmove:tm,touchend:te}">
    <heade 
    :left1="left" 
    :right1="right" 
    :style="{'left':clickLeft ? '35%':'0', 'background-color': Ibg}"
    :class="{ Inight: night }">
    </heade>
    <menuLeft 
    :class="{'on':clickLeft}" 
    :set1="set"
    v-on="{
    goSever:goSever
    }">
    </menuLeft>
    <sever 
    v-if='showSever'
    :saveDates="saveDates"
    :go='NPArticle'
    v-on="{
    back:back
    }"
    ></sever>
    <menuRight 
    :style="{'right': clickRight ? '0' : '-23%'}"
    :apiData2="apiData"
    :nextshow1='nextshow'
    :save="isSaved"
    v-on="{
    apiData2:NPArticle,
    random:randomArticle,
    today:getArticle,
    Save:Save,
    removeSave:removeSave
    }">
    </menuRight>
    <div 
    class="right_bg" 
    v-if="clickRight" 
    @click="right">
    </div>
    <router-view 
    :apiData1="apiData" 
    :style="{'left':clickLeft ? '35%':'0', 'background-color': Ibg}"
    :night="night"
    :class="{ Inight: night }">
    </router-view>
    <Set
    :style="{'bottom':setS ? '0' :'-100%'}"
    v-on="{setSize:setSize, setNight:setNight,setBg: setBg}"
    ></Set>
    <transition name="sc">
      <span class="SC" v-if="isSC">{{ issc ? '收藏成功' : '取消收藏' }}</span>
    </transition>
  </div>
</template>

<script>
import defaultFontSize from '../static/rem'
import heade from '@/components/header'
import menuLeft from '@/components/menuLeft'
import menuRight from '@/components/menuRight'
import Set from '@/components/userset'
import sever from '@/components/sever'
import storage from '../static/storage'
export default {
  name: 'app',
  created () {
    defaultFontSize.defaultFontSize
    if (storage.get('articles')) {
      if (storage.get('articles').length > 0) {
        this.saveDates = storage.get('articles')
      }
    }
    this.wWidth = window.innerWidth
  },
  mounted () {
    // 获取数据
    this.$Ajax({
      method: 'get',
      baseURL: '/api',
      url: 'article/today'
    }).then(reg => { this.apiData = reg.data.data }).catch(err => { console.log(err) })
  },
  data () {
    return {
      apiData: {},
      clickLeft: false,
      clickRight: false,
      setS: false,
      Ibg: '#fafafa',
      night: false,
      nextshow: false,
      showSever: false,
      saveDates: [],
      touchPoint: {},
      wWidth: '',
      isSC: false,
      issc: true
    }
  },
  components: {
    menuLeft,
    menuRight,
    heade,
    Set,
    sever
  },
  methods: {
    // 左菜单栏
    left () {
      this.setS = false
      this.clickLeft = !this.clickLeft
      if (this.clickLeft) {
        document.body.style.overflowY = 'hidden'
      } else {
        document.body.style.overflowY = 'auto'
      }
    },
    left2 () {
      if (this.clickLeft) {
        this.clickLeft = !this.clickLeft
        document.body.style.overflowY = 'auto'
      }
      if (this.setS) {
        this.setS = !this.setS
        document.body.style.overflowY = 'auto'
      }
    },
    // 右菜单栏
    right () {
      this.setS = false
      this.clickRight = !this.clickRight
      if (this.clickRight) {
        document.body.style.overflowY = 'hidden'
      } else {
        document.body.style.overflowY = 'auto'
      }
    },
    // 字体背景设置栏
    set () {
      this.clickLeft = !this.clickLeft
      this.setS = !this.setS
    },
    // 获取前、后一天及收藏文章的数据
    NPArticle (data) {
      this.clickRight = false
      this.showSever = false
      this.$Ajax({
        method: 'get',
        baseURL: '/api',
        url: 'article/day',
        params: {
          dev: 1,
          date: data
        }
      }).then((res) => {
        this.apiData = res.data.data
        if (this.apiData.date.curr < new Date().Format('yyyyMMdd')) {
          this.nextshow = true
        } else {
          this.nextshow = false
        }
      })
      document.body.style.overflowY = 'auto'
      document.body.scrollTop = document.documentElement.scrollTop = 0
    },
    // 随机获取某一天数据
    randomArticle () {
      this.clickRight = false
      this.$Ajax({
        method: 'get',
        baseURL: '/api',
        url: 'article/random',
        params: {
          dev: 1
        }
      }).then((res) => {
        this.apiData = res.data.data
        if (this.apiData.date.curr < new Date().Format('yyyyMMdd')) {
          this.nextshow = true
        } else {
          this.nextshow = false
        }
      })
      document.body.style.overflowY = 'auto'
      document.body.scrollTop = document.documentElement.scrollTop = 0
    },
    // 获取今天的数据
    getArticle (today) {
      this.clickRight = false
      this.$Ajax({
        method: 'get',
        baseURL: '/api',
        url: 'article/today',
        params: {
          dev: 1
        }
      }).then((res) => {
        this.apiData = res.data.data
        this.nextshow = false
      })
      document.body.style.overflowY = 'auto'
      document.body.scrollTop = document.documentElement.scrollTop = 0
    },
     // 阅读设置
    setSize (val) {
      document.querySelector('#content').style.fontSize = val
    },
    setBg (val) {
      this.night = false
      this.Ibg = val
    },
    setNight () {
      this.night = !this.night
    },
     // 收藏设置
    Save (data) {
      this.clickRight = false
      this.saveDates.unshift(data)
      this.isSC = true
      setTimeout(() => {
        this.isSC = false
      }, 500)
      storage.set('articles', this.saveDates)
    },
    removeSave (data) {
      this.clickRight = false
      this.isSC = true
      setTimeout(() => {
        this.isSC = false
      }, 500)
      for (let item in this.saveDates) {
        if (this.saveDates[item].title === data) {
          this.saveDates.splice(item, 1)
        }
      }
      storage.set('articles', this.saveDates)
    },
    goSever (data) {
      this.clickLeft = false
      this.showSever = data
    },
    back (data) {
      this.showSever = data
      document.body.style.overflowY = 'auto'
    },
    // 手指滑动
    ts (e) {
      var point = e.targetTouches[0].clientX
      this.touchPoint.startX = point
    },
    tm (e) {
      // e.preventDefault()
      var point = e.targetTouches[0]
      this.touchPoint.stopX = point.clientX
      if (this.clickLeft || this.clickRight) {
        e.preventDefault()
      }
    },
    te (e) {
      // e.preventDefault()
      var distand = this.touchPoint.stopX - this.touchPoint.startX
      if (distand > 20 && !this.clickLeft) {
        if (this.touchPoint.startX <= this.wWidth / 4 && !this.clickRight) {
          this.left()
        }
        this.clickRight = false
      } else if (distand < -20) {
        if (this.clickLeft) {
          this.left()
        } else {
          if (this.touchPoint.startX >= this.wWidth * 3 / 4 && !this.clickLeft) {
            this.right()
          }
        }
      }
      document.body.style.overflowY = 'auto'
      this.touchPoint = {}
    }
  },
  computed: {
    // 判断是否被收藏
    isSaved () {
      for (let item in this.saveDates) {
        if (this.saveDates[item].title === this.apiData.title) {
          this.issc = true
          return true
        }
      }
      this.issc = false
      return false
    }
  }
}
</script>

<style scoped>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  position: relative;
}
#menuLeft{
  position: fixed;
  width: 35%;
  left: -35%;
  height: 100%;
  transition: all .5s
}
#app .on{
  left: 0
}
#menuRight{
  height: 100%;
  position: fixed;
  right: -23%;
  top: 0;
  width: 23%;
  transition: all .5s;
  z-index: 3
}
.right_bg{
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background: rgba(221, 221, 97, 0.25);
  z-index: 2;
}
.Inight{
  background:#444 !important;
  color: #e2d9d9
}
.SC{
  position: fixed;
  top: 50%;
  left:50%;
  transform: translate(-50%,-50%);
  background: rgba(0,0,0,.8);
  border-radius: 8px;
  color: #fff;
  padding: .3rem .6rem;
}
.sc-leave-active{
  transition: .1s .2s;
}
.sc-enter-active{
  transition: .1s;
}
.sc-enter,.sc-leave-to{
  opacity: 0;
}
</style>
