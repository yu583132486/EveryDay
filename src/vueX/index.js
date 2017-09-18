import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    articleSave: false
  },
  mutaations: {
    changeSave (state) {
      state.articleSave = !state.articleSave
    }
  }
})
