const notificationsReducer = (state = 0, action) => {
    switch (action.type) {
        case "SET":
            return state = action.payload;
        default:
            return state;
    }
}

export default notificationsReducer;