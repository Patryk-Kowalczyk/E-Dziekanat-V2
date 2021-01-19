import {combineReducers} from "redux";
import auth from "./auth";
import message from "./message";
import info from "./info";
import classes from "./classes";

export default combineReducers({
    auth,
    message,
    info,
    classes
});
