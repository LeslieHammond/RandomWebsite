import { bake_cookie as bakeCookie } from 'sfcookies'

export const mutations = {
  setAllowsRecording: (state, boolean) => {
    state.allowsRecording = boolean
  },
  setIsRecording: (state, boolean) => {
    state.isRecording = boolean
  },
  setMediaRecorder: (state, mediaRecorder) => {
    state.mediaRecorder = mediaRecorder
  },
  addRecording: (state, recording) => {
    state.recordings.push(recording)
  },
  setSupportsRecording: (state, boolean) => {
    state.supportsRecording = boolean
  },
  setTested: (state, boolean) => {
    bakeCookie('tested', boolean)
    state.tested = boolean
  }
}
