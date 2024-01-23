import httpAxios from "../httpAxios";

function getAll($id)
{
    return httpAxios.get('order/index/'+$id);
}
function getById(id) {

    return httpAxios.get(`order/show/${id}`);


}
function create(order) {
    return httpAxios.post('order/store',order);

}

function Thanhtoan(order) {
    return httpAxios.post('order/checkout',order);

}
function update(order,id) {

    return httpAxios.post(`order/update/${id}`,order);


}
function remove(id) {
    return httpAxios.delete(`order/destroy/${id}`);
}

function Information(order) {

    return httpAxios.post(`order/Information`,order);
}
function get_byPageOr(limit,page)
{
    return httpAxios.get(`get_byPageOr/${limit}/${page}`);
}

function getlistRestore(limit,page)
{
    return httpAxios.get(`order/getlistRestore/${limit}/${page}`);
}
function deletetam(id) {

    return httpAxios.put(`order/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`order/restore/${id}`);

}

const orderservice={
    Thanhtoan:Thanhtoan,
    deletetam:deletetam,
    restore:restore,
    getlistRestore:getlistRestore,
    get_byPageOr:get_byPageOr,
    Information:Information,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,

}
export default orderservice;