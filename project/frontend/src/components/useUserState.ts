import { InjectionKey, reactive, computed, ComputedRef } from "vue"
import { AuthenticationApi } from "@/core/openapiClient/apis"

type useUserStateType = {
  subscription: ComputedRef<{
    logined: boolean
    user: { id: number; name: string }
  }>
  login(email: string, password: string, remember: boolean): Promise<boolean>
  logout(): Promise<boolean>
}

const useUserState = (): useUserStateType => {
  const authenticationApi = new AuthenticationApi()
  const state = reactive({ logined: false, user: { id: 0, name: "" } })

  const login = async (email: string, password: string, remember: boolean) => {
    try {
      const response = await authenticationApi.authenticationLoginPost({
        inlineObject1: {
          email: email,
          password: password,
          remember: remember,
        },
      })
      state.user.id = response.id
      state.user.name = response.name
      state.logined = true
      return true
    } catch (e) {
      // debugger
    }
    return false
  }

  const logout = async () => {
    try {
      await authenticationApi.authenticationLogoutPost()
      state.user.id = 0
      state.user.name = ""
      state.logined = false
      return true
    } catch (e) {
      // debugger
    }
    return false
  }

  return {
    subscription: computed(() => state),
    login: login,
    logout: logout,
  }
}

const useUserStateKey: InjectionKey<useUserStateType> = Symbol("useUserState")

export { useUserState, useUserStateKey, useUserStateType }
