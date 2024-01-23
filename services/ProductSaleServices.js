import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('productsale/index');
}
function getById(id) {

    return httpAxios.get(`productsale/show/${id}`);

}
function create(productsale) {
    return httpAxios.post('productsale/store',productsale);

}
function update(productsale,id) {

    return httpAxios.post(`productsale/update/${id}`,productsale);

}
function remove(id) {
    return httpAxios.delete(`productsale/destroy/${id}`);
}
function get_byPageSale(limit,page)
{
    return httpAxios.get(`get_byPageSale/${limit}/${page}`);
}
function getlistRestore(limit,page)
{
    return httpAxios.get(`productsale/getlistRestore/${limit}/${page}`);
}

function deletetam(id) {

    return httpAxios.put(`productsale/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`productsale/restore/${id}`);

}


const productsaleservice={
    getlistRestore:getlistRestore,
    deletetam:deletetam,
    restore:restore,
    get_byPageSale:get_byPageSale,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,

}
export default productsaleservice;