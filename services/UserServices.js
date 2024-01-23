import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('user/index');
}
function getAllCus()
{
    return httpAxios.get('user/indexcustomer');
}

function getById(id) {

    return httpAxios.get(`user/show/${id}`);


}
function create(user) {
    return httpAxios.post('user/store',user);

}
function update(user,id) {

    return httpAxios.post(`user/update/${id}`,user);


}
function remove(id) {
    return httpAxios.delete(`user/destroy/${id}`);
}

function Login(user) {
    return httpAxios.post(`user/kiem_tra`,user);
}
function Register(user) {

    return httpAxios.post(`user/Register`,user);
}
function get_byPageUs(limit,page)
{
    return httpAxios.get(`get_byPageUs/${limit}/${page}`);
}

function get_byPageCus(limit,page)
{
    return httpAxios.get(`user/get_byPageCus/${limit}/${page}`);
}

function getlistRestore(limit,page)
{
    return httpAxios.get(`user/getlistRestore/${limit}/${page}`);
}

function deletetam(id) {

    return httpAxios.put(`user/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`user/restore/${id}`);

}
function getlistRestoreCus(limit,page)
{
    return httpAxios.get(`user/getlistRestoreCus/${limit}/${page}`);
}

const userservice={
    getlistRestoreCus:getlistRestoreCus,
    get_byPageCus:get_byPageCus,
    getlistRestore:getlistRestore,
    deletetam:deletetam,
    restore:restore,
    get_byPageUs:get_byPageUs,
    getAllCus:getAllCus,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,
    Login:Login,
    Register:Register,

}
export default userservice;