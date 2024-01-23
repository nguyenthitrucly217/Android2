import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('topic/index');
}
function getById(id) {

    return httpAxios.get(`topic/show/${id}`);


}
function create(topic) {
    return httpAxios.post('topic/store',topic);

}
function update(topic,id) {

    return httpAxios.post(`topic/update/${id}`,topic);


}
function remove(id) {
    return httpAxios.delete(`topic/destroy/${id}`);
}

function getBySlug(slug)
{
    return httpAxios.get(`topic/show/${slug}`);
}
function get_byPageTo(limit,page)
{
    return httpAxios.get(`get_byPageTo/${limit}/${page}`);
}
function getlistRestore(limit,page)
{
    return httpAxios.get(`topic/getlistRestore/${limit}/${page}`);
}

function deletetam(id) {

    return httpAxios.put(`topic/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`topic/restore/${id}`);

}

const topicservice={
    getlistRestore:getlistRestore,
    deletetam:deletetam,
    restore:restore,
    get_byPageTo:get_byPageTo,
    getBySlug:getBySlug,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,

}
export default topicservice;