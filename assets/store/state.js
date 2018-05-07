import { read_cookie as readCookie } from 'sfcookies'

export const state = {
  allowsRecording: null,
  isRecording: false,
  mediaRecorder: null,
  recordings: [],
  supportsRecording: false,
  tested: readCookie('tested') === true
}
