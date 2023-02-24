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
        state.cartItems = data;

        window.localStorage.setItem('foxy-cart-items', JSON.stringify(data));
    },
    clearCartItems(state) {
        state.cartItems = [];
        state.productCount = 0;
        state.total = 0;

        window.localStorage.removeItem('foxy-cart-items');
    },
    addCartItems(state, info) {
        state.cartItems.push(info);
        state.productCount = info.productCount;
        state.total = info.total;

        if (window.localStorage.getItem('foxy-cart-items')) {
            let existCartItems = JSON.parse(window.localStorage.getItem('foxy-cart-items'));
            existCartItems.push(info);

            window.localStorage.setItem('foxy-cart-items', JSON.stringify(existCartItems));
        }
    }
};

export default mutations;
