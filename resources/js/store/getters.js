const getters = {
    getUser(state) {
        return state.name;
    },
    checkAuth(state) {
        return state.isAuth;
    }
};

export default getters;

