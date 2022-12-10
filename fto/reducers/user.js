const userReducer = (state = false, action) => {
    switch (action.type) {
        case 'SET_USER':
            return state = action.payload;
        case 'UNSET_USER':
            return state = false;
        default:
            return state;
    }
}

export default userReducer;