import React from "react";
import "./page.scss";
import Login from "./Login";

function LeftImage() {
  return <div className="login-image"></div>;
}

export default function Page() {
  return (
    <div className="login">
      <LeftImage />
      <Login />
    </div>
  );
}
