import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('productstore/index');
}
function getById(id) {

    return httpAxios.get(`productstore/show/${id}`);

}
function create(productstore) {
    return httpAxios.post('productstore/store',productstore);

}
function update(productstore,id) {

    return httpAxios.post(`productstore/update/${id}`,productstore);

}
function remove(id) {
    return httpAxios.delete(`productstore/destroy/${id}`);
}
function get_byPageSto(limit,page)
{
    return httpAxios.get(`get_byPageSto/${limit}/${page}`);
}
function getlistRestore(limit,page)
{
    return httpAxios.get(`productstore/getlistRestore/${limit}/${page}`);
}

function deletetam(id) {

    return httpAxios.put(`productstore/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`productstore/restore/${id}`);

}


const productstoreservice={
    getlistRestore:getlistRestore,
    deletetam:deletetam,
    restore:restore,
    get_byPageSto:get_byPageSto,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,

}
export default productstoreservice;