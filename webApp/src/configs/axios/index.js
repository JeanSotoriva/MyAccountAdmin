import axios from "axios";

export const URI_BASE_API = 'http://localhost:8988/api'
export const TOKEN_NAME = 'token_sanctum'

axios.defaults.baseURL = URI_BASE_API