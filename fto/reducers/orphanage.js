const orphanageReducer = ( state = false, action ) => {
    switch (action.type) {
        case 'SET_ORPHANAGE':
            return state = action.payload;
        case 'UNSET_ORPHANAGE':
            return state = false;
        default:
            return state;
    }
}

export default orphanageReducer;