import axios from "axios";

const url = "http://localhost:8000/api";

const link = axios.create({
  baseURL: url,
  headers: {
    Accept: "application/json",
    api_token: "42247570",
  },
});

export default link;
