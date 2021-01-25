import axios from "axios";
import API_URL from "./API_URL";
import authService from "./auth.service";
import header from "./auth-header";

function createAxiosResponseInterceptor() {
  const interceptor = axios.interceptors.response.use(
    (response) => response,
    (error) => {
      // Reject promise if usual error
      if (
        error.response.status !== 404 &&
        error.response.data.status !== "Token is Expired. Go to refresh"
      ) {
        return Promise.reject(error);
      }

      /*
       * When response code is 404, try to refresh the token.
       * Eject the interceptor so it doesn't loop in case
       * token refresh causes the 404 response
       */
      axios.interceptors.response.eject(interceptor);

      const url = `http://createosm.pl/IPZ/backend/public/api/auth/refresh`;

      const options = {
        method: "POST",
        headers: header(),
        url,
      };

      return axios(options)
        .then((response) => {
          const user = JSON.parse(localStorage.getItem("user"));
          user.access_token = response.data.token;
          localStorage.setItem("user", JSON.stringify(user));
          error.response.config.headers["Authorization"] =
            "Bearer " + response.data.token;
          return axios(error.response.config);
        })
        .catch((error) => {
          return Promise.reject(error);
        })
        .finally(createAxiosResponseInterceptor);
    }
  );
}
export default createAxiosResponseInterceptor;
