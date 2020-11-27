import axios from "axios";

//To add later
const API_URL = "";

class AuthService {
  login(id, password) {
    return axios.post(API_URL + "signin", { id, password }).then((response) => {
      if (response.data.accessToken) {
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
