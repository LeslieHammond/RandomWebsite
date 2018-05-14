import { bake_cookie as bakeCookie } from 'sfcookies'

export const mutations = {
  addLink: (state, link) => {
    state.links.push(link)
  }
}
