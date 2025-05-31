const url = "http://localhost:8000/api";
let token = "42247570";
//   axios({
//     method: "get",
//     url: url,
//   })
//     .then((res) => console.log(res))
//     .catch((err) => console.error(err));

const link = axios.create({
  baseURL: url,
  headers: {
    api_token: token,
  },
});

export default link;
