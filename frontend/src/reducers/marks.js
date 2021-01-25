import {SET_MARKS} from "../actions/types";

const initialState = {};

function marksReducer(state = initialState, action) {
    const {type, payload} = action;

    switch (type) {
        case SET_MARKS:
            return {...payload};
        default:
            return state;
    }
}

export default marksReducer;
