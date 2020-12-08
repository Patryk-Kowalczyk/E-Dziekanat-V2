import React from "react";
import { Link } from "react-router-dom";
import { MdExitToApp } from "react-icons/md";

export default function LogoutButton() {
  return (
    <Link to="/">
      <button className="button primary">
        <MdExitToApp />
        <p>Wyloguj się</p>
      </button>
    </Link>
  );
}
