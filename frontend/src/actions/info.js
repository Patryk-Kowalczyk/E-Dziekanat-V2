import { SET_INFO } from "./types";

export const setInfo = (info) => ({
  type: SET_INFO,
  payload: info,
});
