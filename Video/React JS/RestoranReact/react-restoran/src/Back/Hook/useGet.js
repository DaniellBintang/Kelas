import { useEffect, useState } from "react";
import link from "../../Axios/link";

const useGet = (url) => {
  const [isi, setIsi] = useState([]);
  const [refresh, setRefresh] = useState(false);

  useEffect(() => {
    link.get(url).then((res) => setIsi(res.data));
  }, [url, refresh]);

  const reload = () => setRefresh((prev) => !prev);

  return [isi, reload];
};

export default useGet;
