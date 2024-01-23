const reducer = (state = [], action) => {
    var kt = false;
    switch (action.type) {
        case "ADD_CART":
            state.map((item, index) => {
                if (item._id === action.payload.id) {
                    kt = true;
                    state[index].quantity = state[index].quantity + action.quantity;
                    return state;

                }

            });

            if (!kt) {
                return [
                    ...state,
                    {
                        _id: action.payload.id,
                        name: action.payload.name,
                        image: action.payload.image,
                        price: action.payload.price,
                        quantity: action.quantity,
                    }
                ];
            }

        case "TANGSL":
            if (action.payload.type == "tang") {
                state.map((item, index) => {
                    if (item._id == action.payload.id) {
                        state[index].quantity = state[index].quantity + 1;
                        return;
                    }
                });
            }

        case "GIAMSL":
            if (action.payload.type == "giam") {

                state.map((item, index) => {
                    if (item._id == action.payload.id) {
                        state[index].quantity = state[index].quantity - 1;
                        return;

                    }
                });
            }

        case "DELETE":
            function dkdel(item) {
                return (item._id !== action.payload._id);
            }
            const newstate = state.filter(dkdel);
            return newstate;

        case "DELETEALL":
            if (action.payload.type === "dl") {
                state.splice(0, state.length);
                return state;
            }
        default:
            return state;
    }
}

export default reducer;