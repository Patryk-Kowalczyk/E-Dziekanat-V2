import React from "react";
import {useSelector} from "react-redux";

export default function TeacherInfo() {
    const user = useSelector((state) => state.auth.user);
    console.log(user)
    return (
        <div className="usermenu__info">
            <img src={user.profile_picture} alt="user-avatar"/>
            <h3>{`${user.degree} ${user.first_name} ${user.last_name}`}</h3>
        </div>
    );
}
