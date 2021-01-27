import React from "react";
import { useSelector } from "react-redux";
import Skeleton from "../../../components/Skeleton";

export default function TeacherInfo() {
  const user = useSelector((state) => state.auth.user);
  return (
    <div className="usermenu__info">
      {user.first_name ? (
        <img src={user.profile_picture} alt="user-avatar" />
      ) : (
        <Skeleton type="round" />
      )}
      {user.first_name ? (
        <h3>{`${user.degree} ${user.first_name} ${user.last_name}`}</h3>
      ) : (
        <Skeleton />
      )}
    </div>
  );
}
