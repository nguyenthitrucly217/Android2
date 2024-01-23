import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('orderdetail/index');
}
function getById(id) {

    return httpAxios.get(`orderdetail/show/${id}`);


}
function create(orderdetail) {
    return httpAxios.post('orderdetail/store',orderdetail);

}
function update(orderdetail,id) {

    return httpAxios.post(`orderdetail/update/${id}`,orderdetail);


}
function remove(id) {
    return httpAxios.delete(`orderdetail/destroy/${id}`);

}
function get_byPageOrde(limit,page)
{
    return httpAxios.get(`get_byPageOrde/${limit}/${page}`);
}


const orderdetailservice={
    get_byPageOrde:get_byPageOrde,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,

}
export default orderdetailservice;