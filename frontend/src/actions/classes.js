import {SET_CLASSES} from "./types";

export const setClasses = (classes) => ({
    type: SET_CLASSES,
    payload: classes,
});
