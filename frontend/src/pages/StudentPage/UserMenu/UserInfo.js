import React from "react";
import { useSelector } from "react-redux";
import Skeleton from "../../../components/Skeleton";

export default function UserInfo() {
  const user = useSelector((state) => state.auth.user);
  return (
    <div className="usermenu__info">
      {user.first_name ? (
        <img src={user.profile_picture} alt="user-avatar" />
      ) : (
        <Skeleton type="round" />
      )}

      {user.first_name ? (
        <h3>{`${user.first_name} ${user.last_name}`}</h3>
      ) : (
        <Skeleton />
      )}
      {user.first_name ? <p>({user.album})</p> : <Skeleton />}
    </div>
  );
}
