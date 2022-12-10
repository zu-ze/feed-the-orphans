import notificationsReducer from "./notifications";
import loggedReducer from "./logged";
import {combineReducers} from 'redux';
import userReducer from "./user";
import orphanageReducer from "./orphanage";

const allReducers = combineReducers({
    notifications: notificationsReducer,
    isLogged: loggedReducer,
    user: userReducer,
    orphanage: orphanageReducer
})

export default allReducers;