import { SET_INFO } from "../actions/types";

const initialState = {};

function infoReducer(state = initialState, action) {
  const { type, payload } = action;

  switch (type) {
    case SET_INFO:
      return { ...payload };
    default:
      return state;
  }
}

export default infoReducer;
