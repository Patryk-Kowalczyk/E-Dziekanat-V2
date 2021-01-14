import axios from "axios";
import API_URL from "./API_URL";
import authService from "./auth.service";
import header from "./auth-header";

export default () => {
  axios.interceptors.response.use(
    (response) => {
      return response;
    },
    (error) => {
      if (error.response.status !== 401) {
        return new Promise((resolve, reject) => {
          reject(error);
        });
      }

      // Logout user if token refresh didn't work or user is disabled
      console.log(error);
      if (error.response.message === "Account is disabled.") {
        authService.logout();

        return new Promise((resolve, reject) => {
          reject(error);
        });
      }

      const config = {
        headers: header(),
      };

      const getNewToken = new Promise((resolve, reject) => {
        axios
          .post(API_URL + "auth/refresh", config)
          .then((response) => {
            localStorage.setItem("user", response.data.access_token);
            resolve(response.data.access_token);
          })
          .catch((error) => {
            reject(error);
          });
      });

      // Try request again with new token
      return getNewToken
        .then((token) => {
          return new Promise((resolve, reject) => {
            axios
              .request(config)
              .then((response) => {
                resolve(response);
              })
              .catch((error) => {
                reject(error);
              });
          });
        })
        .catch((error) => {
          Promise.reject(error);
        });
      //   return TokenStorage.getNewToken()
      //     .then((token) => {
      //       // New request with new token
      //       const config = error.config;
      //       config.headers["Authorization"] = `Bearer ${token}`;

      //       return new Promise((resolve, reject) => {
      //         axios
      //           .request(config)
      //           .then((response) => {
      //             resolve(response);
      //           })
      //           .catch((error) => {
      //             reject(error);
      //           });
      //       });
      //     })
      //     .catch((error) => {
      //       Promise.reject(error);
      //     });
    }
  );
};
