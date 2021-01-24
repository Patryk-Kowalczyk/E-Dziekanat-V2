import React from "react";
import SingleLink from "./SingleLink";
import {
    MdAccountBalanceWallet,
    MdAssignment,
    MdForum,
    MdList,
    MdSearch,
    MdComputer,
} from "react-icons/md";

export default function Menu() {
    return (
        <div className="menu">
            <SingleLink
                to="/teacher/dane-finansowe"
                name="Dane finansowe"
                icon={<MdAccountBalanceWallet/>}
            />
            <SingleLink to="/teacher/dyplomanci" name="Dyplomanci" icon={<MdAssignment/>}/>
            <SingleLink
                to="/teacher/wiadomosci"
                name="Wiadomości"
                icon={<MdForum/>}
            />
            <SingleLink to="/teacher/szukaj" name="Szukaj" icon={<MdSearch/>}/>
            <SingleLink
                to="/teacher/e-learning"
                name="E-learning"
                icon={<MdComputer/>

                }
                href

            />
        </div>
    );
}
