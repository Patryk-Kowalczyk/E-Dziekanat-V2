import React from "react";
import { Link } from "react-router-dom";
import { MdExitToApp } from "react-icons/md";
import AuthService from "../../../services/auth.service";

export default function LogoutButton() {
  return (
    <Link to="/" onClick={AuthService.logout}>
      <button className="button primary">
        <MdExitToApp />
        <p>Wyloguj się</p>
      </button>
    </Link>
  );
}
