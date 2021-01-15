import axios from "axios";
import API_URL from "./API_URL";
import authService from "./auth.service";
import header from "./auth-header";

// export default () => {
//   axios.interceptors.response.use(
//     (response) => {
//       return response;
//     },
//     (err) => {
//       return new Promise((resolve, reject) => {
//         const originalReq = err.config;
//         if (
//           err.response.status === 404 &&
//           err.config &&
//           !err.config.__isRetryRequest
//         ) {
//           originalReq._retry = true;

//           const user = JSON.parse(localStorage.getItem("user"));

//           let res = fetch(API_URL + "auth/refresh", {
//             method: "POST",
//             mode: "cors",
//             cache: "no-cache",
//             credentials: "same-origin",
//             headers: {
//               "Content-Type": "application/json",
//               Device: "device",
//               Authorization: `Bearer ${user.access_token}`,
//             },
//             redirect: "follow",
//             referrer: "no-referrer",
//           })
//             .then((res) => res.json())
//             .then((res) => {
//               console.log(res);
//               user.access_token = res.token;
//               localStorage.setItem("user", JSON.stringify(user));
//               originalReq.headers.Authorization = `Bearer ${user.access_token}`;
//               return axios(originalReq);
//             });

//           resolve(res);
//         }

//         return Promise.reject(err);
//       });
//     }
//   );
// };

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
       * When response code is 401, try to refresh the token.
       * Eject the interceptor so it doesn't loop in case
       * token refresh causes the 401 response
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

// export default () => {
//   axios.interceptors.response.use(
//     (response) => {
//       return response;
//     },
//     (error) => {
//       if (error.response.status !== 404) {
//         return new Promise((resolve, reject) => {
//           reject(error);
//         });
//       }
//       console.log(localStorage.getItem("user"));

//       // Logout user if token refresh didn't work or user is disabled
//       if (error.response.message === "Account is disabled.") {
//         authService.logout();

//         return new Promise((resolve, reject) => {
//           reject(error);
//         });
//       }

//       const config = {
//         headers: header(),
//       };

//       console.log("2");

//       const getNewToken = new Promise((resolve, reject) => {
//         console.log("3");
//         axios
//           .post(API_URL + "auth/refresh", config)
//           .then((response) => {
//             console.log("response", response);
//             localStorage.setItem("user", response.data.token);
//             resolve(response.data.token);
//           })
//           .catch((error) => {
//             console.log(error.response);
//             reject(error);
//           });
//       });

//       // Try request again with new token
//       // return getNewToken
//       //   .then((token) => {
//       //     return new Promise((resolve, reject) => {
//       //       axios
//       //         .request(config)
//       //         .then((response) => {
//       //           resolve(response);
//       //         })
//       //         .catch((error) => {
//       //           reject(error);
//       //         });
//       //     });
//       //   })
//       //   .catch((error) => {
//       //     Promise.reject(error);
//       //   });
//       //   return TokenStorage.getNewToken()
//       //     .then((token) => {
//       //       // New request with new token
//       //       const config = error.config;
//       //       config.headers["Authorization"] = `Bearer ${token}`;

//       //       return new Promise((resolve, reject) => {
//       //         axios
//       //           .request(config)
//       //           .then((response) => {
//       //             resolve(response);
//       //           })
//       //           .catch((error) => {
//       //             reject(error);
//       //           });
//       //       });
//       //     })
//       //     .catch((error) => {
//       //       Promise.reject(error);
//       //     });
//     }
//   );
// };
