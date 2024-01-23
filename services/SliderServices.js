import httpAxios from "../httpAxios";

function getAll()
{
    return httpAxios.get('slider/index');
}
function getById(id) {

    return httpAxios.get(`slider/show/${id}`);


}
function create(slider) {
    return httpAxios.post('slider/store',slider);

}
function update(slider,id) {

    return httpAxios.post(`slider/update/${id}`,slider);


}
function remove(id) {
    return httpAxios.delete(`slider/destroy/${id}`);
}
function getByPosition(position)
{
    return httpAxios.get(`slider_list/${position}`);
}
function get_byPageSli(limit,page)
{
    return httpAxios.get(`get_byPageSli/${limit}/${page}`);
}
function getlistRestore(limit,page)
{
    return httpAxios.get(`slider/getlistRestore/${limit}/${page}`);
}

function deletetam(id) {

    return httpAxios.put(`slider/delete/${id}`);

}

function restore(id) {

    return httpAxios.put(`slider/restore/${id}`);

}

const sliderservice={
    getlistRestore:getlistRestore,
    deletetam:deletetam,
    restore:restore,
    get_byPageSli:get_byPageSli,
    getByPosition:getByPosition,
    getAll:getAll,
    getById:getById,
    create:create,
    update:update,
    remove:remove,

}
export default sliderservice;