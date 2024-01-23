import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('post/index');
}

function getAllPa()
{
    return httpAxios.get('post/indexPa');
}

function getById(id) {

    return httpAxios.get(`post/show/${id}`);
}
function getByIda(slug) {

    return httpAxios.get(`post/show/${slug}`);
}

function getPostByTopicId(limit,topic_id)
{
    return httpAxios.get(`post_topic/${limit}/${topic_id}`);
}
function getPostHome(limit,type) {

    return httpAxios.get(`post_list/${limit}/${type}`);
}
function getPostById(id) {

    return httpAxios.get(`post_detail/${id}`);
}

function getPostAll(limit,type) {

    return httpAxios.get(`post_all/${limit}/${type}`);
}

function create(post) {
    return httpAxios.post('post/store',post);

}
function update(post,id) {

    return httpAxios.post(`post/update/${id}`,post);


}
function remove(id) {
    return httpAxios.delete(`post/destroy/${id}`);

}
function getByPa(type)
{
    return httpAxios.get(`post_listPa/${type}`);
}
function get_byPagePo(limit,page)
{
    return httpAxios.get(`get_byPagePo/${limit}/${page}`);
}

function getlistRestore(limit,page)
{
    return httpAxios.get(`post/getlistRestore/${limit}/${page}`);
}


function get_byPagePa(limit,page)
{
    return httpAxios.get(`get_byPagePa/${limit}/${page}`);
}

function getlistRestorePa(limit,page)
{
    return httpAxios.get(`post/getlistRestorePa/${limit}/${page}`);
}


function deletetam(id) {

    return httpAxios.put(`post/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`post/restore/${id}`);

}

const postservice={
    deletetam:deletetam,
    getlistRestore:getlistRestore,
    getlistRestorePa:getlistRestorePa,
    get_byPagePa:get_byPagePa,

    restore:restore,
    get_byPagePo:get_byPagePo,
    getByPa:getByPa,
    getAllPa:getAllPa,
    getPostByTopicId:getPostByTopicId,
    getPostById:getPostById,
    getPostHome:getPostHome,
    getPostAll:getPostAll,
    getAll:getAll,
    getById:getById,
    getByIda:getByIda,

    create:create,
    update:update,
    remove:remove,

}
export default postservice;