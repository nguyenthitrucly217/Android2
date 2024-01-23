import { combineReducers } from "redux";
import cart_reducer from "./cart_reducer";

const reducers=combineReducers({
    product:cart_reducer,
});
export default reducers;