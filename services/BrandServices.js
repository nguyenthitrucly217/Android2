import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('brand/index');
}
function getById(id) {

    return httpAxios.get(`brand/show/${id}`);


}
function create(brand) {
    return httpAxios.post('brand/store',brand);

}
function update(category,id) {

    return httpAxios.post(`brand/update/${id}`,category);

}

function deletetam(id) {

    return httpAxios.put(`brand/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`brand/restore/${id}`);

}

function remove(id) {
    return httpAxios.delete(`brand/destroy/${id}`);

}

function get_byPageBr(limit,page)
{
    return httpAxios.get(`get_byPageBr/${limit}/${page}`);
}
function getlistRestore(limit,page)
{
    return httpAxios.get(`brand/getlistRestore/${limit}/${page}`);
}


const brandservice={
    restore:restore,
    getlistRestore:getlistRestore,
    deletetam:deletetam,
    get_byPageBr:get_byPageBr,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,
}
export default brandservice;