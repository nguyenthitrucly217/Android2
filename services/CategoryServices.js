import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('category/index');
}
function getById(id) {

    return httpAxios.get(`category/show/${id}`);


}
function create(category) {
    return httpAxios.post('category/store',category);

}
function update(category,id) {

    return httpAxios.post(`category/update/${id}`,category);


}
function remove(id) {
    return httpAxios.delete(`category/destroy/${id}`);
}
function getCategoryByParentId(parent_id){

    return httpAxios.get(`category_list/${parent_id}`);

}
function getBySlug(slug)
{
    return httpAxios.get('category/show/'+slug);
}

function get_byPageCa(limit,page)
{
    return httpAxios.get(`get_byPageCa/${limit}/${page}`);
}

function getlistRestoreCa(limit,page)
{
    return httpAxios.get(`category/getlistRestoreCa/${limit}/${page}`);
}

function deletetam(id) {

    return httpAxios.put(`category/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`category/restore/${id}`);

}


const categoryservice={
    getlistRestoreCa:getlistRestoreCa,
    restore:restore,
    deletetam:deletetam,
    get_byPageCa:get_byPageCa,
    getBySlug:getBySlug,
    getCategoryByParentId:getCategoryByParentId,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,
}
export default categoryservice;