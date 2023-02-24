const getters = {
    getUser(state) {
        return state.name;
    },
    checkAuth(state) {
        return state.isAuth;
    },
    getCartItems(state) {
        if (window.localStorage.getItem('foxy-cart-items')) {
            return JSON.parse(window.localStorage.getItem('foxy-cart-items'));
        }

        return state.cartItems;
    }
};

export default getters;
