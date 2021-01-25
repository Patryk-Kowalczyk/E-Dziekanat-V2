import React, { useState, useEffect } from "react";
import LoginForm from "./LoginForm";
import logo from "../../images/logo.jpg";
import axios from "axios";
import API_URL from "../../services/API_URL";
import header from "../../services/auth-header";
import HiUser from "./HiUser";

const config = {
  headers: header(),
};

function Login() {
  const [isUser, setIsUser] = useState(null);
  useEffect(() => {
    axios.get(API_URL + "infoUser", config).then((response) => {
      setIsUser(response.data);
    });
  }, []);
  return (
    <div className="login-section">
      <img src={logo} alt="ZUT Logo" className="login-logo" />
      {isUser ? (
        <HiUser name={isUser.name} status={isUser.status} />
      ) : (
        <LoginForm />
      )}
    </div>
  );
}

export default Login;
