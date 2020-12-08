import React from "react";
import "./usermenu.scss";
import UserInfo from "./UserInfo";
import LogoutButton from "./LogoutButton";
import UserMenuNav from "./UserMenuNav";

function UserMenu() {
  return (
    <div className="usermenu">
      <UserInfo />
      <UserMenuNav />
      <LogoutButton />
    </div>
  );
}

export default function index() {
  return <UserMenu />;
}
