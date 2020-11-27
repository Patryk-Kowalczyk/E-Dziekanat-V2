import { LOGIN_SUCCESS, LOGIN_FAIL, LOGOUT } from "../actions/types";

const user = JSON.parse(localStorage.getItem("user"));

const inistalState = user
  ? { isLoggedIn: true, user }
  : { isLoggedIn: false, user: null };

function authReducer(state = inistalState, action) {
  const { type, payload } = action;

  switch (type) {
    case LOGIN_SUCCESS:
      return {
        ...state,
        isLoggedIn: true,
        user: payload.user,
      };

    case LOGIN_FAIL:
      return {
        ...state,
        isLoggedIn: false,
        user: null,
      };

    case LOGOUT:
      return {
        ...state,
        isLoggedIn: false,
        user: null,
      };
    default:
      return state;
  }
}

export default authReducer;
