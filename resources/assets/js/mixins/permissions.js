import { mapGetters } from 'vuex'

export default {
  computed: mapGetters([
    'userPermissions'
  ]),
  methods: {
    permissions (url) {
      if(this.userPermissions)
        return this.userPermissions.data.includes(url) || this.userPermissions.data.includes('*')
    }
  }
}