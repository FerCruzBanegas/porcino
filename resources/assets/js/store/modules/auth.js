import axios from 'axios'

const state = {
  permissions: null
}

const mutations = {
  SET_PERMISSIONS_USER(state, data) {
    state.permissions = data
  }
}

const actions = {
  getPermissionsUser({commit}) {
    return new Promise((resolve, reject) => {
      axios.get('/permissions')
      .then((response) => {
        commit('SET_PERMISSIONS_USER', response.data)
        resolve()
      })
      .catch((error) => {
        console.log(error);
      })
    }, error => console.log(error))
  }
}

const getters = {
  userPermissions: (state) => {
    return state.permissions
  }
}


export default {
  state,
  mutations,
  actions,
  getters
}
