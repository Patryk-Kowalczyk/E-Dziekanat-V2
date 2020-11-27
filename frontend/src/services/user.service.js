import axios from "axios";
import authHeader from "./auth-header";

const API_URL = "";

class UserService {
  getPublicContent() {
    return axios.get(API_URL + "all");
  }

  getStudentBoard() {
    return axios.get(API_URL + "student");
  }

  getTracherBoard() {
    return axios.get(API_URL + "teacher");
  }
}

export default new UserService();
