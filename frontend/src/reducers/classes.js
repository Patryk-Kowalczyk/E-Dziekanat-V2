import {SET_CLASSES} from "../actions/types";

const initialState = {};

function classesReducer(state = initialState, action) {
    const {type, payload} = action;

    switch (type) {
        case SET_CLASSES:
            return {...payload};
        default:
            return state;
    }
}

export default classesReducer;
