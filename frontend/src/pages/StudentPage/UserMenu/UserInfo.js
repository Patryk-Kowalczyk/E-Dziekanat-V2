import React from "react";
import { useSelector } from "react-redux";

export default function UserInfo() {
  const user = useSelector((state) => state.auth.user);
  return (
    <div className="usermenu__info">
      <img src={user.avatar} alt="user-avatar" />
      <h3>{`${user.firstname} ${user.lastname}`}</h3>
      <p>({user.index})</p>
    </div>
  );
}
