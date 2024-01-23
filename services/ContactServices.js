import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('contact/index');
}
function getById(id) {

    return httpAxios.get(`contact/show/${id}`);

}
function create(contact) {

    return httpAxios.post('contact/store',contact);
}
function update(contact,id) {

    return httpAxios.post(`contact/update/${id}`,contact);

}
function themdl(contact) {

    return httpAxios.post('contacthome',contact);

}

function remove(id) {
    return httpAxios.delete(`contact/destroy/${id}`);
}

function get_byPageCo(limit,page)
{
    return httpAxios.get(`get_byPageCo/${limit}/${page}`);
}

function getlistRestore(limit,page)
{
    return httpAxios.get(`contact/getlistRestore/${limit}/${page}`);
}
function deletetam(id) {

    return httpAxios.put(`contact/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`contact/restore/${id}`);

}



const contactservice={
    deletetam:deletetam,
    restore:restore,
    getlistRestore:getlistRestore,
    get_byPageCo:get_byPageCo,
    themdl:themdl,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,

}
export default contactservice;