import { combineReducers } from "redux";
import auth from "./auth";
import message from "./message";
import info from "./info";

export default combineReducers({
  auth,
  message,
  info,
});
