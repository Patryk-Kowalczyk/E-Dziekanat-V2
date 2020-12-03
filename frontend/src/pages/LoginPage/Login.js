import React from "react";
import LoginForm from "./LoginForm";
import logo from "../../images/logo.jpg";

function Login() {
  return (
    <div className="login-section">
      <img src={logo} alt="ZUT Logo" className="login-logo" />
      <LoginForm />
    </div>
  );
}

export default Login;
