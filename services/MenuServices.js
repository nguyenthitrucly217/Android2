import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('menu/index');
}
function getById(id) {

    return httpAxios.get(`menu/show/${id}`);


}
function create(menu) {
    return httpAxios.post('menu/store',menu);

}
function update(menu,id) {

    return httpAxios.post(`menu/update/${id}`,menu);


}
function remove(id) {
    return httpAxios.delete(`menu/destroy/${id}`);

}
function getByParentId(position,parent_id)
{
    return httpAxios.get(`menu_list/${position}/${parent_id}`);
}
function getBySlug(slug) {

    return httpAxios.get(`menu/show/${slug}`);
}
    function get_byPageMe(limit,page)
    {
        return httpAxios.get(`get_byPageMe/${limit}/${page}`);
    }
    
    function getlistRestore(limit,page)
    {
        return httpAxios.get(`menu/getlistRestore/${limit}/${page}`);
    }
    function deletetam(id) {

        return httpAxios.put(`menu/delete/${id}`);
    
    }
    
    function restore(id) {
    
        return httpAxios.put(`menu/restore/${id}`);
    
    }
    
    



const menuservice={
    restore:restore,
    deletetam:deletetam,
    getlistRestore:getlistRestore,
    get_byPageMe:get_byPageMe,
    getBySlug:getBySlug,
    getByParentId:getByParentId,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,

}
export default menuservice;