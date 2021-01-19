import {SET_MARKS} from "./types";

export const setMarks = (marks) => ({
    type: SET_MARKS,
    payload: marks,
});
