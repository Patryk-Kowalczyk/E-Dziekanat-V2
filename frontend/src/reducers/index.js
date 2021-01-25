import {combineReducers} from "redux";
import auth from "./auth";
import message from "./message";
import info from "./info";
import classes from "./classes";
import marks from "./marks";

export default combineReducers({
    auth,
    message,
    info,
    classes,
    marks
});
