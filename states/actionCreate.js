export const ADD_CART = (product, quantity) => {
    return (dispatch) => {
        dispatch({ type: "ADD_CART", payload: product, quantity: quantity });
    };
};

export const TANGSL = (pro) => {
    return (dispatch) => {
        dispatch({ type: "TANGSL", payload: pro});
    };
};

export const GIAMSL = (pro) => {
    return (dispatch) => {
        dispatch({ type: "GIAMSL", payload: pro});
    };
};

export const DELETE = (pro) => {
    return (dispatch) => {
        dispatch({ type: "DELETE", payload: pro});
    };
};
export const DELETEALL = () => {
    return (dispatch) => {
        dispatch({ type: "DELETEALL", payload: {type:"dl"}});
    };
};




