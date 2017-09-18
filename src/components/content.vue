<template>
  <div id="content">
    <h2 v-html="apiData1.title"></h2>
    <hr>
    <p v-text="apiData1.author" class="author"></p>
    <div v-html="apiData1.content" class="content"></div>
    <hr>
    <div class="footer">全文完&nbsp;&nbsp;共{{apiData1.wc}}字</div>
  </div>
</template>

<script>
export default {
  props: ['apiData1'],
  name: 'content',
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#content{
  padding: 2.5%;
  position: absolute;
  width: 95%;
  transition: left .5s;
  margin-top: .7rem
}
h2{
	text-align: center;
  font-size: 2em
}
.author{
	text-align: center;
	color: #888;
	margin-top:.5em;
	font-size: .1rem
}
.content{
	line-height: .4rem;
	text-indent: 2em
}
.footer{
	text-align: center;
	color: #888;
	font-size: .1rem
}
</style>
