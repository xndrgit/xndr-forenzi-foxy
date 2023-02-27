const mutations = {
    updateUser(state, user) {
        state.isAuth = user.isAuth;
        if (user.isAuth) {
            state.name = user.name;
            window.localStorage.setItem('user', user.name);
        }
    },
    updateCart(state, info) {
        state.productCount = info.productCount;
        state.total = info.total;
    },
    currentQuantity(state, info) {
        state.quantity = info.quantity;
    },
    setCartItems(state, data) {
        state.cartItems = JSON.parse(JSON.stringify(data));

        if (!data || !data.length) {
            window.localStorage.removeItem('foxy-cart-items');
        } else {
            window.localStorage.setItem('foxy-cart-items', JSON.stringify(data));
        }
    },
    clearCartItems(state) {
        state.cartItems = null;
        state.productCount = 0;
        state.total = 0;

        window.localStorage.removeItem('foxy-cart-items');
    }
};

export default mutations;
