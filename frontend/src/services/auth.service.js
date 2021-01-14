import axios from "axios";
import API_URL from "./API_URL";

class AuthService {
  login(id, password, status) {
    return axios
      .post(API_URL + "auth/login", {
        email: id,
        password: password,
        status: status,
      })
      .then((response) => {
        if (response.data.access_token) {
          localStorage.setItem("user", JSON.stringify(response.data));
        }
        return response.data;
      });
  }

  logout() {
    localStorage.removeItem("user");
  }
}

export default new AuthService();
