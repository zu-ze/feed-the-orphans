export const setNotification = (value) => {
    return {
        type: 'SET',
        payload: value
    }
}

export const login = () => {
    return {
        type: 'LOG_IN'
    }
}

export const logout = () => {
    return {
        type: 'LOG_OUT'
    }
}

export const setUser = (obj) => {
    return {
        type: 'SET_USER',
        payload: obj
    }
}

export const unsetUser = () => {
    return {
        type: 'UNSET_USER'
    }
}

export const setOrphanage = (obj) => {
    return {
        type: 'SET_ORPHANAGE',
        payload: obj
    }
}

export const unsetOrphanage = () => {
    return {
        type: 'UNSET_ORPHANAGE'
    }
}