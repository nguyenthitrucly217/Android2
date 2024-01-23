import httpAxios from "../httpAxios";
function getAll()
{
    return httpAxios.get('page/index');
}


function getById(id) {
    return httpAxios.get(`page/show/${id}`);


}
function create(page) {
    return httpAxios.post('page/store',page);

}
function update(page,id) {

    return httpAxios.post(`page/update/${id}`,page);

}
function remove(id) {
    return httpAxios.delete(`page/destroy/${id}`);
}
function getBySlug(slup) {
    return httpAxios.get(`page/show/${slup}`);
}
function getByPa(slug)
{
    return httpAxios.get(`page_listPa/${slug}`);
}

function getByPaTy(type)
{
    return httpAxios.get(`page_listPaTy/${type}`);
}

const pageservice={
    getByPaTy:getByPaTy,
    getByPa:getByPa,
    getBySlug:getBySlug,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,

}
export default pageservice;



