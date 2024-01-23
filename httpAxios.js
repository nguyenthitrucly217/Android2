import axios from "axios";
import { urlAPI } from "./config";

const httpAxios =  axios.create({
    baseURL:urlAPI,
    timout: 500000000,
    headers: {'X-Custom-Header':'foobar'}
});
export default httpAxios;